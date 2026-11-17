import { Controller } from "@hotwired/stimulus";
import { loadSettings, persistSettings } from "../validatorSettings.js";
import * as autocomplete from "@codemirror/autocomplete";
import * as commands from "@codemirror/commands";
import { htmlLanguage } from "@codemirror/lang-html";
import { json, jsonLanguage } from "@codemirror/lang-json";
import * as language from "@codemirror/language";
import * as state from "@codemirror/state";
import * as view from "@codemirror/view";
import { configureNesting } from "@lezer/html";

const defaultValue = `{
  "@context": "https://schema.org",
  "@type": "Organization",
  "url": "https://jolicode.com",
  "name": [
    "Web development agency"
  ],
  "contactPoint": {
    "@type": "ContactPoint",
    "url": "https://jolicode.com/contact",
    "contactType": "Customer service"
  }
}`;

// override the html language configuration to support the nested json-ld blocks
const html = htmlLanguage.configure({
  wrap: configureNesting([
    {
      tag: "script",
      attrs(attrs) {
        return attrs.type === "application/ld+json";
      },
      parser: jsonLanguage.parser,
    },
  ]),
});

// data-start / data-end carry "line:column" pairs computed by PHP, valid only
// against the exact document it audited. Should the two ever drift
// apart, that must degrade to "no marker" rather than throw: doc.line() raises
// a RangeError, and one raised inside the transactionExtender below would
// abort the whole controller boot, leaving the visitor with a bare textarea
// and no editor at all.
const lineStart = (doc, rawLine) => {
  const line = parseInt(rawLine, 10);

  // parseInt yields NaN on garbage, and both NaN < 1 and NaN > doc.lines are
  // false, so the explicit check is doing real work here
  if (!Number.isInteger(line) || line < 1 || line > doc.lines) {
    return null;
  }

  return doc.line(line).from;
};

export default class extends Controller {
  static targets = [
    "codemirror",
    "formatButton",
    "nodes",
    "settingsWrapper",
    "settingsButton",
    "settingsPanel",
    "settingMergeNodes",
    "settingAllowPending",
    "settingAutoExpandWarnings",
    "warnings",
  ];

  initialize() {
    this.setupCodemirror();
  }

  connect() {
    // the errors are always shown, the warnings of an entity are folded
    // unless the settings say otherwise
    const { autoExpandWarnings } = loadSettings();

    this.warningsTargets.forEach((warnings) => {
      warnings.open = autoExpandWarnings;
    });
  }

  toggleSettings() {
    const shouldOpen = this.settingsPanelTarget.classList.contains("hidden");

    if (shouldOpen) {
      const settings = loadSettings();
      this.settingMergeNodesTarget.checked = settings.mergeSharedIdentifiers;
      this.settingAllowPendingTarget.checked = settings.allowPendingVocabulary;
      this.settingAutoExpandWarningsTarget.checked = settings.autoExpandWarnings;
    }

    this.settingsPanelTarget.classList.toggle("hidden", !shouldOpen);
    this.settingsButtonTarget.setAttribute("aria-expanded", shouldOpen ? "true" : "false");
  }

  closeSettingsOnOutsideClick(event) {
    if (this.settingsPanelTarget.classList.contains("hidden") || this.settingsWrapperTarget.contains(event.target)) {
      return;
    }

    this.settingsPanelTarget.classList.add("hidden");
    this.settingsButtonTarget.setAttribute("aria-expanded", "false");
  }

  // audit again so that the settings applied by PHP - merging and pending
  // vocabulary - take effect
  saveSettings() {
    persistSettings({
      mergeSharedIdentifiers: this.settingMergeNodesTarget.checked,
      allowPendingVocabulary: this.settingAllowPendingTarget.checked,
      autoExpandWarnings: this.settingAutoExpandWarningsTarget.checked,
    });

    this.codemirrorTarget.form.requestSubmit();
  }

  // the audit reports lines and columns: once the document is reformatted,
  // it is audited again
  async format() {
    const form = this.codemirrorTarget.form;
    const errorElement = form.querySelector("[data-validation-error]");

    errorElement.textContent = "";
    this.formatButtonTarget.disabled = true;

    try {
      // Prettier is as big as the rest of the page: loaded when asked for
      const { formatDocument } = await import("../format.js");
      const { content, error } = await formatDocument(this.editorView.state.doc.toString());

      if (error) {
        errorElement.textContent = error;

        return;
      }

      this.editorView.dispatch({
        changes: { from: 0, to: this.editorView.state.doc.length, insert: content },
      });
      form.requestSubmit();
    } finally {
      this.formatButtonTarget.disabled = false;
    }
  }

  setupCodemirror() {
    let compartmentInitialized = false;
    const compartmentEffects = [];

    // compute if a language change is required
    const computeCurrentLanguage = (tr) => {
      if (compartmentInitialized && !tr.docChanged) {
        return null;
      }

      const docIsHTML = /^\s*</.test(tr.newDoc.sliceString(0, 100));
      const stateIsHTML = tr.startState.facet(language.language) === html;

      if (compartmentInitialized && docIsHTML === stateIsHTML) {
        return null;
      }

      return docIsHTML ? html : json();
    };

    // listen to the editor state to set the language and the gutters
    // codemirror would not let us use two compartments
    const compartment = new state.Compartment();
    const compartmentExtension = state.EditorState.transactionExtender.of(
      (tr) => {
        const currentLanguage = computeCurrentLanguage(tr);

        if (compartmentInitialized) {
          return currentLanguage === null
            ? null
            : {
                effects: compartment.reconfigure([
                  currentLanguage,
                  ...compartmentEffects,
                ]),
              };
        }

        compartmentInitialized = true;

        const violationGutterMarker = new (class extends view.GutterMarker {
          constructor() {
            super();
            this.elementClass = "cm-violationLineGutter";
          }
        })();

        const ranges = [];
        const positions = [];

        this.nodesTarget.querySelectorAll("[data-start]").forEach((node) => {
          if (typeof node.dataset.invalid === "undefined") {
            return;
          }

          // a single range splits to a one-element list, so the pipe-joined and
          // the lone case are the same code
          node.dataset.start.split("|").forEach((start) => {
            const from = lineStart(tr.startState.doc, start.split(":")[0]);

            if (from !== null) {
              positions.push(from);
            }
          });
        });

        positions.forEach((value, index) => {
          if (positions.indexOf(value) === index) {
            ranges.push(violationGutterMarker.range(value));
          }
        });

        if (ranges.length) {
          compartmentEffects.push(
            view.lineNumberMarkers.of(state.RangeSet.of(ranges, true))
          );
        }

        compartmentEffects.push(view.lineNumbers());

        if (currentLanguage === null) {
          return {
            effects: compartment.reconfigure(compartmentEffects),
          };
        }

        return {
          effects: compartment.reconfigure([
            currentLanguage,
            ...compartmentEffects,
          ]),
        };
      }
    );

    const customSelectionStyle = view.EditorView.baseTheme({
      ".cm-selectionBackground": {
          backgroundColor: "rgb(255 255 100)",
      },
    });

    const extensions = (() => [
      view.highlightActiveLineGutter(),
      view.highlightSpecialChars(),
      commands.history(),
      view.drawSelection(),
      view.dropCursor(),
      state.EditorState.allowMultipleSelections.of(true),
      language.indentOnInput(),
      language.syntaxHighlighting(language.defaultHighlightStyle, {
        fallback: true,
      }),
      language.bracketMatching(),
      compartment.of([]),
      compartmentExtension,
      autocomplete.closeBrackets(),
      autocomplete.autocompletion(),
      view.rectangularSelection(),
      view.crosshairCursor(),
      view.highlightActiveLine(),
      view.keymap.of([
        ...autocomplete.closeBracketsKeymap,
        ...commands.defaultKeymap,
        ...commands.historyKeymap,
        commands.indentWithTab,
        ...autocomplete.completionKeymap,
      ]),
      customSelectionStyle,
    ])();

    // create the editor
    const editorView = new view.EditorView({
      doc: this.codemirrorTarget.value || defaultValue,
      extensions,
    });
    this.editorView = editorView;
    this.codemirrorTarget.parentNode.insertBefore(editorView.dom, this.codemirrorTarget);
    this.codemirrorTarget.style.display = "none";

    // app.js audits what the textarea holds, once the event reaches the document
    this.codemirrorTarget.form.addEventListener("submit", () => {
      this.codemirrorTarget.value = editorView.state.doc.toString();
    });

    // force an initial configuration of our comprtment
    editorView.dispatch({
      effects: compartment.reconfigure(html),
    });


    // handle the clicks on the nodes
    this.nodesTarget.addEventListener("click", (e) => {
      // a link of an issue is followed, not taken for its issue
      const node = e.target.closest("a, [data-start]");

      if (node && node.dataset.start && node.dataset.end) {
        e.preventDefault();
        // several ranges are joined with a pipe: the first one is selected
        const start = node.dataset.start.split("|")[0].split(":");
        const end = node.dataset.end.split("|")[0].split(":");

        // tested before computing anything, so an approximate range cannot
        // throw on its way to being ignored
        if (start.length > 2 && start[2] === "approx") {
          return;
        }

        const startFrom = lineStart(editorView.state.doc, start[0]);
        const endFrom = lineStart(editorView.state.doc, end[0]);

        if (startFrom === null || endFrom === null) {
          return;
        }

        // a column can overrun its line even when the line number is sound,
        // and EditorSelection rejects an out-of-document position
        const docLength = editorView.state.doc.length;
        const bookmarkStart = Math.max(0, Math.min(startFrom + parseInt(start[1], 10) - 1, docLength));
        const bookmarkEnd = Math.max(0, Math.min(endFrom + parseInt(end[1], 10) - 1, docLength));

        editorView.dispatch({
          selection: {
            anchor: bookmarkEnd,
            head: bookmarkStart,
          },
        });
        editorView.dispatch(
          editorView.state.update({
            effects: view.EditorView.scrollIntoView(bookmarkEnd, {
              y: 'center',
              x: 'center',
            }),
          })
        );
      }
    });
  }
}

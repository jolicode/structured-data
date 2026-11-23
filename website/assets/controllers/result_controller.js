import { Controller } from "@hotwired/stimulus";
import { copyWithFeedback } from "../clipboard.js";
import { editorExtensions } from "../editor.js";
import { readState, writeState } from "../pageState.js";
import { audit } from "../php.js";
import { loadSettings, persistSettings } from "../validatorSettings.js";
import { htmlLanguage } from "@codemirror/lang-html";
import { json, jsonLanguage } from "@codemirror/lang-json";
import * as state from "@codemirror/state";
import * as view from "@codemirror/view";
import { configureNesting } from "@lezer/html";

// The page of the validator, public/validator/index.html. Its frame is in the
// page, and shows as it opens: the editor, with the document the page is opened
// with, and the toolbar. PHP takes longer: it has to start, then to audit the
// document. What it answers, the counts and the entities of bin/audit.php, is
// shown in this frame, and again as the document is typed.

// Typing validates the document again, once the visitor pauses. PHP runs in the
// thread of the page, that is frozen meanwhile: a document that takes long to
// audit waits for a longer pause, twice the time of its last audit.
const RUN_DELAY = 300;
const MAX_RUN_DELAY = 2000;

// Lets the page paint what says that PHP runs, before PHP freezes it. A hidden
// tab has no frame to wait for.
const painted = () =>
  new Promise((resolve) => {
    requestAnimationFrame(() => setTimeout(resolve));
    setTimeout(resolve, 100);
  });

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

// A page, or a JSON document: told from where the document starts
const START_LENGTH = 100;
const isPage = (start) => /^\s*</.test(start);
const languageOf = (page) => (page ? html : json());

const violationMarker = new (class extends view.GutterMarker {
  elementClass = "cm-violationLineGutter";
})();

// data-start / data-end carry "line:column" pairs computed by PHP, valid only
// against the exact document it audited. Should the two ever drift
// apart, that must degrade to "no marker" rather than throw: doc.line() raises
// a RangeError.
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
    "copyLink",
    "counts",
    "editor",
    "entity",
    "error",
    "expandButton",
    "formatButton",
    "nodes",
    "pending",
    "settingsWrapper",
    "settingsButton",
    "settingsPanel",
    "settingMergeNodes",
    "settingAllowPending",
    "settingAutoExpandWarnings",
    "showDescriptions",
    "status",
    "warnings",
  ];

  connect() {
    const { showDescriptions } = loadSettings();

    this.showDescriptionsTarget.checked = showDescriptions;
    this.nodesTarget.toggleAttribute("data-hide-descriptions", !showDescriptions);

    // "toggle" does not bubble: caught on its way down, and coalesced, as
    // expanding the whole tree fires one per branch
    this.onBranchToggle = () => {
      cancelAnimationFrame(this.refreshFrame);
      this.refreshFrame = requestAnimationFrame(() => this.refreshExpandButton());
    };
    this.nodesTarget.addEventListener("toggle", this.onBranchToggle, true);

    this.open();
  }

  disconnect() {
    this.nodesTarget.removeEventListener("toggle", this.onBranchToggle, true);
    cancelAnimationFrame(this.refreshFrame);
    clearTimeout(this.runTimeout);
    this.editorView?.destroy();
  }

  /**
   * The document the page is opened with: the one of the homepage, of a link,
   * or of the playground, see pageState.js. The editor shows it at once, then
   * it is validated.
   */
  async open() {
    // what the playground added to the state stays: it opens as it was left
    this.shared = (await readState()) ?? {};

    const body = typeof this.shared.document === "string" ? this.shared.document : "";

    if (body.trim() === "") {
      // nothing to validate: the homepage has the form
      location.replace("../");

      return;
    }

    this.setupEditor(body);
    // the menu opens the playground with the document, validated or not
    this.share(body);
    this.run();
  }

  // What is typed is validated once the visitor pauses, the rest at once
  changed({ now = false } = {}) {
    clearTimeout(this.runTimeout);
    this.runTimeout = setTimeout(() => this.run(), now ? 0 : this.runDelay ?? RUN_DELAY);
  }

  /**
   * Audits what the editor holds, one audit at a time: what changes meanwhile
   * is audited next, and only the last answer is shown.
   */
  async run() {
    // the settings are saved before the page has read its document
    if (!this.editorView) {
      return;
    }

    if (this.running) {
      this.outdated = true;

      return;
    }

    this.running = true;
    // the first validation of the page is said where its result comes
    this.statusTarget.textContent = this.hasPendingTarget ? "" : "Validating…";

    try {
      let answer;
      let body;

      do {
        this.outdated = false;
        await painted();

        body = this.editorView.state.doc.toString();

        const { mergeSharedIdentifiers, allowPendingVocabulary } = loadSettings();
        const start = performance.now();

        try {
          answer = await audit({ body, mergeSharedIdentifiers, allowPendingVocabulary });
        } catch (error) {
          console.error(error);
          answer = { error: "The validator crashed on this document, see the console for details." };
        }

        this.runDelay = Math.min(MAX_RUN_DELAY, Math.max(RUN_DELAY, 2 * (performance.now() - start)));
      } while (this.outdated);

      this.show(answer, body);
    } finally {
      this.running = false;
      this.statusTarget.textContent = "";
    }
  }

  // "counts" and "html" are rendered by PHP, see bin/audit.php
  show({ counts, html, error }, body) {
    this.errorTarget.textContent = error ?? "";
    // the result of the last document that was validated stays, dimmed: it
    // does not blink while the document is being typed
    this.countsTarget.classList.toggle("opacity-40", Boolean(error));
    this.nodesTarget.classList.toggle("opacity-40", Boolean(error));

    if (error) {
      // the first validation of the page: nothing is being validated any more
      if (this.hasPendingTarget) {
        this.pendingTarget.remove();
      }

      return;
    }

    this.countsTarget.innerHTML = counts;

    // what the visitor unfolded stays so, as long as the result keeps its shape
    const unfolded = this.foldable().map((branch) => branch.open);

    // the same result is not rendered again: nothing blinks while typing what
    // does not change it
    if (html !== this.shown) {
      this.nodesTarget.innerHTML = html;
      this.shown = html;
    }

    const foldable = this.foldable();

    if (!this.settingsSaved && unfolded.length > 0 && unfolded.length === foldable.length) {
      foldable.forEach((branch, index) => {
        branch.open = unfolded[index];
      });
    } else {
      this.fold();
    }
    this.settingsSaved = false;

    // nothing to describe, and nothing to expand, when no structured data is found
    this.showDescriptionsTarget.disabled = !this.hasEntityTarget;
    this.expandButtonTarget.disabled = !this.hasEntityTarget;
    this.refreshExpandButton();

    this.markViolations();
    this.share(body);
  }

  /**
   * Writes the document the page is opened with, then each one it audits, in
   * the URL, and in the link of the menu to the playground, that opens with it:
   * see pageState.js. A link to the page audits the document again, with the
   * settings of who opens it.
   */
  async share(document) {
    const shareable = await writeState({ ...this.shared, document });

    // another document took the place of this one meanwhile, and writes its own
    if (shareable === null) {
      return;
    }

    this.copyLinkTarget.disabled = !shareable;
    this.copyLinkTarget.title = shareable
      ? "Copy a link to this result: opening it validates this document again"
      : "This document is too long to be shared in a link";
  }

  copyLink() {
    copyWithFeedback(location.href, this.copyLinkTarget);
  }

  // what folds in the result: the warnings of each entity, and the branches of
  // its property tree
  foldable() {
    return [...this.nodesTarget.querySelectorAll("details")];
  }

  // a result as it first shows, by the settings
  fold() {
    // the errors are always shown, the warnings of an entity are folded
    // unless the settings say otherwise
    const { autoExpandWarnings, expandTree } = loadSettings();

    this.warningsTargets.forEach((warnings) => {
      warnings.open = autoExpandWarnings;
    });

    // the tree is rendered collapsed: expanded again, if "Expand all" was the
    // last choice
    this.treeBranches().forEach((branch) => {
      branch.open = expandTree;
    });
  }

  // the branches of the property tree: the warnings list of an entity is not one
  treeBranches() {
    return [...this.nodesTarget.querySelectorAll('details:not([data-result-target~="warnings"])')];
  }

  // collapses the whole tree as soon as a branch is open, expands it otherwise
  toggleAll() {
    const branches = this.treeBranches();
    const shouldOpen = !branches.some((branch) => branch.open);

    branches.forEach((branch) => {
      branch.open = shouldOpen;
    });

    persistSettings({ expandTree: shouldOpen });
    this.refreshExpandButton();
  }

  refreshExpandButton() {
    const anyOpen = this.treeBranches().some((branch) => branch.open);

    this.expandButtonTarget.textContent = anyOpen ? "Collapse all" : "Expand all";
    this.expandButtonTarget.setAttribute("aria-expanded", anyOpen ? "true" : "false");
  }

  // display only: takes effect at once, without auditing again
  toggleDescriptions() {
    const showDescriptions = this.showDescriptionsTarget.checked;

    this.nodesTarget.toggleAttribute("data-hide-descriptions", !showDescriptions);
    persistSettings({ showDescriptions });
  }

  toggleSettings() {
    if (!this.settingsPanelTarget.classList.contains("hidden")) {
      this.closeSettings();

      return;
    }

    const settings = loadSettings();
    this.settingMergeNodesTarget.checked = settings.mergeSharedIdentifiers;
    this.settingAllowPendingTarget.checked = settings.allowPendingVocabulary;
    this.settingAutoExpandWarningsTarget.checked = settings.autoExpandWarnings;

    this.settingsPanelTarget.classList.remove("hidden");
    this.settingsButtonTarget.setAttribute("aria-expanded", "true");
  }

  closeSettings() {
    this.settingsPanelTarget.classList.add("hidden");
    this.settingsButtonTarget.setAttribute("aria-expanded", "false");
  }

  closeSettingsOnOutsideClick(event) {
    if (!this.settingsWrapperTarget.contains(event.target)) {
      this.closeSettings();
    }
  }

  // audit again so that the settings applied by PHP - merging and pending
  // vocabulary - take effect
  saveSettings() {
    persistSettings({
      mergeSharedIdentifiers: this.settingMergeNodesTarget.checked,
      allowPendingVocabulary: this.settingAllowPendingTarget.checked,
      autoExpandWarnings: this.settingAutoExpandWarningsTarget.checked,
    });

    this.closeSettings();
    // the result shows again as these settings say
    this.settingsSaved = true;
    this.changed({ now: true });
  }

  // the audit reports lines and columns: once the document is reformatted,
  // it is audited again
  async format() {
    if (!this.editorView) {
      return;
    }

    this.formatButtonTarget.disabled = true;

    try {
      // Prettier is as big as the rest of the page: loaded when asked for
      const { formatDocument } = await import("../format.js");
      const { content, error } = await formatDocument(this.editorView.state.doc.toString());

      if (error) {
        this.errorTarget.textContent = error;

        return;
      }

      this.editorView.dispatch({
        changes: { from: 0, to: this.editorView.state.doc.length, insert: content },
      });
      this.changed({ now: true });
    } finally {
      this.formatButtonTarget.disabled = false;
    }
  }

  // the editor of every page, with the language and the gutters of this one
  setupEditor(doc) {
    const languageCompartment = new state.Compartment();

    // the language follows the document: a page can be pasted over a JSON
    // document
    const followDocument = state.EditorState.transactionExtender.of((tr) => {
      const page = isPage(tr.newDoc.sliceString(0, START_LENGTH));

      if (!tr.docChanged || page === isPage(tr.startState.doc.sliceString(0, START_LENGTH))) {
        return null;
      }

      return { effects: languageCompartment.reconfigure(languageOf(page)) };
    });

    // filled by markViolations(), for each result
    this.violations = new state.Compartment();

    this.editorView = new view.EditorView({
      doc,
      parent: this.editorTarget,
      extensions: editorExtensions([
        view.lineNumbers(),
        this.violations.of([]),
        languageCompartment.of(languageOf(isPage(doc.slice(0, START_LENGTH)))),
        followDocument,
        view.EditorView.contentAttributes.of({ "aria-label": "Document" }),
        view.EditorView.updateListener.of((update) => {
          if (update.docChanged) {
            this.changed();
          }
        }),
      ]),
    });
  }

  // marks, in the gutter, the lines of the document that the result reports
  markViolations() {
    const doc = this.editorView.state.doc;
    const positions = new Set();

    this.nodesTarget.querySelectorAll("[data-start][data-invalid]").forEach((node) => {
      // a single range splits to a one-element list, so the pipe-joined and
      // the lone case are the same code
      node.dataset.start.split("|").forEach((start) => {
        const from = lineStart(doc, start.split(":")[0]);

        if (from !== null) {
          positions.add(from);
        }
      });
    });

    const ranges = [...positions].map((from) => violationMarker.range(from));

    this.editorView.dispatch({
      effects: this.violations.reconfigure(view.lineNumberMarkers.of(state.RangeSet.of(ranges, true))),
    });
  }

  // a click on what the result locates selects it in the document
  showInDocument(event) {
    // a link of an issue is followed, not taken for its issue
    const node = event.target.closest("a, [data-start]");

    if (!node || !node.dataset.start || !node.dataset.end) {
      return;
    }

    event.preventDefault();
    // several ranges are joined with a pipe: the first one is selected
    const start = node.dataset.start.split("|")[0].split(":");
    const end = node.dataset.end.split("|")[0].split(":");

    // tested before computing anything, so an approximate range cannot
    // throw on its way to being ignored
    if (start.length > 2 && start[2] === "approx") {
      return;
    }

    const doc = this.editorView.state.doc;
    const startFrom = lineStart(doc, start[0]);
    const endFrom = lineStart(doc, end[0]);

    if (startFrom === null || endFrom === null) {
      return;
    }

    // a column can overrun its line even when the line number is sound,
    // and EditorSelection rejects an out-of-document position
    const bookmarkStart = Math.max(0, Math.min(startFrom + parseInt(start[1], 10) - 1, doc.length));
    const bookmarkEnd = Math.max(0, Math.min(endFrom + parseInt(end[1], 10) - 1, doc.length));

    this.editorView.dispatch({
      selection: {
        anchor: bookmarkEnd,
        head: bookmarkStart,
      },
      effects: view.EditorView.scrollIntoView(bookmarkEnd, {
        y: "center",
        x: "center",
      }),
    });
  }
}

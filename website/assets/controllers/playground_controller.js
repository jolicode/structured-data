import { Controller } from "@hotwired/stimulus";
import { copyWithFeedback } from "../clipboard.js";
import { createEditor } from "../editor.js";
import { OPTIONS, createJsonLdProcessor } from "../jsonLd.js";
import { UNREADABLE, loadUrl } from "../loadUrl.js";
import { readState, writeState } from "../pageState.js";
import { normalizeState } from "../permalink.js";
import { runPlayground } from "../php.js";
import { DEFAULT_EXAMPLE, examples } from "../playgroundExamples.js";

// Typing runs the algorithm again, once the visitor pauses
const RUN_DELAY = 300;

const OUTPUT_LABELS = {
  expand: "Expanded document",
  compact: "Compacted document",
  flatten: "Flattened document",
  frame: "Framed document",
  toRdf: "RDF dataset, as N-Quads",
  fromRdf: "JSON-LD document, from RDF",
};

// A context is served as JSON-LD by content negotiation
const load = async (url) => {
  const answer = await loadUrl(url, { accept: "application/ld+json, application/json;q=0.9" });

  return answer.error === UNREADABLE
    ? { error: "Your browser could not read it: its website has to allow it with CORS headers, and to be reachable." }
    : answer;
};

export default class extends Controller {
  static targets = [
    "contextEditor",
    "contextLabel",
    "contextPanel",
    "copyLink",
    "copyOutput",
    "documentEditor",
    "documentLabel",
    "error",
    "frameEditor",
    "framePanel",
    "option",
    "options",
    "outputEditor",
    "outputLabel",
    "outputPanel",
    "status",
    "tab",
  ];

  async connect() {
    this.process = createJsonLdProcessor({ run: runPlayground, load });
    this.state = normalizeState(examples[DEFAULT_EXAMPLE]);

    this.editors = {
      // The document of every algorithm but one, that reads N-Quads
      document: createEditor({
        parent: this.documentEditorTarget,
        label: "Document",
        onChange: (value) => this.edit(this.state.algorithm === "fromRdf" ? "nquads" : "document", value),
      }),
      context: createEditor({
        parent: this.contextEditorTarget,
        label: "Context",
        onChange: (value) => this.edit("context", value),
      }),
      frame: createEditor({
        parent: this.frameEditorTarget,
        label: "Frame",
        onChange: (value) => this.edit("frame", value),
      }),
      output: createEditor({ parent: this.outputEditorTarget, label: "Output", readOnly: true }),
    };

    // A permalink, or what the menu of the validator opens the playground with
    const shared = await readState();

    if (shared) {
      const state = normalizeState(shared);

      // The N-Quads of the examples, when the link has none: its tab shows something
      this.state = { ...state, nquads: state.nquads || examples.nquads.nquads };
    } else {
      this.state.nquads = examples.nquads.nquads;
    }

    this.render();
    this.run();
  }

  disconnect() {
    clearTimeout(this.runTimeout);
  }

  // The actions of the page

  selectTab({ currentTarget }) {
    this.state.algorithm = currentTarget.dataset.algorithm;
    this.render();
    this.changed({ now: true });
  }

  // The arrows move across the tabs, as in any tab list
  moveTab(event) {
    const tabs = this.tabTargets;
    const index = tabs.indexOf(event.currentTarget);
    const next = { ArrowLeft: index - 1, ArrowRight: index + 1, Home: 0, End: tabs.length - 1 }[event.key];

    if (next === undefined) {
      return;
    }

    event.preventDefault();

    const tab = tabs[(next + tabs.length) % tabs.length];
    tab.focus();
    tab.click();
  }

  loadExample({ currentTarget }) {
    const { label, ...example } = examples[currentTarget.dataset.example];

    // An example is a document with its context and its frame, or some N-Quads:
    // what it does not hold stays
    Object.assign(this.state, example);
    this.render();
    this.changed({ now: true });
  }

  changeOption({ currentTarget }) {
    const name = currentTarget.name;

    if (currentTarget.type === "checkbox") {
      this.state.options[name] = currentTarget.checked;
    } else if (name === "omitGraph") {
      this.state.options[name] = { yes: true, no: false }[currentTarget.value] ?? null;
    } else {
      this.state.options[name] = currentTarget.value;
    }

    this.changed({ now: currentTarget.type !== "text" });
  }

  copyLink() {
    copyWithFeedback(location.href, this.copyLinkTarget);
  }

  copyOutput() {
    copyWithFeedback(this.editors.output.getValue(), this.copyOutputTarget);
  }

  // What they do

  edit(field, value) {
    this.state[field] = value;
    this.changed();
  }

  changed({ now = false } = {}) {
    clearTimeout(this.runTimeout);
    this.runTimeout = setTimeout(() => this.run(), now ? 0 : RUN_DELAY);
  }

  /**
   * Runs the algorithm, one run at a time: PHP runs in the thread of the page.
   * What changes meanwhile is run next, and only the last answer is shown.
   */
  async run() {
    this.writePermalink();

    if (this.running) {
      this.outdated = true;

      return;
    }

    this.running = true;
    this.statusTarget.textContent = this.ran ? "Running…" : "Loading PHP…";

    try {
      let answer;

      do {
        this.outdated = false;

        const { algorithm, document, nquads, context, frame, options } = this.state;

        try {
          answer = await this.process({
            algorithm,
            document: algorithm === "fromRdf" ? nquads : document,
            context,
            frame,
            options,
          });
        } catch (error) {
          console.error(error);
          answer = { error: "The playground crashed on this document, see the console for details." };
        }
      } while (this.outdated);

      this.ran = true;
      this.show(answer);
    } finally {
      this.running = false;
      this.statusTarget.textContent = "";
    }
  }

  show({ output, language, error }) {
    this.errorTarget.textContent = error ?? "";
    this.errorTarget.hidden = !error;
    // The output of the last run that worked stays, dimmed: it does not blink
    // while the document is being typed
    this.outputEditorTarget.classList.toggle("opacity-40", Boolean(error));

    if (error) {
      return;
    }

    this.editors.output.setLanguage(language === "json" ? "json" : "text");
    this.editors.output.setValue(output);
  }

  /**
   * Shows the state: the tab, its editors and its options.
   */
  render() {
    const { algorithm, options } = this.state;
    const fromRdf = algorithm === "fromRdf";

    for (const tab of this.tabTargets) {
      const selected = tab.dataset.algorithm === algorithm;

      tab.setAttribute("aria-selected", String(selected));
      tab.tabIndex = selected ? 0 : -1;

      if (selected) {
        this.outputPanelTarget.setAttribute("aria-labelledby", tab.id);
      }
    }

    this.documentLabelTarget.textContent = fromRdf ? "RDF dataset, as N-Quads" : "JSON-LD document";
    this.editors.document.setLanguage(fromRdf ? "text" : "json");
    this.editors.document.setValue(fromRdf ? this.state.nquads : this.state.document);

    this.contextPanelTarget.hidden = !["compact", "flatten"].includes(algorithm);
    this.contextLabelTarget.textContent = algorithm === "flatten" ? "Context (optional)" : "Context";
    this.editors.context.setValue(this.state.context);

    this.framePanelTarget.hidden = algorithm !== "frame";
    this.editors.frame.setValue(this.state.frame);

    this.outputLabelTarget.textContent = OUTPUT_LABELS[algorithm];

    for (const wrapper of this.optionTargets) {
      const field = wrapper.querySelector("[name]");
      const value = options[field.name];

      wrapper.hidden = !OPTIONS[field.name].algorithms.includes(algorithm);

      if (field.type === "checkbox") {
        field.checked = value;
      } else if (field.name === "omitGraph") {
        field.value = value === null ? "" : value ? "yes" : "no";
      } else {
        field.value = value;
      }
    }

    this.optionsTarget.hidden = this.optionTargets.every((wrapper) => wrapper.hidden);
  }

  async writePermalink() {
    // In the URL, and in the link of the menu to the validator, that validates
    // the document: see pageState.js
    const shareable = await writeState(this.state);

    // Another change came meanwhile, and writes its own
    if (shareable === null) {
      return;
    }

    this.copyLinkTarget.disabled = !shareable;
    this.copyLinkTarget.title = shareable
      ? "Copy a link to this page, with its documents and its options"
      : "These documents are too long to be shared in a link";
  }
}

// The CodeMirror editor of the pages: the result of the validator adds its
// gutter markers to these extensions, the playground makes its editors with
// createEditor().

import * as autocomplete from "@codemirror/autocomplete";
import * as commands from "@codemirror/commands";
import { json } from "@codemirror/lang-json";
import * as language from "@codemirror/language";
import * as state from "@codemirror/state";
import * as view from "@codemirror/view";

const selectionStyle = view.EditorView.baseTheme({
  ".cm-selectionBackground": {
    backgroundColor: "rgb(255 255 100)",
  },
});

/**
 * What every editor is made of. "own" is what an editor adds: its language,
 * its gutters.
 */
export function editorExtensions(own = []) {
  return [
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
    ...own,
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
    selectionStyle,
  ];
}

// "json", or "text" for what has no grammar here, as N-Quads
const languageExtension = (name) => (name === "json" ? json() : []);

// Marks what setValue() writes, that is not typed: onChange is not told
const written = state.Annotation.define();

/**
 * Makes an editor in "parent". "onChange" is given what is typed, "label" names
 * the editor for a screen reader. A read-only editor still takes the focus, to
 * select and copy what it shows.
 */
export function createEditor({ parent, label, doc = "", language: name = "json", readOnly = false, onChange = null }) {
  const languageCompartment = new state.Compartment();

  const editorView = new view.EditorView({
    doc,
    parent,
    extensions: editorExtensions([
      view.lineNumbers(),
      languageCompartment.of(languageExtension(name)),
      state.EditorState.readOnly.of(readOnly),
      view.EditorView.contentAttributes.of({ "aria-label": label }),
      view.EditorView.updateListener.of((update) => {
        if (onChange && update.docChanged && !update.transactions.some((transaction) => transaction.annotation(written))) {
          onChange(update.state.doc.toString());
        }
      }),
    ]),
  });

  return {
    getValue: () => editorView.state.doc.toString(),
    setLanguage(name) {
      editorView.dispatch({ effects: languageCompartment.reconfigure(languageExtension(name)) });
    },
    setValue(value) {
      if (value === editorView.state.doc.toString()) {
        return;
      }

      editorView.dispatch({
        annotations: written.of(true),
        changes: { from: 0, to: editorView.state.doc.length, insert: value },
      });
    },
  };
}

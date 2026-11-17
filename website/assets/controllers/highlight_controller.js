import { Controller } from "@hotwired/stimulus";
// Not 'shiki': it brings every language and theme in the bundle
import { createHighlighterCore } from 'shiki/core'
import { createOnigurumaEngine } from 'shiki/engine/oniguruma'
import { default as javascript } from 'shiki/langs/javascript.mjs'
import { default as monokai } from 'shiki/themes/monokai.mjs'
import { default as shikiWasm } from 'shiki/wasm'

// Created for the first code to highlight: the page does not wait for it
let highlighter = null;

export default class extends Controller {
  initialize() {
    highlighter ??= createHighlighterCore({
        themes: [monokai],
        langs: [javascript],
        engine: createOnigurumaEngine(shikiWasm),
    });

    const highlightedNodes = this.element.querySelectorAll('pre:has(> code[class*="language-"])');

    highlightedNodes.forEach(async (pre) => {
        const highlightedHtmlString = (await highlighter).codeToHtml(pre.textContent, {
            lang: 'javascript',
            theme: 'monokai',
            colorReplacements: {
              '#272822': '#1f2937'
            }
        });

        const parser = new DOMParser();
        const highlightedNode = parser.parseFromString(highlightedHtmlString, "text/html");
        pre.replaceWith(highlightedNode.body.firstChild);
    });
  }
}

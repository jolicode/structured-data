// Pretty-prints the document of the editor, with Prettier. It comes from
// jolicode/structured-data-validator-demo (bin/format-document.js and
// src/Formatter/), that runs it in node.
//
// Loaded on demand by result_controller.js: Prettier is as big as the rest of
// the page.

import * as prettier from "prettier/standalone";
import * as babelPlugin from "prettier/plugins/babel";
import * as estreePlugin from "prettier/plugins/estree";
import * as htmlPlugin from "prettier/plugins/html";
import { indentTolerantly } from "./tolerant-html.js";

// Prettier's memory use grows with the input, and the editor struggles well
// before this anyway.
const MAX_DOCUMENT_SIZE = 1024 * 1024;

// Mirrors JsonLdNodeExtractor::looksLikeRawJsonDocument(), so that the
// formatter and the extractor classify a document the same way.
const HTML_TAG_RE = /<\s*(?:!doctype|html|head|body|script|meta|div|span|section|article|main)\b/i;

// Same shape as JsonLdNodeExtractor::extractJsonLdNodes(), split so that the
// payload can be replaced without touching the surrounding tags.
const JSON_LD_SCRIPT_RE =
  /(<script[^>]+type=["']application\/ld\+json["'][^>]*>)([\s\S]*?)(<\/script\s*>)/gi;

const OPTIONS = {
  plugins: [babelPlugin, estreePlugin, htmlPlugin],
  tabWidth: 2,
  useTabs: false,
  endOfLine: "lf",
  htmlWhitespaceSensitivity: "css",
  bracketSameLine: true,
  embeddedLanguageFormatting: "auto",
};

// Prettier fills text nodes up to printWidth, and that is the one thing this
// formatter must never do: MicrodataExtractor reads element text content as
// property values, so re-wrapping a long description injects a newline into
// the value the validator then reports. A width no document reaches disables
// filling outright, while the structural line breaks between elements - the
// ones that make a minified page readable - happen regardless of it.
const HTML_PRINT_WIDTH = 1000000;

// The JSON-LD payloads, on the other hand, want a normal width. They are
// expanded first, in expandJsonLdPayloads() below, because Prettier keeps an
// object that already spans several lines expanded whatever printWidth says -
// which is how both settings hold at once in a single document.
//
// Note that Prettier's json parser reprints the source tokens rather than
// re-encoding decoded values, so large integers survive where a
// JSON.parse/JSON.stringify round trip would silently round them off. It does
// normalise number literals though: 1.50 is reprinted as 1.5.
const JSON_PRINT_WIDTH = 120;

const INVALID_JSON = "This document holds invalid JSON, so it is left as it is: the validator says where.";
const TOO_LARGE = "This document is too large to be reformatted.";

/**
 * Resolves with the { content } to put in the editor, or with the { error }
 * that says why the document is left as it is.
 */
export async function formatDocument(document) {
  if (document.trim() === "") {
    return { content: document };
  }

  if (new TextEncoder().encode(document).length > MAX_DOCUMENT_SIZE) {
    return { error: TOO_LARGE };
  }

  if (looksLikeRawJsonDocument(document.trim())) {
    if (!isValidJson(document)) {
      return { error: INVALID_JSON };
    }

    return { content: await formatJson(document) };
  }

  // A structured data validator must report syntax errors where they are, so
  // a document holding invalid JSON is never formatted.
  if (hasInvalidJsonLdPayload(document)) {
    return { error: INVALID_JSON };
  }

  const expanded = await expandJsonLdPayloads(document);

  try {
    return {
      content: await prettier.format(expanded, {
        ...OPTIONS,
        parser: "html",
        printWidth: HTML_PRINT_WIDTH,
      }),
    };
  } catch (error) {
    // Prettier's HTML parser is stricter than any browser, and real pages
    // trip it often: fall back to a re-indenter that cannot fail, and that
    // repairs nothing.
    console.warn(error);

    return { content: indentTolerantly(expanded, { tabWidth: OPTIONS.tabWidth }) };
  }
}

function looksLikeRawJsonDocument(trimmed) {
  if (trimmed[0] !== "{" && trimmed[0] !== "[") {
    return false;
  }

  return !HTML_TAG_RE.test(trimmed);
}

function isValidJson(json) {
  try {
    JSON.parse(json);
  } catch {
    return false;
  }

  return true;
}

function hasInvalidJsonLdPayload(document) {
  for (const match of document.matchAll(JSON_LD_SCRIPT_RE)) {
    if (match[2].trim() !== "" && !isValidJson(match[2])) {
      return true;
    }
  }

  return false;
}

// Prettier keeps an object expanded when the source already had a line break
// after its opening brace, and collapses it onto one line otherwise - so a
// short minified payload would come back exactly as minified as it went in.
// Putting that line break in is how you ask for the expanded form; there is no
// option for it.
function formatJson(json) {
  return prettier.format(json.replace(/^(\s*\{)(?!\s*\n)/, "$1\n"), {
    ...OPTIONS,
    parser: "json",
    printWidth: JSON_PRINT_WIDTH,
  });
}

// Expands every embedded JSON-LD payload, leaving every other byte of the
// document alone. Runs before the HTML pass, see JSON_PRINT_WIDTH.
async function expandJsonLdPayloads(document) {
  let result = "";
  let cursor = 0;

  for (const match of document.matchAll(JSON_LD_SCRIPT_RE)) {
    const payload = match[2];

    if (payload.trim() === "") {
      continue;
    }

    const start = match.index + match[1].length;
    const expanded = await formatJson(payload);

    // the HTML pass re-indents this block, so a bare newline on each side is
    // all that is needed here
    result += `${document.slice(cursor, start)}\n${expanded.trim()}\n`;
    cursor = start + payload.length;
  }

  return result + document.slice(cursor);
}

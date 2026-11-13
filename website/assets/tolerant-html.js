// A deliberately unfussy HTML re-indenter, used by format.js when Prettier
// refuses a document. It comes from jolicode/structured-data-validator-demo
// (bin/tolerant-html.js).
//
// Prettier's parser is stricter than any browser: a stray </source>, an
// unclosed <span>, a lost space in "<spanitemprop=" and it declines the whole
// file. Real pages do all of that, and this application is a validator - being
// handed malformed markup is the job, not the exception. So this pass trades
// Prettier's polish for never failing.
//
// The two rules it will not break, because the validator depends on them:
//
//  1. Nothing is ever repaired. Tags come out exactly as they went in,
//     malformed ones included, so the document keeps saying what it said.
//  2. Text is never re-wrapped and never edited. Line breaks are only ever
//     inserted between elements, never inside a run of text, because microdata
//     reads element text content as property values.

// Elements that get a line of their own. Everything not named here - including
// anything malformed enough that its tag name is nonsense - is treated as
// inline and left where it is, which is the forgiving default.
const BLOCK_ELEMENTS = new Set([
  "address", "article", "aside", "base", "blockquote", "body", "canvas",
  "caption", "col", "colgroup", "dd", "details", "dialog", "div", "dl", "dt",
  "fieldset", "figcaption", "figure", "footer", "form", "h1", "h2", "h3", "h4",
  "h5", "h6", "head", "header", "hgroup", "hr", "html", "iframe", "legend",
  "li", "link", "main", "meta", "nav", "noscript", "ol", "optgroup", "option",
  "p", "picture", "script", "section", "select", "source", "style", "summary",
  "table", "tbody", "td", "tfoot", "th", "thead", "title", "tr", "ul", "video",
]);

// No end tag, so they never open a level
const VOID_ELEMENTS = new Set([
  "area", "base", "br", "col", "embed", "hr", "img", "input", "link", "meta",
  "param", "source", "track", "wbr",
]);

// Contents are data, not markup: copied through untouched
const RAW_TEXT_ELEMENTS = new Set(["script", "style", "pre", "textarea"]);

function tagName(tag) {
  const match = /^<\/?\s*([^\s/>]+)/.exec(tag);

  return match ? match[1].toLowerCase() : "";
}

/**
 * Splits the document into tags, text, comments and raw-text blocks. Anything
 * it cannot make sense of comes back as text, which is what keeps it total.
 */
function tokenize(html) {
  const tokens = [];
  let index = 0;

  const pushText = (value) => {
    if ("" === value) {
      return;
    }

    const last = tokens[tokens.length - 1];

    if (last && "text" === last.type) {
      last.value += value;
    } else {
      tokens.push({ type: "text", value });
    }
  };

  while (index < html.length) {
    const next = html.indexOf("<", index);

    if (next === -1) {
      pushText(html.slice(index));
      break;
    }

    if (next > index) {
      pushText(html.slice(index, next));
    }

    const rest = html.slice(next);

    const comment = /^<!--[\s\S]*?-->/.exec(rest);
    if (comment) {
      tokens.push({ type: "comment", value: comment[0] });
      index = next + comment[0].length;
      continue;
    }

    const declaration = /^<![^>]*>/.exec(rest);
    if (declaration) {
      tokens.push({ type: "declaration", value: declaration[0] });
      index = next + declaration[0].length;
      continue;
    }

    const tag = /^<\/?[^\s/>][^>]*>/.exec(rest);
    if (!tag) {
      // a bare "<" in text: not a tag, so it is text
      pushText("<");
      index = next + 1;
      continue;
    }

    const name = tagName(tag[0]);
    const closing = "/" === tag[0][1];

    if (!closing && RAW_TEXT_ELEMENTS.has(name)) {
      const after = next + tag[0].length;
      const end = new RegExp(`</\\s*${name}\\s*>`, "i").exec(html.slice(after));
      // an unterminated raw-text element swallows the rest of the document,
      // which is exactly what a browser does too
      const body = end ? html.slice(after, after + end.index) : html.slice(after);
      const closer = end ? end[0] : "";

      tokens.push({ type: "raw", name, open: tag[0], body, close: closer });
      index = after + body.length + closer.length;
      continue;
    }

    tokens.push({
      type: "tag",
      name,
      closing,
      selfClosing: tag[0].endsWith("/>") || VOID_ELEMENTS.has(name),
      value: tag[0],
    });
    index = next + tag[0].length;
  }

  return tokens;
}

export function indentTolerantly(html, { tabWidth = 2 } = {}) {
  const tokens = tokenize(html);
  const lines = [];
  let current = "";
  let depth = 0;

  const pad = (level) => " ".repeat(Math.max(0, level) * tabWidth);

  const flush = () => {
    if ("" !== current.trim()) {
      lines.push(current);
    }

    current = "";
  };

  const startLine = (level) => {
    flush();
    current = pad(level);
  };

  for (const token of tokens) {
    if ("text" === token.type) {
      // whitespace between elements is layout, not content: it is the one
      // thing safe to drop, and dropping it is what lets the indentation read
      if ("" === token.value.trim()) {
        continue;
      }

      // Same reasoning at the edges of a text run: a whitespace run holding a
      // newline is indentation, so it goes, while a plain space is content and
      // stays - "</span> -by <span>" has to keep both of its spaces. Dropping
      // these is also what makes a second pass reproduce the first one exactly,
      // instead of re-indenting its own indentation.
      current += token.value.replace(/^[^\S\n]*\n\s*/, "").replace(/\s*\n[^\S\n]*$/, "");
      continue;
    }

    if ("raw" === token.type) {
      startLine(depth);
      current += token.open;

      if ("" !== token.body.trim()) {
        // the body is data; re-indent its existing lines but never touch what
        // is on them, and leave single-line bodies exactly where they are
        const body = token.body.replace(/^\n+|\s+$/g, "");

        if (body.includes("\n")) {
          flush();
          const inner = pad(depth + 1);
          const shortest = Math.min(
            ...body.split("\n").filter((l) => "" !== l.trim()).map((l) => /^\s*/.exec(l)[0].length),
          );

          for (const line of body.split("\n")) {
            lines.push("" === line.trim() ? "" : inner + line.slice(shortest));
          }

          current = pad(depth);
        } else {
          current += body;
        }
      }

      current += token.close;
      startLine(depth);
      continue;
    }

    if ("declaration" === token.type || "comment" === token.type) {
      startLine(depth);
      current += token.value;
      startLine(depth);
      continue;
    }

    // A void element never opened a level, so its end tag must not close one.
    // Browsers ignore </source> and </br> outright, and it is precisely this
    // kind of tag that makes Prettier walk away, so treat it as the no-op it
    // is: no indentation change, and no line of its own either. It is still
    // emitted, unrepaired, like every other tag.
    if (token.closing && VOID_ELEMENTS.has(token.name)) {
      if ("" === current.trim() && lines.length > 0) {
        lines[lines.length - 1] += token.value;
      } else {
        current += token.value;
      }

      continue;
    }

    if (!BLOCK_ELEMENTS.has(token.name)) {
      current += token.value;
      continue;
    }

    if (token.closing) {
      // stray closers are common in the documents that get this far, and must
      // not push the indentation into negative territory
      depth = Math.max(0, depth - 1);

      // a block close that ends a line of inline content stays on that line
      if ("" === current.trim()) {
        startLine(depth);
      }

      current += token.value;
      startLine(depth);
      continue;
    }

    startLine(depth);
    current += token.value;

    if (!token.selfClosing) {
      depth += 1;
    }

    // the next line opens already indented, so inline content that follows a
    // block tag lands under it instead of at column zero
    startLine(depth);
  }

  flush();

  return lines.join("\n") + "\n";
}

// Loads the document of a URL, without the DOM: home.js wires it to the page,
// the playground loads the remote contexts of a document with it, see
// jsonLd.js, and tests/loadUrl.test.mjs tests it in node.
//
// A browser only lets a page read another website when that website allows it,
// with CORS headers, and most do not. Loading any page needs a server, a CORS
// proxy: it would be a second try here, when the website refuses.

// The one of bin/audit.php, that refuses a larger document
const MAX_DOCUMENT_SIZE = 2 * 1024 * 1024;

const TIMEOUT = 15_000;

const INVALID_URL = "Please enter the URL of a page, starting with http:// or https://.";
const TOO_LARGE = "This document is too large to be validated.";
// fetch does not say whether the website refused, or the network failed.
// Exported for the playground, that says it of a context, not of a page.
export const UNREADABLE =
  "This page could not be read from your browser: most websites do not let another website read their pages. Paste its source code instead.";

// A page, or a JSON-LD document
const ACCEPT = "text/html,application/ld+json,application/json;q=0.9,*/*;q=0.8";

/**
 * Resolves with the { body } of the document, or the { error } that says why
 * it is not loaded. "accept" is what is asked for: the playground asks for
 * JSON-LD, as a context is often served by content negotiation.
 */
export async function loadUrl(url, { accept = ACCEPT } = {}) {
  const target = httpUrl(url);
  if (target === null) {
    return { error: INVALID_URL };
  }

  const response = await fetch(target, {
    // A website that allows every origin is refused when cookies are sent
    credentials: "omit",
    // A safelisted header: the browser does not ask the website first
    headers: { Accept: accept },
    signal: AbortSignal.timeout(TIMEOUT),
  }).catch(() => null);

  if (response === null) {
    return { error: UNREADABLE };
  }

  const contentType = response.headers.get("Content-Type") ?? "";

  if (!response.ok) {
    return refuse(response, `This page answered with the HTTP status ${response.status}.`);
  }
  if (contentType && !/html|json|^text\//i.test(contentType)) {
    return refuse(response, "This URL is neither a HTML page nor a JSON document.");
  }
  if (Number(response.headers.get("Content-Length")) > MAX_DOCUMENT_SIZE) {
    return refuse(response, TOO_LARGE);
  }

  const buffer = await response.arrayBuffer().catch(() => null);

  if (buffer === null) {
    return { error: UNREADABLE };
  }
  if (buffer.byteLength > MAX_DOCUMENT_SIZE) {
    return { error: TOO_LARGE };
  }

  return { body: decode(new Uint8Array(buffer), contentType) };
}

function httpUrl(url) {
  try {
    const { protocol, href } = new URL(url.trim());

    return protocol === "http:" || protocol === "https:" ? href : null;
  } catch {
    return null;
  }
}

function refuse(response, error) {
  // Not downloaded any further
  response.body?.cancel().catch(() => {});

  return { error };
}

// response.text() reads everything as UTF-8: the charset is the one of the
// Content-Type header, or the one a HTML page declares in its first bytes
function decode(bytes, contentType) {
  const charset =
    /charset\s*=\s*"?([^\s;"]+)/i.exec(contentType)?.[1] ??
    /<meta[^>]+charset\s*=\s*["']?([\w-]+)/i.exec(new TextDecoder("latin1").decode(bytes.subarray(0, 1024)))?.[1];

  try {
    return new TextDecoder(charset).decode(bytes);
  } catch {
    // A charset that the browser does not know
    return new TextDecoder().decode(bytes);
  }
}

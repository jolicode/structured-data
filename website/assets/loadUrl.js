// Loads the document of a URL, without the DOM: home.js wires it to the
// homepage, the playground loads the remote contexts of a document with it,
// see jsonLd.js, and tests/loadUrl.test.mjs tests it in node.
//
// A browser only lets a page read another website when that website allows it,
// with CORS headers, and most do not. The homepage loads a page with
// loadPage(), by the proxy of the website: a server, that any website answers
// to. The playground loads its contexts with loadUrl(), by the browser.

// Where the proxy answers, on the host of the website. It is not part of this
// repository: see the README.
const PROXY = "/load-url";

// The one of bin/audit.php, that refuses a larger document
const MAX_DOCUMENT_SIZE = 2 * 1024 * 1024;

const TIMEOUT = 15_000;

const INVALID_URL = "Please enter the URL of a page, starting with http:// or https://.";
const TOO_LARGE = "This document is too large to be validated.";
const UNSUPPORTED = "This URL is neither a HTML page nor a JSON document.";
const httpStatus = (status) => `This page answered with the HTTP status ${status}.`;
// fetch does not say whether the website refused, or the network failed.
// Exported for the playground, that says it of a context, not of a page.
export const UNREADABLE = "This URL could not be loaded.";
const UNAVAILABLE = "Loading a page is not available for now.";

// The error of a page that is not loaded, though the validator may read it:
// the homepage advises to paste its source code, or to validate it elsewhere.
// A document the validator refuses, too large or not a page, is not one.
const pasteable = (error) => ({ error, pasteable: true });

// What the proxy answers when it does not load the page
const PROXY_ERRORS = {
  forbidden_target: pasteable("This URL can not be loaded: only the public websites are, on their standard port."),
  rate_limited: pasteable("Too many pages were loaded lately: try again in a minute."),
  too_large: { error: TOO_LARGE },
  unreachable: pasteable(UNREADABLE),
  unsupported_type: { error: UNSUPPORTED },
};

// A page, or a JSON-LD document
const ACCEPT = "text/html,application/ld+json,application/json;q=0.9,*/*;q=0.8";

/**
 * Resolves with the { body } of the page, or the { error } that says why it is
 * not loaded, "pasteable" when pasting the page would work. The page is loaded
 * by the proxy, or by the browser, as loadUrl() does, where there is no proxy:
 * the website served by a static host alone.
 */
export async function loadPage(url) {
  const target = httpUrl(url);
  if (target === null) {
    return { error: INVALID_URL };
  }

  const response = await fetch(PROXY, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ url: target }),
    signal: AbortSignal.timeout(TIMEOUT),
  }).catch(() => null);

  // The proxy signs what it answers: a static host answers a 404 or a 405
  // here, and some of them a page
  if (response === null || !response.headers.has("X-Load-Url")) {
    response?.body?.cancel().catch(() => {});

    return loadUrl(target);
  }

  if (!response.ok) {
    const { error, status } = await response.json().catch(() => ({}));

    return error === "http_status" && Number.isInteger(status) ? pasteable(httpStatus(status)) : (PROXY_ERRORS[error] ?? pasteable(UNAVAILABLE));
  }

  return read(response, response.headers.get("X-Load-Url-Content-Type") ?? "", UNAVAILABLE);
}

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
    return pasteable(UNREADABLE);
  }

  const contentType = response.headers.get("Content-Type") ?? "";

  if (!response.ok) {
    return refuse(response, pasteable(httpStatus(response.status)));
  }
  if (contentType && !/html|json|^text\//i.test(contentType)) {
    return refuse(response, { error: UNSUPPORTED });
  }
  if (Number(response.headers.get("Content-Length")) > MAX_DOCUMENT_SIZE) {
    return refuse(response, { error: TOO_LARGE });
  }

  return read(response, contentType, UNREADABLE);
}

// The document a response holds, served as "contentType". "failure" is the
// error of a download that stops halfway.
async function read(response, contentType, failure) {
  const buffer = await response.arrayBuffer().catch(() => null);

  if (buffer === null) {
    return pasteable(failure);
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

function refuse(response, refusal) {
  // Not downloaded any further
  response.body?.cancel().catch(() => {});

  return refusal;
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

// The state of the playground, in the fragment of its URL, without the DOM:
// controllers/playground_controller.js wires it to the page, and the result of
// the validator opens the playground with it, tests/permalink.test.mjs tests it
// in node.
//
// The fragment is a version, then the state as JSON, compressed and written in
// base64url: "1" when the browser compresses (deflate), "0" when it can not.

import { ALGORITHMS, normalizeOptions } from "./jsonLd.js";

// What a fragment may decompress to: a few bytes can inflate to gigabytes
const MAX_STATE_SIZE = 4 * 1024 * 1024;

/**
 * The state as the playground expects it, whatever is given: a fragment is
 * written by anyone.
 */
export function normalizeState(given) {
  const text = (value) => (typeof value === "string" ? value : "");

  return {
    algorithm: ALGORITHMS.includes(given?.algorithm) ? given.algorithm : "expand",
    document: text(given?.document),
    nquads: text(given?.nquads),
    context: text(given?.context),
    frame: text(given?.frame),
    options: normalizeOptions(given?.options),
  };
}

/**
 * Resolves with the fragment of a state, without its "#".
 */
export async function encodeState(state) {
  const bytes = new TextEncoder().encode(JSON.stringify(state));

  if (typeof CompressionStream === "undefined") {
    return "0" + toBase64Url(bytes);
  }

  return "1" + toBase64Url(await through(bytes, new CompressionStream("deflate-raw")));
}

/**
 * Resolves with the state of a fragment, or null when it holds none.
 */
export async function decodeState(fragment) {
  const encoded = fragment.replace(/^#/, "");

  try {
    let bytes = fromBase64Url(encoded.slice(1));

    if (encoded[0] === "1") {
      bytes = await through(bytes, new DecompressionStream("deflate-raw"));
    } else if (encoded[0] !== "0") {
      return null;
    }

    const state = JSON.parse(new TextDecoder().decode(bytes));

    return state !== null && typeof state === "object" && !Array.isArray(state) ? normalizeState(state) : null;
  } catch {
    // Not a state: a fragment of another kind, or one cut by a mail client
    return null;
  }
}

async function through(bytes, stream) {
  const reader = new Blob([bytes]).stream().pipeThrough(stream).getReader();
  const chunks = [];
  let size = 0;

  for (;;) {
    const { done, value } = await reader.read();

    if (done) {
      return new Uint8Array(await new Blob(chunks).arrayBuffer());
    }

    size += value.length;

    if (size > MAX_STATE_SIZE) {
      await reader.cancel();

      throw new RangeError("The state is too large.");
    }

    chunks.push(value);
  }
}

function toBase64Url(bytes) {
  let binary = "";

  // Not all at once: the arguments of a call are limited
  for (let offset = 0; offset < bytes.length; offset += 0x8000) {
    binary += String.fromCharCode(...bytes.subarray(offset, offset + 0x8000));
  }

  return btoa(binary).replaceAll("+", "-").replaceAll("/", "_").replace(/=+$/, "");
}

function fromBase64Url(encoded) {
  return Uint8Array.from(atob(encoded.replaceAll("-", "+").replaceAll("_", "/")), (character) => character.charCodeAt(0));
}

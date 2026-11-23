// The state that the validator and the playground share: the document, and
// what the playground adds to it. Each page writes it in the fragment of its
// URL, see permalink.js, and in the link of the menu to the other page, that
// opens with the same document.
//
// A state too long for a link is kept in the session storage of the tab
// instead, and the fragment says so: the page still opens the other one, and
// reloads, but its link can not be shared.

import { decodeState, shareableFragment } from "./permalink.js";

// The fragment of a state that is in the session storage
const LOCAL = "local";
const STORAGE_KEY = "structured-data-state";

// The links of the menu that carry the state
const LINKS = "a[data-state-link]";

let lastWrite = 0;

/**
 * Resolves with the state the page is opened with, or null when there is none.
 * Nothing in it is to be trusted: a fragment is written by anyone.
 */
export async function readState() {
  if (location.hash !== `#${LOCAL}`) {
    return decodeState(location.hash);
  }

  try {
    const state = JSON.parse(sessionStorage.getItem(STORAGE_KEY));

    return state !== null && typeof state === "object" && !Array.isArray(state) ? state : null;
  } catch {
    // No storage, or not a state
    return null;
  }
}

/**
 * The "#" and the fragment of a state: the one of a link when it is given, the
 * one that says the state is in the session storage, where it is put, or
 * nothing when it can be in neither.
 */
function hashOf(state, fragment) {
  if (fragment !== null) {
    return `#${fragment}`;
  }

  try {
    sessionStorage.setItem(STORAGE_KEY, JSON.stringify(state));

    return `#${LOCAL}`;
  } catch {
    // No storage, or no room in it
    return "";
  }
}

/**
 * Resolves with the URL that opens a page with a state.
 */
export async function stateUrl(page, state) {
  return page + hashOf(state, await shareableFragment(state));
}

/**
 * Writes the state of the page in its URL, and in the links of its menu.
 * Resolves with whether a link can hold it, or with null when another state was
 * written meanwhile.
 */
export async function writeState(state) {
  const write = ++lastWrite;
  const fragment = await shareableFragment(state);

  if (write !== lastWrite) {
    return null;
  }

  const hash = hashOf(state, fragment);

  history.replaceState(null, "", hash || location.pathname + location.search);

  for (const link of document.querySelectorAll(LINKS)) {
    link.hash = hash;
  }

  return fragment !== null;
}

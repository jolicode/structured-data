// The library in PHP WebAssembly, without the DOM: app.js and playground.js
// wire it to their page, tests/page.test.mjs and tests/playground.test.mjs
// test it in node.

// Built next to this module, in public/build: see .castor/website.php
import createPhp from "./php-web.mjs";

// Where .castor/website.php embeds them
const AUDIT_SCRIPT = "/app/bin/audit.php";
const PLAYGROUND_SCRIPT = "/app/bin/playground.php";

// Loading starts with the page, the first run waits for it
const loadingPhp = createPhp();

// Both scripts read their request on stdin, and answer on stdout, as JSON
async function run(script, request) {
  const php = await loadingPhp;
  const { exitCode, stdout, stderr } = await php.runFile(script, { stdin: JSON.stringify(request) });

  if (stderr) {
    console.error(stderr);
  }
  if (exitCode !== 0) {
    throw new Error(`PHP exited with status ${exitCode}, see the console for details.`);
  }

  return JSON.parse(stdout);
}

/**
 * Resolves with what bin/audit.php answers: the { html } of the result, or the
 * { error } that says why the document is not audited.
 */
export function audit({ body, mergeSharedIdentifiers, allowPendingVocabulary }) {
  return run(AUDIT_SCRIPT, { allowPendingVocabulary, body, mergeSharedIdentifiers });
}

/**
 * Resolves with what bin/playground.php answers: the { output } of a JSON-LD
 * algorithm, the { error } that says why there is none, or the { missing }
 * documents to fetch first. assets/jsonLd.js fetches them, and asks again.
 */
export function runPlayground({ algorithm, document, context, frame, options, documents }) {
  return run(PLAYGROUND_SCRIPT, { algorithm, context, document, documents, frame, options });
}

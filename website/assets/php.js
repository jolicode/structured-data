// The validator in PHP WebAssembly, without the DOM: app.js wires it to the
// page, tests/page.test.mjs tests it in node.

// Built next to this module, in public/build: see .castor/website.php
import createPhp from "./php-web.mjs";

// Where .castor/website.php embeds it
const AUDIT_SCRIPT = "/app/bin/audit.php";

// Loading starts with the page, the first audit waits for it
const loadingPhp = createPhp();

/**
 * Resolves with what bin/audit.php answers: the { html } of the result, or the
 * { error } that says why the document is not audited.
 */
export async function audit({ body, mergeSharedIdentifiers, allowPendingVocabulary }) {
  const php = await loadingPhp;
  const { exitCode, stdout, stderr } = await php.runFile(AUDIT_SCRIPT, {
    stdin: JSON.stringify({ allowPendingVocabulary, body, mergeSharedIdentifiers }),
  });

  if (stderr) {
    console.error(stderr);
  }
  if (exitCode !== 0) {
    throw new Error(`PHP exited with status ${exitCode}, see the console for details.`);
  }

  return JSON.parse(stdout);
}

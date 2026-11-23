// Runs a JSON-LD algorithm, with the remote contexts of the document, without
// the DOM: playground.js wires it to the page, tests/playground.test.mjs tests
// it in node.
//
// PHP WebAssembly has no network. bin/playground.php answers with the documents
// it misses, a remote context most of the time: they are fetched here, by the
// browser, and PHP is asked again with them, until it misses nothing. A context
// that loads another one is found this way too.

// What a single document may load: each one is a run of PHP more
export const MAX_DOCUMENTS = 20;

export const ALGORITHMS = ["expand", "compact", "flatten", "frame", "toRdf", "fromRdf"];

// The options of bin/playground.php, and the algorithms that read them
export const OPTIONS = {
  base: { default: "", algorithms: ["expand", "compact", "flatten", "frame", "toRdf"] },
  ordered: { default: false, algorithms: ["expand", "compact", "frame", "toRdf", "fromRdf"] },
  compactArrays: { default: true, algorithms: ["compact", "flatten", "frame"] },
  compactToRelative: { default: true, algorithms: ["compact", "flatten"] },
  // null lets the algorithm decide: omitted, in JSON-LD 1.1
  omitGraph: { default: null, values: [null, true, false], algorithms: ["frame"] },
  produceGeneralizedRdf: { default: false, algorithms: ["toRdf"] },
  rdfDirection: { default: "", values: ["", "i18n-datatype", "compound-literal"], algorithms: ["toRdf", "fromRdf"] },
  useNativeTypes: { default: false, algorithms: ["fromRdf"] },
  useRdfType: { default: false, algorithms: ["fromRdf"] },
};

export const defaultOptions = () =>
  Object.fromEntries(Object.entries(OPTIONS).map(([name, option]) => [name, option.default]));

/**
 * The options as bin/playground.php expects them, whatever is given: the ones
 * of a permalink are written by anyone.
 */
export function normalizeOptions(given) {
  const options = defaultOptions();

  for (const [name, { default: byDefault, values }] of Object.entries(OPTIONS)) {
    const value = given?.[name];

    if (values ? values.includes(value) : typeof value === typeof byDefault) {
      options[name] = value;
    }
  }

  return options;
}

/**
 * Gives the function that runs an algorithm. "run" is the runPlayground() of
 * php.js, "load" resolves with the { body } of a URL, or the { error } that
 * says why it is not loaded, as loadUrl() does.
 *
 * The function resolves with the { output } of the algorithm and its
 * { language }, or the { error } that says why there is none.
 */
export function createJsonLdProcessor({ run, load }) {
  // What was fetched, for as long as the page lives: typing in the document
  // runs the algorithm again, not the requests
  const fetched = new Map();
  // What the last run read, given again without waiting for PHP to miss it
  let needed = [];

  return async function process({ algorithm, document, context = "", frame = "", options = {} }) {
    const documents = Object.fromEntries(needed.map((url) => [url, fetched.get(url)]));

    // Each run gives PHP one document more, at least: it ends
    for (;;) {
      const answer = await run({ algorithm, document, context, frame, options: normalizeOptions(options), documents });

      if (!answer.missing?.length) {
        if (answer.loaded) {
          needed = answer.loaded;
        }

        return answer;
      }

      for (const url of answer.missing) {
        if (Object.keys(documents).length >= MAX_DOCUMENTS) {
          return { error: `This document loads more than ${MAX_DOCUMENTS} remote documents.` };
        }

        if (!fetched.has(url)) {
          const { body, error } = await load(url);

          if (error) {
            return { error: `${url} could not be loaded. ${error}` };
          }

          fetched.set(url, body);
        }

        documents[url] = fetched.get(url);
      }
    }
  };
}

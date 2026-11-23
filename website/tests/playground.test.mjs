import assert from 'node:assert/strict';
import { test } from 'node:test';

import { ALGORITHMS, MAX_DOCUMENTS, createJsonLdProcessor } from '../assets/jsonLd.js';
import { examples } from '../assets/playgroundExamples.js';
import { runPlayground } from '../public/build/php.js';

// Runs assets/jsonLd.js, as the playground does, in node, on what
// "castor website:build" built: bin/playground.php in PHP WebAssembly. Run with
// "castor website:check". Nothing is fetched: "load" answers what a website would.

const person = '{"@context": "https://schema.org", "@id": "https://example.com/ada", "@type": "Person", "name": "Ada"}';

// The contexts of a website: the body of each URL
const website = (pages) => async (url) => (url in pages ? { body: pages[url] } : { error: 'This page answered with the HTTP status 404.' });

// A processor, the URLs it loads, and the number of times it runs PHP
const processor = (load = website({})) => {
    const loaded = [];
    const counts = { runs: 0 };

    const process = createJsonLdProcessor({
        run: (request) => {
            counts.runs++;

            return runPlayground(request);
        },
        load: (url) => {
            loaded.push(url);

            return load(url);
        },
    });

    return { process, loaded, counts };
};

const output = async (request, load) => {
    const answer = await processor(load).process(request);

    assert.equal(answer.error, undefined);

    return 'json' === answer.language ? JSON.parse(answer.output) : answer.output;
};

test('expands a document', async () => {
    assert.deepEqual(await output({ algorithm: 'expand', document: person }), [
        { '@id': 'https://example.com/ada', '@type': ['http://schema.org/Person'], 'http://schema.org/name': [{ '@value': 'Ada' }] },
    ]);
});

test('compacts a document with a context', async () => {
    const context = '{"@context": {"schema": "http://schema.org/", "name": "schema:name"}}';

    assert.deepEqual(await output({ algorithm: 'compact', document: person, context }), {
        '@context': { schema: 'http://schema.org/', name: 'schema:name' },
        '@id': 'https://example.com/ada',
        '@type': 'schema:Person',
        name: 'Ada',
    });
});

test('flattens a document, and compacts it when there is a context', async () => {
    const document = '{"@context": "https://schema.org", "@id": "https://example.com/ada", "knows": {"@id": "https://example.com/charles", "name": "Charles"}}';

    assert.deepEqual(await output({ algorithm: 'flatten', document }), [
        { '@id': 'https://example.com/ada', 'http://schema.org/knows': [{ '@id': 'https://example.com/charles' }] },
        { '@id': 'https://example.com/charles', 'http://schema.org/name': [{ '@value': 'Charles' }] },
    ]);
    assert.deepEqual(await output({ algorithm: 'flatten', document, context: '{"@context": {"@vocab": "http://schema.org/"}}' }), {
        '@context': { '@vocab': 'http://schema.org/' },
        '@graph': [
            { '@id': 'https://example.com/ada', knows: { '@id': 'https://example.com/charles' } },
            { '@id': 'https://example.com/charles', name: 'Charles' },
        ],
    });
});

test('frames a document', async () => {
    const framed = await output({ algorithm: 'frame', document: examples.articleGraph.document, frame: examples.articleGraph.frame });

    assert.equal(framed.type, 'Article');
    assert.equal(framed.author.name, 'Ada Lovelace');
    assert.equal(framed.publisher.name, 'Example');
});

test('deserializes a document to RDF, as N-Quads', async () => {
    assert.equal(
        await output({ algorithm: 'toRdf', document: person }),
        '<https://example.com/ada> <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://schema.org/Person> .\n'
            + '<https://example.com/ada> <http://schema.org/name> "Ada" .\n',
    );
});

test('serializes N-Quads as a document', async () => {
    const document = '<https://example.com/ada> <http://schema.org/age> "36"^^<http://www.w3.org/2001/XMLSchema#integer> .\n';

    assert.deepEqual(await output({ algorithm: 'fromRdf', document }), [
        { '@id': 'https://example.com/ada', 'http://schema.org/age': [{ '@value': '36', '@type': 'http://www.w3.org/2001/XMLSchema#integer' }] },
    ]);
    assert.deepEqual(await output({ algorithm: 'fromRdf', document, options: { useNativeTypes: true } }), [
        { '@id': 'https://example.com/ada', 'http://schema.org/age': [{ '@value': 36 }] },
    ]);
});

test('gives the options to the algorithm', async () => {
    const document = '{"@id": "ada", "http://schema.org/name": "Ada"}';

    assert.equal((await output({ algorithm: 'expand', document, options: { base: 'https://example.com/people/' } }))[0]['@id'], 'https://example.com/people/ada');
    assert.ok('@graph' in (await output({ algorithm: 'frame', document: person, frame: '{"@context": "https://schema.org"}', options: { omitGraph: false } })));
});

test('writes the output as it is read: indented, with its slashes and its accents', async () => {
    const { output: written } = await processor().process({ algorithm: 'expand', document: '{"http://schema.org/name": "café"}' });

    assert.equal(written, '[\n    {\n        "http://schema.org/name": [\n            {\n                "@value": "café"\n            }\n        ]\n    }\n]');
});

test('reports the error code of the specification', async () => {
    assert.deepEqual(await processor().process({ algorithm: 'expand', document: '{"@context": {"term": {"@id": 1}}}' }), { error: 'invalid IRI mapping' });
});

test('says what is missing, or is not what is expected', async () => {
    const { process } = processor();
    const error = async (request) => (await process(request)).error;

    assert.equal(await error({ algorithm: 'expand', document: ' ' }), 'Please enter a JSON-LD document.');
    assert.equal(await error({ algorithm: 'expand', document: '{"@context": ' }), 'The JSON string could not be parsed.');
    assert.equal(await error({ algorithm: 'compact', document: person }), 'Please enter the context to compact the document with.');
    assert.equal(await error({ algorithm: 'compact', document: person, context: '{' }), 'The context is not valid JSON.');
    assert.equal(await error({ algorithm: 'frame', document: person }), 'Please enter the frame to frame the document with.');
    assert.equal(await error({ algorithm: 'frame', document: person, frame: '{' }), 'The frame is not valid JSON.');
    assert.equal(await error({ algorithm: 'fromRdf', document: ' ' }), 'Please enter some N-Quads.');
    assert.match(await error({ algorithm: 'fromRdf', document: 'nope' }), /N-Quads statement at line 1/);
    assert.equal(await error({ algorithm: 'canonize', document: person }), 'This algorithm is not known.');
    assert.equal(await error({ algorithm: 'expand', document: ' '.repeat(2 * 1024 * 1024) + '{}' }), 'This document is too large to be processed.');
});

test('reads the schema.org context without loading it', async () => {
    const { process, loaded } = processor();

    await process({ algorithm: 'expand', document: person });

    assert.deepEqual(loaded, []);
});

test('loads the remote context of a document, once', async () => {
    const { process, loaded, counts } = processor(website({ 'https://example.com/context': '{"@context": {"name": "http://schema.org/name"}}' }));
    const request = { algorithm: 'expand', document: '{"@context": "https://example.com/context", "name": "Ada"}' };

    assert.deepEqual(JSON.parse((await process(request)).output), [{ 'http://schema.org/name': [{ '@value': 'Ada' }] }]);
    // Once to learn what is missing, once with it
    assert.equal(counts.runs, 2);

    await process(request);

    // What the last run read is given at once
    assert.equal(counts.runs, 3);
    assert.deepEqual(loaded, ['https://example.com/context']);
});

test('loads the context that a remote context loads', async () => {
    const { process, loaded } = processor(website({
        'https://example.com/context': '{"@context": ["https://example.com/vocabulary", {"title": "name"}]}',
        'https://example.com/vocabulary': '{"@context": {"@vocab": "http://schema.org/"}}',
    }));

    const answer = await process({ algorithm: 'expand', document: '{"@context": "https://example.com/context", "title": "Ada"}' });

    assert.deepEqual(JSON.parse(answer.output), [{ 'http://schema.org/name': [{ '@value': 'Ada' }] }]);
    assert.deepEqual(loaded, ['https://example.com/context', 'https://example.com/vocabulary']);
});

test('loads a document given as its URL', async () => {
    assert.deepEqual(await output({ algorithm: 'expand', document: 'https://example.com/ada.jsonld' }, website({ 'https://example.com/ada.jsonld': person })), [
        { '@id': 'https://example.com/ada', '@type': ['http://schema.org/Person'], 'http://schema.org/name': [{ '@value': 'Ada' }] },
    ]);
});

test('names the remote context that can not be loaded', async () => {
    const { process } = processor();

    assert.deepEqual(await process({ algorithm: 'expand', document: '{"@context": "https://example.com/nope"}' }), {
        error: 'https://example.com/nope could not be loaded. This page answered with the HTTP status 404.',
    });
});

test('names the remote context that is not JSON', async () => {
    const { process } = processor(website({ 'https://example.com/page': '<p>Hello</p>' }));

    assert.deepEqual(await process({ algorithm: 'expand', document: '{"@context": "https://example.com/page"}' }), {
        error: 'loading remote context failed: https://example.com/page is not a JSON document.',
    });
});

test('stops loading the contexts of a document that loads too many', async () => {
    const { process, loaded } = processor(async () => ({ body: '{"@context": {}}' }));
    // The library refuses more than 10 contexts in a row, see below: here each
    // node has its own
    const nodes = Array.from({ length: MAX_DOCUMENTS + 1 }, (_, index) => ({ '@context': `https://example.com/context/${index}` }));

    assert.deepEqual(await process({ algorithm: 'expand', document: JSON.stringify({ '@graph': nodes }) }), {
        error: `This document loads more than ${MAX_DOCUMENTS} remote documents.`,
    });
    assert.equal(loaded.length, MAX_DOCUMENTS);
});

test('leaves the contexts that load each other without an end to the library', async () => {
    // Each context loads the next one
    const { process } = processor(async (url) => ({ body: JSON.stringify({ '@context': `${url}1` }) }));

    assert.deepEqual(await process({ algorithm: 'expand', document: '{"@context": "https://example.com/context/"}' }), {
        error: 'context overflow',
    });
});

// The context of the "activity" example, as short as it can be
const activityStreams = website({
    'https://www.w3.org/ns/activitystreams': '{"@context": {"@vocab": "https://www.w3.org/ns/activitystreams#", "id": "@id", "type": "@type"}}',
});

for (const [name, example] of Object.entries(examples)) {
    // The N-Quads are read by one algorithm, the documents by the others
    for (const algorithm of ALGORITHMS.filter((algorithm) => ('fromRdf' === algorithm) === ('nquads' in example))) {
        test(`runs "${algorithm}" on the "${name}" example`, async () => {
            const { process } = processor(activityStreams);
            const answer = await process({ ...example, algorithm, document: example.nquads ?? example.document });

            assert.equal(answer.error, undefined);
            assert.notEqual(answer.output.trim(), '');
            assert.notEqual(answer.output, '[]');
            assert.notEqual(answer.output, '{}');
        });
    }
}

test('opens each example on an algorithm that reads it', () => {
    for (const example of Object.values(examples)) {
        assert.ok(ALGORITHMS.includes(example.algorithm));
        assert.equal('fromRdf' === example.algorithm, 'nquads' in example);
    }
});

import assert from 'node:assert/strict';
import { test } from 'node:test';

import { defaultOptions } from '../assets/jsonLd.js';
import { decodeState, encodeState, normalizeState } from '../assets/permalink.js';
import { examples } from '../assets/playgroundExamples.js';

// Runs assets/permalink.js, what writes the state of the playground in the
// fragment of its URL, in node.

const state = normalizeState({
    ...examples.person,
    nquads: examples.nquads.nquads,
    options: { base: 'https://example.com/', ordered: true, omitGraph: false, rdfDirection: 'i18n-datatype' },
});

test('reads back the state it writes', async () => {
    const fragment = await encodeState(state);

    assert.match(fragment, /^1[\w-]+$/);
    assert.deepEqual(await decodeState(`#${fragment}`), state);
});

test('writes a state shorter than its documents', async () => {
    assert.ok((await encodeState(state)).length < JSON.stringify(state).length);
});

test('reads a state that is not compressed', async () => {
    const fragment = '0' + Buffer.from(JSON.stringify(state)).toString('base64url');

    assert.deepEqual(await decodeState(fragment), state);
});

test('keeps what is not ASCII', async () => {
    const document = '{"name": "café ☕ 日本語"}';

    assert.equal((await decodeState(await encodeState({ document }))).document, document);
});

test('completes the state of the validator, that is a lone document', async () => {
    assert.deepEqual(await decodeState(await encodeState({ document: '{}' })), {
        algorithm: 'expand',
        document: '{}',
        nquads: '',
        context: '',
        frame: '',
        options: defaultOptions(),
    });
});

test('takes nothing it does not know from a state', async () => {
    const fragment = await encodeState({
        algorithm: 'canonize',
        document: ['not', 'a', 'string'],
        options: { base: 1, ordered: 'yes', omitGraph: 'no', processingMode: '2.0', unknown: true },
        unknown: true,
    });

    assert.deepEqual(await decodeState(fragment), normalizeState({}));
});

for (const fragment of ['', '#', '#section', '1not-deflate', '0not-json', '1', '#0bnVsbA', '#0WzFd']) {
    test(`reads no state in "${fragment}"`, async () => {
        assert.equal(await decodeState(fragment), null);
    });
}

test('refuses a state that inflates too much', async () => {
    const fragment = await encodeState({ document: ' '.repeat(5 * 1024 * 1024) });

    assert.ok(fragment.length < 10_000);
    assert.equal(await decodeState(fragment), null);
});

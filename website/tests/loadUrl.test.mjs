import assert from 'node:assert/strict';
import { test } from 'node:test';

import { loadUrl } from '../assets/loadUrl.js';

// Runs assets/loadUrl.js, what the "Load" button of the homepage runs, in
// node, with a fetch that answers what a website would.

const UNREADABLE = /could not be read from your browser/;

// The fetch of node is an accessor, that t.mock.method() does not replace
const fetches = (t, implementation) => {
    const original = globalThis.fetch;
    const fetch = t.mock.fn(implementation);

    globalThis.fetch = fetch;
    t.after(() => {
        globalThis.fetch = original;
    });

    return fetch;
};

const answer = (t, body, init = {}) => fetches(t, async () => new Response(body, init));

test('loads the page of a website that allows it', async (t) => {
    const fetch = answer(t, '<p>Hello</p>', { headers: { 'Content-Type': 'text/html; charset=utf-8' } });

    assert.deepEqual(await loadUrl(' https://example.com/page '), { body: '<p>Hello</p>' });

    const [url, options] = fetch.mock.calls[0].arguments;
    assert.equal(url, 'https://example.com/page');
    assert.equal(options.credentials, 'omit');
});

test('loads a JSON-LD document', async (t) => {
    answer(t, '{"@type": "Thing"}', { headers: { 'Content-Type': 'application/ld+json' } });

    assert.deepEqual(await loadUrl('https://example.com/thing.jsonld'), { body: '{"@type": "Thing"}' });
});

test('asks for a page or a JSON-LD document, unless told what to ask for', async (t) => {
    const fetch = answer(t, '{}', { headers: { 'Content-Type': 'application/ld+json' } });

    await loadUrl('https://example.com/');
    await loadUrl('https://example.com/context', { accept: 'application/ld+json' });

    assert.match(fetch.mock.calls[0].arguments[1].headers.Accept, /^text\/html,application\/ld\+json/);
    assert.equal(fetch.mock.calls[1].arguments[1].headers.Accept, 'application/ld+json');
});

test('decodes the page with the charset of its Content-Type', async (t) => {
    answer(t, Buffer.from('<p>café</p>', 'latin1'), { headers: { 'Content-Type': 'text/html; charset=ISO-8859-1' } });

    assert.deepEqual(await loadUrl('https://example.com/'), { body: '<p>café</p>' });
});

test('decodes the page with the charset of its meta element', async (t) => {
    const page = '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><p>café</p>';
    answer(t, Buffer.from(page, 'latin1'), { headers: { 'Content-Type': 'text/html' } });

    assert.deepEqual(await loadUrl('https://example.com/'), { body: page });
});

test('reads the page as UTF-8 when its charset is unknown', async (t) => {
    answer(t, '<p>café</p>', { headers: { 'Content-Type': 'text/html; charset=nope' } });

    assert.deepEqual(await loadUrl('https://example.com/'), { body: '<p>café</p>' });
});

for (const url of ['', 'jolicode.com', 'ftp://example.com/page', 'javascript:alert(1)', 'file:///etc/hosts']) {
    test(`refuses "${url}" without fetching it`, async (t) => {
        const fetch = answer(t, '');

        assert.match((await loadUrl(url)).error, /starting with http/);
        assert.equal(fetch.mock.callCount(), 0);
    });
}

test('says that the page can not be read, when the website does not allow it', async (t) => {
    // What fetch does of a CORS refusal, and of a network failure as well
    fetches(t, async () => {
        throw new TypeError('Failed to fetch');
    });

    assert.match((await loadUrl('https://example.com/')).error, UNREADABLE);
});

test('says that the page can not be read, when its download fails', async (t) => {
    const body = new ReadableStream({
        start(controller) {
            controller.error(new TypeError('terminated'));
        },
    });
    answer(t, body, { headers: { 'Content-Type': 'text/html' } });

    assert.match((await loadUrl('https://example.com/')).error, UNREADABLE);
});

test('reports the HTTP status of a page that is not found', async (t) => {
    answer(t, 'Not found', { status: 404, headers: { 'Content-Type': 'text/html' } });

    assert.deepEqual(await loadUrl('https://example.com/nope'), { error: 'This page answered with the HTTP status 404.' });
});

test('refuses what is neither a page nor a JSON document', async (t) => {
    answer(t, new Uint8Array(8), { headers: { 'Content-Type': 'image/png' } });

    assert.deepEqual(await loadUrl('https://example.com/logo.png'), { error: 'This URL is neither a HTML page nor a JSON document.' });
});

test('refuses a document that says it is too large, without downloading it', async (t) => {
    answer(t, '<p>Hello</p>', { headers: { 'Content-Type': 'text/html', 'Content-Length': String(2 * 1024 * 1024 + 1) } });

    assert.deepEqual(await loadUrl('https://example.com/'), { error: 'This document is too large to be validated.' });
});

test('refuses a document that is too large', async (t) => {
    answer(t, new Uint8Array(2 * 1024 * 1024 + 1), { headers: { 'Content-Type': 'text/html' } });

    assert.deepEqual(await loadUrl('https://example.com/'), { error: 'This document is too large to be validated.' });
});

import assert from 'node:assert/strict';
import { test } from 'node:test';

import { loadPage, loadUrl } from '../assets/loadUrl.js';

// Runs assets/loadUrl.js in node, with a fetch that answers what a website
// would, and what the proxy of the website would: loadUrl() is what the
// playground loads a context with, and loadPage() what the "Load" button of
// the homepage runs.

// "pasteable": the homepage advises to paste the page, or to validate it elsewhere
const UNREADABLE = { error: 'This URL could not be loaded.', pasteable: true };

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

    assert.deepEqual(await loadUrl('https://example.com/'), UNREADABLE);
});

test('says that the page can not be read, when its download fails', async (t) => {
    const body = new ReadableStream({
        start(controller) {
            controller.error(new TypeError('terminated'));
        },
    });
    answer(t, body, { headers: { 'Content-Type': 'text/html' } });

    assert.deepEqual(await loadUrl('https://example.com/'), UNREADABLE);
});

test('reports the HTTP status of a page that is not found', async (t) => {
    answer(t, 'Not found', { status: 404, headers: { 'Content-Type': 'text/html' } });

    assert.deepEqual(await loadUrl('https://example.com/nope'), { error: 'This page answered with the HTTP status 404.', pasteable: true });
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

// The proxy signs what it answers
const proxied = (body, init = {}) => new Response(body, { ...init, headers: { 'X-Load-Url': '1', ...init.headers } });
const refusal = (status, answer) => proxied(JSON.stringify(answer), { status, headers: { 'Content-Type': 'application/json' } });

// Answers the proxy with "proxy", and the website of the page with "website"
const serves = (t, { proxy, website = () => new Response('<p>Direct</p>', { headers: { 'Content-Type': 'text/html' } }) }) =>
    fetches(t, async (url) => (url === '/load-url' ? proxy() : website()));

test('loads a page by the proxy', async (t) => {
    const fetch = serves(t, { proxy: () => proxied('<p>Hello</p>', { headers: { 'X-Load-Url-Content-Type': 'text/html; charset=utf-8' } }) });

    assert.deepEqual(await loadPage(' https://example.com/page '), { body: '<p>Hello</p>' });

    assert.equal(fetch.mock.callCount(), 1);
    const [url, options] = fetch.mock.calls[0].arguments;
    assert.equal(url, '/load-url');
    assert.equal(options.method, 'POST');
    assert.equal(options.headers['Content-Type'], 'application/json');
    assert.deepEqual(JSON.parse(options.body), { url: 'https://example.com/page' });
});

test('decodes the page the proxy loads with the charset of the page', async (t) => {
    serves(t, { proxy: () => proxied(Buffer.from('<p>café</p>', 'latin1'), { headers: { 'X-Load-Url-Content-Type': 'text/html; charset=ISO-8859-1' } }) });

    assert.deepEqual(await loadPage('https://example.com/'), { body: '<p>café</p>' });
});

for (const url of ['', 'jolicode.com', 'ftp://example.com/page', 'javascript:alert(1)']) {
    test(`refuses the page "${url}" without asking the proxy`, async (t) => {
        const fetch = answer(t, '');

        assert.match((await loadPage(url)).error, /starting with http/);
        assert.equal(fetch.mock.callCount(), 0);
    });
}

// The last one is "pasteable": a page that the validator would read, once pasted
for (const [answered, expected, pasteable] of [
    [refusal(429, { error: 'rate_limited' }), /Too many pages were loaded lately/, true],
    [refusal(422, { error: 'forbidden_target' }), /only the public websites are/, true],
    [refusal(422, { error: 'http_status', status: 404 }), /^This page answered with the HTTP status 404\.$/, true],
    [refusal(422, { error: 'unsupported_type' }), /neither a HTML page nor a JSON document/, false],
    [refusal(422, { error: 'too_large' }), /too large to be validated/, false],
    [refusal(422, { error: 'unreachable' }), /^This URL could not be loaded\.$/, true],
    [refusal(403, { error: 'forbidden' }), /not available for now/, true],
    [refusal(400, { error: 'invalid_request' }), /not available for now/, true],
    [refusal(422, { error: 'http_status' }), /not available for now/, true],
    [proxied('Oops', { status: 500 }), /not available for now/, true],
]) {
    test(`says why the proxy does not load a page: ${answered.status} ${JSON.stringify(expected.source)}`, async (t) => {
        const fetch = serves(t, { proxy: () => answered });
        const result = await loadPage('https://example.com/');

        assert.match(result.error, expected);
        assert.equal(result.pasteable ?? false, pasteable);
        // The browser does not try by itself what the proxy refuses
        assert.equal(fetch.mock.callCount(), 1);
    });
}

test('refuses a page the proxy loads when it is too large', async (t) => {
    serves(t, { proxy: () => proxied(new Uint8Array(2 * 1024 * 1024 + 1), { headers: { 'X-Load-Url-Content-Type': 'text/html' } }) });

    assert.deepEqual(await loadPage('https://example.com/'), { error: 'This document is too large to be validated.' });
});

for (const [name, proxy] of [
    ['a 404', () => new Response('Not found', { status: 404 })],
    ['a 405', () => new Response('', { status: 405 })],
    ['a page', () => new Response('<p>The homepage</p>', { headers: { 'Content-Type': 'text/html' } })],
    ['nothing', () => Promise.reject(new TypeError('Failed to fetch'))],
]) {
    test(`loads the page by the browser where there is no proxy, and ${name} answers`, async (t) => {
        const fetch = serves(t, { proxy });

        assert.deepEqual(await loadPage('https://example.com/page'), { body: '<p>Direct</p>' });

        assert.equal(fetch.mock.callCount(), 2);
        assert.equal(fetch.mock.calls[1].arguments[0], 'https://example.com/page');
    });
}

test('says that the page can not be read by the browser, where there is no proxy', async (t) => {
    serves(t, {
        proxy: () => new Response('', { status: 405 }),
        website: () => Promise.reject(new TypeError('Failed to fetch')),
    });

    assert.deepEqual(await loadPage('https://example.com/'), UNREADABLE);
});

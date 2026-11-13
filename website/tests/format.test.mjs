import assert from 'node:assert/strict';
import { test } from 'node:test';

import { formatDocument } from '../assets/format.js';

// Runs assets/format.js, what the "Format" button of the result runs, in node.
// Run with "castor website:check".

test('expands a minified JSON-LD document', async () => {
    const { content } = await formatDocument('{"@context":"https://schema.org","@type":"Organization","name":"JoliCode"}');

    assert.equal(content, '{\n  "@context": "https://schema.org",\n  "@type": "Organization",\n  "name": "JoliCode"\n}\n');
});

test('indents a page, and expands its JSON-LD', async () => {
    const { content } = await formatDocument('<html><head><script type="application/ld+json">{"@type":"Thing","name":"A"}</script></head><body><p>Hello</p></body></html>');

    assert.match(content, /\n {8}"@type": "Thing",\n {8}"name": "A"\n/);
    assert.match(content, /\n {4}<p>Hello<\/p>\n/);
});

test('never wraps a text, that microdata reads as a value', async () => {
    const text = 'word '.repeat(200).trim();
    const { content } = await formatDocument(`<div itemscope itemtype="https://schema.org/Thing"><p itemprop="description">${text}</p></div>`);

    assert.ok(content.includes(`<p itemprop="description">${text}</p>`));
});

test('leaves a document with invalid JSON as it is', async () => {
    assert.match((await formatDocument('{"name": }')).error, /invalid JSON/);
    assert.match((await formatDocument('<script type="application/ld+json">{"name": }</script>')).error, /invalid JSON/);
});

test('indents what Prettier refuses, without repairing it', async () => {
    const { content } = await formatDocument('<div><p>Hello</p></source><spanitemprop="name">A</span></div>');

    assert.ok(content.includes('</source>'));
    assert.ok(content.includes('<spanitemprop="name">'));
    assert.match(content, /^<div>\n {2}<p>/);
});

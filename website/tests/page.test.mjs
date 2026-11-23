import assert from 'node:assert/strict';
import { readFile } from 'node:fs/promises';
import { test } from 'node:test';

import { examples } from '../assets/examples.js';
import { audit } from '../public/build/php.js';

// Runs assets/php.js, as the page of the validator does, in node, on what "castor website:build"
// built. Run with "castor website:check": fetch-files.mjs of php-wasm-builder
// lets node fetch the .wasm file.

const settings = { allowPendingVocabulary: true, mergeSharedIdentifiers: true };

// What a part of the result reads as, without its tags
const text = (html) => html.replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim();

test('audits a valid document', async () => {
    const { counts, html } = await audit({
        ...settings,
        body: '{"@context": "https://schema.org", "@type": "Organization", "name": "JoliCode", "url": "https://jolicode.com"}',
    });

    assert.match(html, /<h2[^>]*>\s*Organization\s+<span[^>]*>“JoliCode”<\/span>/);
    assert.equal(text(counts), '1 entity Valid');
});

test('reports the errors, with where they are in the document', async () => {
    const { counts, html } = await audit({
        ...settings,
        body: '<script type="application/ld+json">\n{"@context": "https://schema.org", "@type": "Organization", "unknownProperty": 1}\n</script>',
    });

    assert.match(text(counts), /^1 entity 1 error/);
    assert.match(html, /data-result-severity="error"/);
    assert.match(html, /data-start="2:/);
});

test('says when there is no structured data', async () => {
    const { counts, html } = await audit({ ...settings, body: '<p>Hello</p>' });

    assert.match(html, /We could not extract structured data/);
    assert.doesNotMatch(html, /data-result-target="entity"/);
    assert.equal(text(counts), '');
});

test('renders the entities alone, for the page of the validator that holds the editor and the toolbar', async () => {
    const { counts, html } = await audit({ ...settings, body: '{"@context": "https://schema.org", "@type": "Thing"}' });

    assert.match(html, /^\s*<article[^>]*data-result-target="entity"/);

    for (const part of [counts, html]) {
        assert.doesNotMatch(part, /<main|<header|<nav|<textarea|<button|result-toolbar/);
    }
});

test('finds, in the page of the validator, what the result controller fills and reads', async () => {
    const page = await readFile(new URL('../public/validator/index.html', import.meta.url), 'utf8');

    assert.match(page, /data-controller="result"/);

    for (const target of ['copyLink', 'counts', 'editor', 'error', 'expandButton', 'formatButton', 'nodes', 'pending', 'settingsButton', 'settingsPanel', 'showDescriptions', 'status']) {
        assert.ok(page.includes(`data-result-target="${target}"`), target);
    }
});

for (const [name, body] of Object.entries(examples)) {
    test(`extracts structured data from the "${name}" example`, async () => {
        const { html, error } = await audit({ ...settings, body });

        assert.equal(error, undefined);
        assert.doesNotMatch(html, /We could not extract structured data/);
    });
}

test('merges the JSON-LD and the microdata of the "sharedIdentifier" example, as asked', async () => {
    const merged = await audit({ ...settings, mergeSharedIdentifiers: true, body: examples.sharedIdentifier });
    const separate = await audit({ ...settings, mergeSharedIdentifiers: false, body: examples.sharedIdentifier });

    assert.match(merged.counts, />1 entity</);
    assert.match(separate.counts, />2 entities</);
});

test('refuses an empty document', async () => {
    assert.deepEqual(await audit({ ...settings, body: ' ' }), { error: 'Please enter some code to validate.' });
});

test('refuses a document that is too large', async () => {
    assert.deepEqual(await audit({ ...settings, body: ' '.repeat(2 * 1024 * 1024) + '{}' }), { error: 'This document is too large to be validated.' });
});

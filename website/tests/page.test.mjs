import assert from 'node:assert/strict';
import { test } from 'node:test';

import { examples } from '../assets/examples.js';
import { audit } from '../public/build/php.js';

// Runs assets/php.js, as the page does, in node, on what "castor website:build"
// built. Run with "castor website:check": fetch-files.mjs of php-wasm-builder
// lets node fetch the .wasm file.

const settings = { allowPendingVocabulary: true, mergeSharedIdentifiers: true };

test('audits a valid document', async () => {
    const { html } = await audit({
        ...settings,
        body: '{"@context": "https://schema.org", "@type": "Organization", "name": "JoliCode", "url": "https://jolicode.com"}',
    });

    assert.match(html, /<h2[^>]*>\s*Organization\s+<span[^>]*>“JoliCode”<\/span>/);
    assert.match(html, />Valid</);
});

test('reports the errors, with where they are in the document', async () => {
    const { html } = await audit({
        ...settings,
        body: '<script type="application/ld+json">\n{"@context": "https://schema.org", "@type": "Organization", "unknownProperty": 1}\n</script>',
    });

    assert.match(html, /1 error/);
    assert.match(html, /data-result-severity="error"/);
    assert.match(html, /data-start="2:/);
});

test('keeps the document as it is, in the editor', async () => {
    const body = '\n{"@context": "https://schema.org", "@type": "Thing", "name": "<b> & co"}';
    const { html } = await audit({ ...settings, body });

    assert.ok(html.includes(`data-result-target="codemirror">\n\n{&quot;@context&quot;`));
    assert.ok(html.includes('&lt;b&gt; &amp; co'));
});

test('says when there is no structured data', async () => {
    const { html } = await audit({ ...settings, body: '<p>Hello</p>' });

    assert.match(html, /We could not extract structured data/);
    assert.doesNotMatch(html, /data-result-target="expandButton"/);
    assert.doesNotMatch(html, /data-result-target="showDescriptions"/);
});

test('offers to expand the tree and to hide the descriptions, when there is a result', async () => {
    const { html } = await audit({
        ...settings,
        body: '{"@context": "https://schema.org", "@type": "Organization", "name": "JoliCode"}',
    });

    assert.match(html, /data-result-target="expandButton"[^>]*>\s*Expand all\s*</);
    assert.match(html, /data-result-target="showDescriptions"/);
    assert.match(html, /data-result-target="settingsButton"[\s\S]*?<svg/);
});

for (const [name, body] of Object.entries(examples)) {
    test(`extracts structured data from the "${name}" example`, async () => {
        const { html, error } = await audit({ ...settings, body });

        assert.equal(error, undefined);
        assert.doesNotMatch(html, /We could not extract structured data/);
    });
}

test('refuses an empty document', async () => {
    assert.deepEqual(await audit({ ...settings, body: ' ' }), { error: 'Please enter some code to validate.' });
});

test('refuses a document that is too large', async () => {
    assert.deepEqual(await audit({ ...settings, body: ' '.repeat(2 * 1024 * 1024) + '{}' }), { error: 'This document is too large to be validated.' });
});

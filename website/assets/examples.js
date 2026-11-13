// The documents behind the "Try an example" buttons of the homepage, by the
// data-example of their button.

export const examples = {
  product: `<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": "Oak chair",
  "image": "https://example.com/oak-chair.jpg",
  "offers": {
    "@type": "Offer",
    "price": "a hundred",
    "shipping": "free"
  },
  "colour": "natural"
}
</script>`,

  article: `<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "Hosting a PHP project without a server, with WebAssembly",
  "image": "https://example.com/php-wasm.png",
  "datePublished": "2026-03-12T09:00:00+01:00",
  "dateModified": "2026-03-14T10:30:00+01:00",
  "author": {
    "@type": "Person",
    "name": "Jane Doe",
    "url": "https://example.com/team/jane-doe"
  }
}
</script>`,

  microdata: `<!DOCTYPE html>
<html lang="en">
<head>
  <title>Jane Doe</title>
</head>
<body>
  <div itemscope itemtype="https://schema.org/Person">
    <h1 itemprop="name">Jane Doe</h1>
    <p itemprop="jobTitle">Web developer</p>
    <a itemprop="url" href="https://example.com/team/jane-doe">Profile</a>
    <div itemprop="worksFor" itemscope itemtype="https://schema.org/Organization">
      <span itemprop="name">Example</span>
      <span itemprop="foundingYear">2010</span>
    </div>
  </div>
</body>
</html>`,
};

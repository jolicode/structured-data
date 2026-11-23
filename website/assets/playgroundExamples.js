// The examples of the playground. Each one opens the tab of its "algorithm".
// The ones made of a JSON-LD "document" come with the "context" and the "frame"
// of the tabs that need one: every tab shows something for every example, see
// tests/playground.test.mjs.

const person = {
  label: "Person",
  algorithm: "expand",
  document: `{
  "@context": "https://schema.org",
  "@id": "https://example.com/people/ada",
  "@type": "Person",
  "name": "Ada Lovelace",
  "jobTitle": "Mathematician",
  "birthDate": "1815-12-10",
  "knows": {
    "@id": "https://example.com/people/charles",
    "@type": "Person",
    "name": "Charles Babbage"
  }
}`,
  context: `{
  "@context": {
    "schema": "http://schema.org/",
    "Person": "schema:Person",
    "name": "schema:name",
    "knows": "schema:knows"
  }
}`,
  frame: `{
  "@context": "https://schema.org",
  "@type": "Person",
  "knows": {
    "@embed": "@never"
  }
}`,
};

const event = {
  label: "Event",
  algorithm: "compact",
  document: `{
  "@context": "https://schema.org",
  "@id": "https://example.com/events/php-meetup",
  "@type": "Event",
  "name": "PHP meetup",
  "startDate": "2026-12-03T19:00:00+01:00",
  "eventAttendanceMode": "https://schema.org/OfflineEventAttendanceMode",
  "location": {
    "@type": "Place",
    "name": "JoliCode",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Paris",
      "addressCountry": "FR"
    }
  }
}`,
  context: `{
  "@context": {
    "@vocab": "http://schema.org/",
    "title": "name",
    "starts": {
      "@id": "startDate",
      "@type": "DateTime"
    },
    "where": "location"
  }
}`,
  frame: `{
  "@context": "https://schema.org",
  "@type": "Place"
}`,
};

const product = {
  label: "Product",
  algorithm: "toRdf",
  document: `{
  "@context": "https://schema.org",
  "@id": "https://example.com/products/mug",
  "@type": "Product",
  "name": "Yellow mug",
  "sku": "MUG-001",
  "brand": {
    "@type": "Brand",
    "name": "JoliCode"
  },
  "offers": {
    "@type": "Offer",
    "price": 12.5,
    "priceCurrency": "EUR",
    "availability": "https://schema.org/InStock"
  }
}`,
  context: `{
  "@context": {
    "@vocab": "http://schema.org/"
  }
}`,
  frame: `{
  "@context": "https://schema.org",
  "@type": "Offer"
}`,
};

// What a SEO plugin writes: flat nodes that refer to each other, which a frame
// turns into the tree of the article
const articleGraph = {
  label: "Article graph, framed",
  algorithm: "frame",
  document: `{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@id": "https://example.com/#organization",
      "@type": "Organization",
      "name": "Example",
      "url": "https://example.com/"
    },
    {
      "@id": "https://example.com/#/people/ada",
      "@type": "Person",
      "name": "Ada Lovelace"
    },
    {
      "@id": "https://example.com/blog/hello/#article",
      "@type": "Article",
      "headline": "Hello world",
      "datePublished": "2026-11-02",
      "author": {
        "@id": "https://example.com/#/people/ada"
      },
      "publisher": {
        "@id": "https://example.com/#organization"
      }
    }
  ]
}`,
  context: `{
  "@context": {
    "@vocab": "http://schema.org/"
  }
}`,
  frame: `{
  "@context": "https://schema.org",
  "@type": "Article"
}`,
};

// Its context is not schema.org, that the library ships: the browser fetches it
const activity = {
  label: "Activity, with a remote context",
  algorithm: "expand",
  document: `{
  "@context": "https://www.w3.org/ns/activitystreams",
  "id": "https://example.com/notes/1",
  "type": "Note",
  "attributedTo": "https://example.com/people/ada",
  "content": "A remote context, fetched by your browser.",
  "published": "2026-11-23T10:00:00Z"
}`,
  context: `{
  "@context": {
    "as": "https://www.w3.org/ns/activitystreams#",
    "content": "as:content"
  }
}`,
  frame: `{
  "@context": "https://www.w3.org/ns/activitystreams",
  "type": "Note"
}`,
};

const nquads = {
  label: "N-Quads",
  algorithm: "fromRdf",
  nquads: `<https://example.com/people/ada> <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://schema.org/Person> .
<https://example.com/people/ada> <http://schema.org/name> "Ada Lovelace" .
<https://example.com/people/ada> <http://schema.org/birthDate> "1815-12-10"^^<http://schema.org/Date> .
<https://example.com/people/ada> <http://schema.org/knows> <https://example.com/people/charles> .
<https://example.com/people/charles> <http://www.w3.org/1999/02/22-rdf-syntax-ns#type> <http://schema.org/Person> .
<https://example.com/people/charles> <http://schema.org/name> "Charles Babbage" .
`,
};

export const examples = { person, event, product, articleGraph, activity, nquads };

// What the playground opens with
export const DEFAULT_EXAMPLE = "person";

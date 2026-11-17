// The documents behind the "Try an example" buttons of the homepage, by the
// data-example of their button.
//
// The first four are made up. The others are the structured data of real pages,
// as they were served on 2026-11-16, quirks included: only their longest lists
// are shortened.

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

  // One organization, described half in JSON-LD and half in microdata: both
  // share its identifier, so the "Merge entities with the same @id" setting
  // makes a single entity of them
  sharedIdentifier: `<!DOCTYPE html>
<html lang="en">
<head>
  <title>Example Bakery</title>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "@id": "https://example.com/#organization",
    "name": "Example Bakery",
    "url": "https://example.com/"
  }
  </script>
</head>
<body>
  <footer itemscope itemtype="https://schema.org/Organization" itemid="https://example.com/#organization">
    <img itemprop="logo" src="https://example.com/logo.png" alt="Example Bakery">
    <a itemprop="telephone" href="tel:+33100000000">+33 1 00 00 00 00</a>
    <div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
      <span itemprop="streetAddress">1 rue de l'Exemple</span>,
      <span itemprop="postalCode">75000</span>
      <span itemprop="addressLocality">Paris</span>
    </div>
  </footer>
</body>
</html>`,

  // https://jolicode.com/blog/secret-santa-in-2026-exclusions-slack-connect-and-a-fresh-coat-of-paint
  // its \u escapes are decoded, for reading; String.raw keeps its escaped slashes
  jolicodeBlogPost: String.raw`<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "Secret Santa in 2026: exclusions, Slack Connect, and a fresh coat of paint",
    "image": [
        "https:\/\/jolicode.com\/media\/social-preview\/secret-santa-in-2026-exclusions-slack-connect-and-a-fresh-coat-of-paint.png"
    ],
    "dateModified": "2026-11-12",
    "datePublished": "2026-11-12",
    "author": [
                    {
    "@context": "https://schema.org",
    "@type": "Person",
    "workLocation": {
    "@context": "https://schema.org",
    "@type": "ContactPoint",
    "url": "https://jolicode.com/contact",
    "contactType": "Service client du Poney Club"
}
,
            "image": "https:\/\/jolicode.com\/media\/cache\/team-list-thumbnail\/team\/loick.ecc61452.jpeg",
                "jobTitle": "Développeur web le jour et dresseur d'Arduino la nuit",
                "url": "https:\/\/jolicode.com\/qui-sommes-nous\/equipe\/loick-piera",
        "name": "Loïck Piera"
}
            ],
    "publisher": {
    "@context": "https://schema.org",
    "@type": "Organization",
    "url": "https://jolicode.com/",
    "name": "JoliCode",
    "contactPoint": {
    "@context": "https://schema.org",
    "@type": "ContactPoint",
    "url": "https://jolicode.com/contact",
    "contactType": "Service client du Poney Club"
}
,
    "logo": "https://jolicode.com/images/goodies/logo.svg"
}
,
    "mainEntityOfPage": "https:\/\/jolicode.com\/blog\/secret-santa-in-2026-exclusions-slack-connect-and-a-fresh-coat-of-paint",
    "inLanguage": "en"}
</script>`,

  // https://jolicampus.com/formations/symfony: its Product and WebSite blocks
  // are left out, its syllabus, reviews and instructors are shortened
  symfonyTraining: `<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Formation Symfony - JoliCampus</title>
  <script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [{
      "@type": "ListItem",
      "position": 1,
      "name": "Catalogue de formations",
      "item": "https://jolicampus.com/formations"
    },{
      "@type": "ListItem",
      "position": 2,
      "name": "Symfony",
      "item": "https://jolicampus.com/formations/symfony"
    }]
  }
  </script>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org/",
    "@id": "https://jolicampus.com/formations/symfony",
    "@type": "Course",
    "name": "Formation Symfony",
    "description": "Symfony est un framework PHP moderne, modulaire et flexible. Aujourd’hui, il est l’un des piliers de l&#039;écosystème de PHP en tant qu&#039;outil de développement fiable, proposant une architecture robuste et évolutive.",
    "provider": {
      "@type": "Organization",
      "name": "JoliCode",
      "url": "https://jolicode.com",
      "sameAs": "https://twitter.com/JoliCode",
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+33143573911",
        "contactType": "sales",
        "availableLanguage": "French",
        "email": "hello@jolicampus.com "
      }
    },
    "image": "https://jolicampus.com/media/cache/training-large/training/symfony.png",
    "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "4.6",
      "ratingCount": "13",
      "reviewCount": "13",
      "bestRating": 5,
      "worstRating": 1
    },
    "offers": [
      {
        "@type": "Offer",
        "category": "Paid",
        "price": "1800",
        "priceValidUntil": "2026-12-16",
        "priceCurrency": "EUR",
        "url": "https://jolicampus.com/formations/symfony",
        "availability": "http://schema.org/LimitedAvailability",
        "validFrom": "2026-01-01",
        "availabilityStarts": "2026-01-01",
        "inventoryLevel": {
          "@type": "QuantitativeValue",
          "value": 6,
          "unitText": "places"
        }
      }
    ],
    "datePublished": "2012-03-01",
    "educationalLevel": "Intermediate",
    "teaches": [
      "connaître les principes et l’architecture du framework Symfony",
      "mettre en place ou maintenir un projet développé avec Symfony",
      "communiquer avec une base de données",
      "créer une application Web respectant les bonnes pratiques"
    ],
    "financialAidEligible": "Financement par les opérateurs de compétences (OPCO)",
    "inLanguage": "fr",
    "availableLanguage": [
      "fr"
    ],
    "syllabusSections": [
      {
        "@type": "Syllabus",
        "name": "Présentation du framework",
        "timeRequired": "PT1H"
      },
      {
        "@type": "Syllabus",
        "name": "Le routing et la gestion des urls",
        "timeRequired": "PT2H"
      },
      {
        "@type": "Syllabus",
        "name": "La couche vue, introduction à Twig",
        "timeRequired": "PT2H"
      }
    ],
    "review": [
      {
        "@type": "Review",
        "inLanguage": "fr-FR",
        "author": {
          "@type": "Person",
          "name": "D. C."
        },
        "publisher": {
          "@type": "Organization",
          "name": "JoliCampus"
        },
        "reviewRating": {
          "@type": "Rating",
          "ratingValue": "5",
          "bestRating": 5,
          "worstRating": 1
        },
        "datePublished": "2022-02-02",
        "description": "Très bon moment et formation très instructive dans son ensemble",
        "reviewBody": "Très bon moment et formation très instructive dans son ensemble"
      },
      {
        "@type": "Review",
        "inLanguage": "fr-FR",
        "author": {
          "@type": "Person",
          "name": "Y. T."
        },
        "publisher": {
          "@type": "Organization",
          "name": "JoliCampus"
        },
        "reviewRating": {
          "@type": "Rating",
          "ratingValue": "5",
          "bestRating": 5,
          "worstRating": 1
        },
        "datePublished": "2015-11-06",
        "description": "Formation claire, permettant de prendre Symfony en main très rapidement.",
        "reviewBody": "Formation claire, permettant de prendre Symfony en main très rapidement."
      }
    ],
    "coursePrerequisites": [
      "Développement en PHP objet",
      "Bases en développement Web (HTTP, HTML, CSS)",
      "Utilisation de la ligne de commande",
      "Ordinateur"
    ],
    "hasCourseInstance": [
      {
        "@type": "CourseInstance",
        "courseMode": "Onsite",
        "location": {
          "@type": "Place",
          "name": "JoliCampus",
          "address": "Paris"
        },
        "courseSchedule": {
          "@type": "Schedule",
          "duration": "PT7H",
          "repeatFrequency": "Daily",
          "repeatCount": 3,
          "startDate": "2026-12-09",
          "endDate": "2026-12-11"
        },
        "instructor": [
          {
            "@type": "Person",
            "name": "Benjamin Clay",
            "image": "https://jolicampus.com/media/cache/training-large/trainer/benjamin-clay.jpg"
          },
          {
            "@type": "Person",
            "name": "Damien Alexandre",
            "image": "https://jolicampus.com/media/cache/training-large/trainer/damien-alexandre.jpg"
          }
        ]
      }
    ]
  }
  </script>
  <script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "Event",
    "name": "Formation Symfony",
    "description": "Symfony est un framework PHP moderne, modulaire et flexible. Aujourd’hui, il est l’un des piliers de l&#039;écosystème de PHP en tant qu&#039;outil de développement fiable, proposant une architecture robuste et évolutive.",
    "image": "https://jolicampus.com/media/cache/training-large/training/symfony.png",
    "startDate": "2026-12-09",
    "endDate": "2026-12-11",
    "duration": "P3D",
    "eventAttendanceMode": "http://schema.org/OfflineEventAttendanceMode",
    "eventStatus": "http://schema.org/EventScheduled",
    "url": "https://jolicampus.com/formations/inscription/symfony/2026-12-09",
    "location": {
      "@type": "Place",
      "name": "JoliCampus",
      "address": "Paris"
    },
    "performer": {
      "@type": "Organization",
      "name": "JoliCampus"
    },
    "organizer": {
      "@type": "Organization",
      "name": "JoliCampus",
      "url": "https://jolicapus.com/"
    },
    "offers": {
      "@type": "Offer",
      "price": "1800",
      "priceCurrency": "EUR",
      "url": "https://jolicampus.com/formations/inscription/symfony/2026-12-09",
      "availability": "http://schema.org/LimitedAvailability",
      "validFrom": "2026-04-02",
      "availabilityStarts": "2026-04-02",
      "availabilityEnds": "2026-12-09",
      "inventoryLevel": {
        "@type": "QuantitativeValue",
        "value": 6,
        "unitText": "places"
      }
    }
  }
  </script>
</head>
<body>
  <h1>Formation Symfony</h1>
</body>
</html>`,
};

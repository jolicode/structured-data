## HOW TO READ OR UPDATE THESE JSON FILES

These JSON files are manually written and define the Google structured-data type specifications and are used to generate PHP validation classes. They are based on the official Google documentation.

You should not normally need to read these files directly — they are primarily used for code generation. However, if you're updating or maintaining the validator, you'll very likely need to work with these files.

### UPDATING THESE FILES

First, you will need to check if Google made adjustments to its documentation. This is very likely. Run:

```bash
castor google:generation:crawl-google
```

This will crawl Google and try to discover all the Google types.
The first checked source will be [the search gallery](https://developers.google.com/search/docs/appearance/structured-data/search-gallery). This lists most of the Google types.
However, this list alone cannot be trusted. So, then we will search through all the links pointing to a possible structured-data type.
It will then update the manifest file, which holds informations about all the structured-data Google URLs this project knows about, along with their curent status.
Finally, it will extract the tables holding the validation properties out of each of these pages to a related HTML file.

Once you downloaded everything you need, you can audit the changes by running:

```bash
castor google:generation:verify-docs
```

It will give you detailed informations about the current support the project has of the Google documentation.

If you need to manually update a specific type definition (e.g., to refine a special rule, add/remove/update a property, or even create a new type),
first edit the corresponding JSON file directly and then regenerate the classes by running:

```bash
castor generate google
```

For a complete update workflow, use the dedicated upgrade guidelines at `../UPGRADE_GUIDELINES.md`.

### KEYWORDS

- **name**: The general name of the data structure (e.g., `Article`, `Recipe`). Required.
- **documentation**: A URL (with anchor) pointing to the Google structured-data documentation.
- **specialRules**: An array of special-rule keys applied for this type (e.g., `"google.breadcrumb.last_item_optional"`). These keys are resolved by the SpecialRulesRegistry at validation time.
- **supportedTypes**: Defines what the `@type` entry must be (or must be one of, if in an array).
- **value**: Used when a specific value is expected for a property. If set, `supportedTypes` must be a DataType (usually `Text` or `URL`, but not exclusively).
- **@target**: Used when a property accepts multiple types with different property sets. Defines properties for a targeted type. See `Book.json` for an example.
- **properties**: The validation properties for a given type.
- **subtypes**: Rarely used. when two types share the same name but are distinct variants. See below for details.
- **subtype**: Identifies which variant in a `subtypes` definition this entry represents.

### SPECIAL CASES

#### TYPE REFERENCES
When a type is referenced in the `supportedTypes` key, it almost always references a schema.org type.
However, in rare cases, a reference to a custom generated type may be used for brevity or convenience.
When this is the case, the `supportedTypes` value starts with `@`.
Use with caution! Google may have different rules for the same type depending on context.
If this is the case, you can use the @target keyword to define validation properties for a specific type. It was done in `ItemList.json` if you want an example.

#### MULTIPLE TYPES DEFINED ON THE SAME PAGE
When Google documents multiple types on a single page, they are handled in two ways:
- **Standalone types** (e.g., `Library` on the `Book` page): Create their own JSON file (e.g., `Library.json`).
- **Subtype variants** (e.g., `Book - Edition` vs `Book - Work`): Add all variants to the same JSON file (e.g., `Book.json`) under the `subtypes` key, with each variant having its own `subtype` field to distinguish them.


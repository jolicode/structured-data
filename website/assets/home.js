// The homepage, public/index.html: its form, or one of its examples, opens the
// page of the validator with a document. Nothing is audited here.

import { examples } from "./examples.js";
import { stateUrl } from "./pageState.js";

const form = document.querySelector("form");
const errorElement = form.querySelector("[data-validation-error]");

// The validator reads the document in the fragment of its URL, or in the
// session storage when it is too long for a URL: see pageState.js
async function validate(body) {
  if (body.trim() === "") {
    errorElement.textContent = "Please enter some code to validate.";

    return;
  }

  const url = await stateUrl("validator/", { document: body });

  if (!url.includes("#")) {
    errorElement.textContent = "This document is too long for a link, and your browser gives this page no storage to hand it to the validator.";

    return;
  }

  errorElement.textContent = "";
  location.assign(url);
}

form.addEventListener("submit", (event) => {
  event.preventDefault();
  validate(form.elements.body.value);
});

document.addEventListener("click", (event) => {
  const example = event.target.closest("[data-example]");
  if (!example) {
    return;
  }

  // Shown in the form too: it is there when the visitor comes back
  form.elements.body.value = examples[example.dataset.example];
  validate(form.elements.body.value);
});

// Until then, submitting would reload the page
form.querySelector('button[type="submit"]').disabled = false;

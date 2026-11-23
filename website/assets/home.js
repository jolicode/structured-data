// The homepage, public/index.html: its form, or one of its examples, opens the
// page of the validator with a document, pasted or loaded from a URL. Nothing
// is audited here.

import { examples } from "./examples.js";
import { loadPage } from "./loadUrl.js";
import { stateUrl } from "./pageState.js";

const form = document.querySelector("form");
const errorElement = form.querySelector("[data-validation-error]");
const errorMessage = errorElement.querySelector("[data-validation-error-message]");
const errorAdvice = errorElement.querySelector("[data-validation-error-advice]");
// "Load", that loads the page of the URL, and "Validate"
const submitButtons = form.querySelectorAll('button[type="submit"]');
const enableSubmitButtons = (enabled) => submitButtons.forEach((button) => (button.disabled = !enabled));

// No message hides the error. "pasteable" is a page that could not be loaded:
// the error advises to paste it, or to validate it elsewhere
function showError(message, pasteable = false) {
  errorMessage.textContent = message;
  errorAdvice.hidden = !pasteable;
  errorElement.hidden = message === "";
}

// The validator reads the document in the fragment of its URL, or in the
// session storage when it is too long for a URL: see pageState.js
async function validate(body) {
  if (body.trim() === "") {
    showError("Please enter some code to validate.");

    return;
  }

  const url = await stateUrl("validator/", { document: body });

  if (!url.includes("#")) {
    showError("This document is too long for a link, and your browser gives this page no storage to hand it to the validator.");

    return;
  }

  showError("");
  location.assign(url);
}

form.addEventListener("submit", async (event) => {
  event.preventDefault();

  // The "Load" button, the one of the Enter key in the URL too: the page of
  // the URL is the document
  if (event.submitter?.hasAttribute("data-load-url")) {
    showError("");
    enableSubmitButtons(false);

    try {
      const { body, error, pasteable } = await loadPage(form.elements.url.value);

      if (error) {
        showError(error, pasteable);

        return;
      }

      // Shown in the form too: it is there when the visitor comes back
      form.elements.body.value = body;
    } finally {
      enableSubmitButtons(true);
    }
  }

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
enableSubmitButtons(true);

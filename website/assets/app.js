import { Application } from "@hotwired/stimulus";
import HighlightController from "./controllers/highlight_controller.js";
import ResultController from "./controllers/result_controller.js";
import { examples } from "./examples.js";
import { audit } from "./php.js";
import { loadSettings } from "./validatorSettings.js";

const app = Application.start();
app.register("highlight", HighlightController);
app.register("result", ResultController);

const submitButtons = () => document.querySelectorAll('button[type="submit"]');

// Both the form of the homepage and the one of the result audit their "body"
// field, and show the result in place of the <main> they are in. Stimulus sees
// the new one, and starts its controllers.
document.addEventListener("submit", async (event) => {
  event.preventDefault();

  const form = event.target;
  const errorElement = form.querySelector("[data-validation-error]");
  const { mergeSharedIdentifiers, allowPendingVocabulary } = loadSettings();

  errorElement.textContent = "";
  submitButtons().forEach((button) => (button.disabled = true));

  try {
    const { html, error } = await audit({
      body: form.elements.body.value,
      mergeSharedIdentifiers,
      allowPendingVocabulary,
    });

    if (error) {
      errorElement.textContent = error;
    } else {
      document.querySelector("main").outerHTML = html;
      window.scrollTo(0, 0);
    }
  } catch (error) {
    console.error(error);
    errorElement.textContent = "The validator crashed on this document, see the console for details.";
  } finally {
    submitButtons().forEach((button) => (button.disabled = false));
  }
});

document.addEventListener("click", (event) => {
  const example = event.target.closest("[data-example]");
  if (!example) {
    return;
  }

  const form = document.querySelector("form");
  form.elements.body.value = examples[example.dataset.example];
  form.requestSubmit();
});

// Until then, submitting would reload the page
submitButtons().forEach((button) => (button.disabled = false));

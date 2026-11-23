// The "Copy" buttons of the pages: the button says whether it worked, for a
// moment.

const FEEDBACK_DELAY = 1500;

// The label of each button, and the timeout that brings it back: a second
// click comes while the button still says "Copied"
const labels = new WeakMap();
const timeouts = new WeakMap();

export async function copyWithFeedback(text, button) {
  if (!labels.has(button)) {
    labels.set(button, button.textContent);
  }

  try {
    await navigator.clipboard.writeText(text);
    button.textContent = "Copied";
  } catch {
    button.textContent = "Not copied";
  }

  clearTimeout(timeouts.get(button));
  timeouts.set(
    button,
    setTimeout(() => (button.textContent = labels.get(button)), FEEDBACK_DELAY),
  );
}

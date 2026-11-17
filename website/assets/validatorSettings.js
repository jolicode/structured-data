// Validation settings persisted in the browser: the settings menu of the result
// writes them, and each audit reads them.

const STORAGE_KEY = "structured-data-validator-settings";

export const defaultSettings = {
  mergeSharedIdentifiers: true,
  autoExpandWarnings: false,
  allowPendingVocabulary: true,
};

export function loadSettings() {
  try {
    return { ...defaultSettings, ...JSON.parse(localStorage.getItem(STORAGE_KEY) ?? "{}") };
  } catch {
    return { ...defaultSettings };
  }
}

export function persistSettings(settings) {
  localStorage.setItem(STORAGE_KEY, JSON.stringify({ ...defaultSettings, ...settings }));
}

// Validation settings persisted in the browser: the settings menu of the result
// writes them, and each audit reads them.

const STORAGE_KEY = "structured-data-validator-settings";

export const defaultSettings = {
  mergeSharedIdentifiers: true,
  autoExpandWarnings: false,
  allowPendingVocabulary: true,
  showDescriptions: true,
  // what "Expand all / Collapse all" of the result last did
  expandTree: false,
};

export function loadSettings() {
  try {
    return { ...defaultSettings, ...JSON.parse(localStorage.getItem(STORAGE_KEY) ?? "{}") };
  } catch {
    return { ...defaultSettings };
  }
}

// merged into what is stored: the settings menu and the toolbar of the result
// each write only their own settings
export function persistSettings(settings) {
  localStorage.setItem(STORAGE_KEY, JSON.stringify({ ...loadSettings(), ...settings }));
}

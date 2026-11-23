// The page of the validator, public/validator/index.html: audits the document
// it is opened with, and shows the result, see controllers/result_controller.js.

import { Application } from "@hotwired/stimulus";
import HighlightController from "./controllers/highlight_controller.js";
import ResultController from "./controllers/result_controller.js";

const app = Application.start();
app.register("highlight", HighlightController);
app.register("result", ResultController);

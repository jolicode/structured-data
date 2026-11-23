// The page of the playground, public/playground/index.html: the JSON-LD
// algorithms of the library, run on what the visitor types.

import { Application } from "@hotwired/stimulus";
import PlaygroundController from "./controllers/playground_controller.js";

const app = Application.start();
app.register("playground", PlaygroundController);

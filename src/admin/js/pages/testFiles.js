import Swal from "sweetalert2";
import { createPond } from "./plugins/filepond/_config";
import { validateMinFilesIntoFilePond } from "./plugins/filepond/_validations";

const form = document.querySelector("#form");
const inputsConfig = JSON.parse(document.querySelector("#config").value);

const references = inputsConfig.map((inputConfig) => {
  const { name, minFiles, ...config } = inputConfig;
  const input = document.querySelector(`#${name}`);
  const pond = createPond(input, config, name, minFiles);
  const reference = { pond, input, minFiles };
  return reference;
});

form.addEventListener("submit", async function (e) {
  e.preventDefault();

  const existAlert = references.map((reference) => {
    const { pond, input, minFiles } = reference;
    return !validateMinFilesIntoFilePond(pond, input, minFiles);
  });

  if (existAlert.some((isTrue) => isTrue)) {
    Swal.fire({
      icon: "error",
      title: "Oops!!",
      text: "Verifique que haya proporcionado los datos necesarios para poder guardar sus cambios.",
    });

    return;
  }

  this.submit();
});

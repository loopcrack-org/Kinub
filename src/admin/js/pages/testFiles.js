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

  const existError = references.map((reference) => {
    const { pond, input, minFiles } = reference;
    const { id: inputId } = input;
    return (
      pond.getFiles().some((file) => file.status === 8 || file.status === 3) ||
      !validateMinFilesIntoFilePond(pond, inputId, minFiles)
    );
  });

  if (existError.some((error) => error)) {
    Swal.fire({
      icon: "warning",
      title: "Oops!!",
      text: "Verifique que haya proporcionado los datos necesarios o que los archivos se hayan subido correctamente.",
    });

    return;
  }

  this.submit();
});

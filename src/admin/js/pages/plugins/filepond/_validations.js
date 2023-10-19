import { createAlert, removeAlert } from "./_alerts";
export function validateMinFilesIntoFilePond(pond, input, minFiles) {
  if (!minFiles) return true;

  const hasMinFiles = pond.getFiles().length >= minFiles;

  if (!hasMinFiles) {
    createAlert(
      input,
      `El mínimo de archivos necesarios es de ${minFiles}`,
      "warning",
      "minFile"
    );
  } else {
    removeAlert(input, "minFile");
  }

  return hasMinFiles;
}

export function validateMaxFilesIntoFilePond(pond, input) {
  if (!pond.maxFiles) return;

  const hasMaxFiles = pond.getFiles().length === pond.maxFiles;

  if (hasMaxFiles) {
    createAlert(
      input,
      `Ha alcanzado el numero máximo de archivos permitidos, por favor elimine uno si desea agregar otro`,
      "primary",
      "maxFile"
    );
  } else {
    removeAlert(input, "maxFile");
  }
}

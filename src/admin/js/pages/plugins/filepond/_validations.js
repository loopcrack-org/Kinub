import { createAlert, removeAlert } from "./_alerts";
export function validateMinFilesIntoFilePond(pond, inputId, minFiles) {
  if (!minFiles) return true;

  const hasMinFiles = pond.getFiles().length >= minFiles;

  if (!hasMinFiles) {
    createAlert(
      inputId,
      `El mínimo de archivos necesarios es de ${minFiles}`,
      "warning",
      "minFile"
    );
  } else {
    removeAlert(inputId, "minFile");
  }

  return hasMinFiles;
}

export function validateMaxFilesIntoFilePond(pond, inputId) {
  if (!pond.maxFiles) return;

  const hasMaxFiles = pond.getFiles().length === pond.maxFiles;

  if (hasMaxFiles) {
    createAlert(
      inputId,
      `Ha alcanzado el numero máximo de archivos permitidos, por favor elimine uno si desea agregar otro`,
      "primary",
      "maxFile"
    );
  } else {
    removeAlert(inputId, "maxFile");
  }
}

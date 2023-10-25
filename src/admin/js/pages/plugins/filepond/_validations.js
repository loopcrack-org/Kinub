import { createAlert, removeAlert } from "./_alerts";
import { FILE_PROCESSING_COMPLETE } from "./_config";
export function validateMinFilesInFilepond(pond, inputId, minFiles) {
  if (!minFiles) return true;

  const hasMinFiles = pond.getFiles().length >= minFiles;

  if (!hasMinFiles) {
    createAlert(
      inputId,
      `El mínimo de archivos necesarios es de ${minFiles}`,
      "warning",
      false,
      "minFile"
    );
  } else {
    removeAlert(inputId, "minFile");
  }

  return hasMinFiles;
}

export function validateMaxFilesInFilepond(pond, inputId) {
  if (!pond.maxFiles) return;

  const hasMaxFiles = pond.getFiles().length === pond.maxFiles;

  if (hasMaxFiles) {
    createAlert(
      inputId,
      `Ha alcanzado el numero máximo de archivos permitidos, por favor elimine uno si desea agregar otro`,
      "primary",
      true,
      "maxFile"
    );
  } else {
    removeAlert(inputId, "maxFile");
  }
}

export function filepondHasFileErrorOrInProcessing(pond) {
  return pond.getFiles().some(({ status }) => {
    return status !== FILE_PROCESSING_COMPLETE;
  });
}

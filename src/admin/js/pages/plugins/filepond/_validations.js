import { createAlert, removeAlert } from './_alerts';
import { FILE_LOCAL, FILE_PROCESSING_COMPLETE } from './_config';

export function validateMinFilesInFilepond(pond, inputId, minFiles) {
  if (!minFiles) return true;

  const hasMinFiles = pond.getFiles().length >= minFiles;

  if (!hasMinFiles) {
    createAlert(
      inputId,
      `El mínimo de archivos necesarios es de ${minFiles}`,
      'primary',
      false,
      false,
      'minFile'
    );
  } else {
    removeAlert(inputId, 'minFile');
  }

  return hasMinFiles;
}

export function validateMaxFilesInFilepond(pond, inputId, files = []) {
  if (!pond.maxFiles) return;
  const numPondFiles = pond.getFiles().length;
  const payloadLength = files.length;
  const exceedFiles = payloadLength + numPondFiles > pond.maxFiles;
  const hasMaxFiles = numPondFiles === pond.maxFiles;
  if (exceedFiles || hasMaxFiles) {
    removeAlert(inputId, 'maxFiles');
    createAlert(
      inputId,
      hasMaxFiles
        ? `Ha alcanzado el numero máximo de archivos permitidos. Por favor elimine uno si desea agregar otro`
        : `Ha intentado ingresar más archivos de los permitidos. Por favor, intente con una menor cantidad de archivos`,
      'primary',
      true,
      false,
      'maxFiles'
    );
  } else {
    removeAlert(inputId, 'maxFiles');
  }
}

export function filepondHasFileErrorOrInProcessing(pond) {
  return pond.getFiles().some(({ status }) => {
    return status !== FILE_PROCESSING_COMPLETE && status !== FILE_LOCAL;
  });
}

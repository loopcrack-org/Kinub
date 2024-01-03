import * as FilePond from 'filepond';
//  image-preview
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
// validate-size
import FilePondPluginImageValidateSize from 'filepond-plugin-file-validate-size';
// exif-ofientation
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
// file-encode
import FilePondPluginFileEncode from 'filepond-plugin-file-encode';
// validation-type
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
// media preview
import FilepondPluginMediaPreview from 'filepond-plugin-media-preview';
// pdf preview
import FilepondPluginPdfPreview from 'filepond-plugin-pdf-preview';
// validation file size
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';

import { createAlert, createAlertToDeleteServerFile } from './_alerts';
import { validateMaxFilesInFilepond, validateMinFilesInFilepond } from './_validations';

// File Origin
export const FILE_ORIGIN_INPUT = 1; // Is a file input by the user
export const FILE_ORIGIN_LIMBO = 2; // Restore from the server as a temporary file
export const FILE_ORIGIN_LOCAL = 3; // Is a local server file
// File Status
export const FILE_LOCAL = 2; // Files are located on server, local files
export const FILE_PROCESSING_COMPLETE = 5; // Files was processed well

FilePond.registerPlugin(
  FilePondPluginFileEncode,
  FilePondPluginImageValidateSize,
  FilePondPluginImageExifOrientation,
  FilePondPluginImagePreview,
  FilePondPluginFileValidateType,
  FilepondPluginMediaPreview,
  FilepondPluginPdfPreview,
  FilePondPluginFileValidateSize
);

export function createPond(input, config, name, minFiles, baseUrl) {
  const pond = FilePond.create(input, {
    ...config,
    server: getServerOptions(name, baseUrl),
    beforeRemoveFile: async (item) => {
      const { origin } = item;
      return origin === FILE_ORIGIN_LOCAL ? await createAlertToDeleteServerFile(item) : true;
    },
  });

  const { id: inputId } = input;
  validateMinFilesInFilepond(pond, inputId, minFiles);

  pond.on('error', (error, file) => {
    const message = error.code ? JSON.parse(error.body) : `${error.main} ${error.sub}`;
    createAlert(
      inputId,
      `${file.filename}. ${message}. Por favor ingrese un archivo diferente`,
      'danger',
      true,
      true
    );
    pond.removeFile(file.id);
  });

  pond.on('removefile', () => {
    validateMinFilesInFilepond(pond, inputId, minFiles);
    validateMaxFilesInFilepond(pond, inputId);
  });

  pond.on('processfile', () => {
    validateMinFilesInFilepond(pond, inputId, minFiles);
    validateMaxFilesInFilepond(pond, inputId);
  });

  pond.on('warning', (error, files) => {
    validateMaxFilesInFilepond(pond, inputId, files);
  });

  return pond;
}

function getServerOptions(nameInput, baseUrl) {
  return {
    url: baseUrl,
    process: {
      url: '/process',
      method: 'POST',
      headers: {
        input: nameInput,
      },
      onload: (response) => {
        const result =
          response instanceof XMLHttpRequest
            ? JSON.parse(response.responseText)
            : JSON.parse(response);
        return result.key;
      },
    },
    patch: {
      url: '/process?patch=',
      headers: {
        input: nameInput,
      },
    },
    restore: '/restore?file=',
    revert: '/delete',
    load: '/load?file=',
    remove: (source, load) => {
      addFileToDelete(nameInput, source);
      load();
    },
  };
}

function addFileToDelete(nameInput, source) {
  const deleteFileContainer = document.querySelector(`#delete-${nameInput}`);
  const fileToDelete = document.createElement('INPUT');
  fileToDelete.name = `delete-${nameInput}[]`;
  fileToDelete.type = 'hidden';
  fileToDelete.value = source;
  deleteFileContainer.appendChild(fileToDelete);
}

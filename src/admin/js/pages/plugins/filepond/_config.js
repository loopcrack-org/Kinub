import * as FilePond from "filepond";
//  image-preview
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
// validate-size
import FilePondPluginImageValidateSize from "filepond-plugin-file-validate-size";
// exif-ofientation
import FilePondPluginImageExifOrientation from "filepond-plugin-image-exif-orientation";
// file-encode
import FilePondPluginFileEncode from "filepond-plugin-file-encode";
// validation-type
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
// media preview
import FilepondPluginMediaPreview from "filepond-plugin-media-preview";
// pdf preview
import FilepondPluginPdfPreview from "filepond-plugin-pdf-preview";
// validation file size
import FilePondPluginFileValidateSize from "filepond-plugin-file-validate-size";

import { createAlert, createAlertToDeleteServerFile } from "./_alerts";
import {
  validateMaxFilesIntoFilePond,
  validateMinFilesIntoFilePond,
} from "./_validations";

const FILE_ORIGIN_INPUT = 1; // Is a file input by the user
const FILE_ORIGIN_LIMBO = 1; //Restore from the server as a temporaly file
const FILE_ORIGIN_LOCAL = 3; //Is a local server file

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

export function createPond(input, config, name, minFiles) {
  const pond = FilePond.create(input, {
    ...config,
    server: getServerOptions(name),
    beforeRemoveFile: async (item) => {
      const { origin } = item;
      return origin === FILE_ORIGIN_LOCAL
        ? await createAlertToDeleteServerFile(item)
        : true;
    },
  });

  const { id: inputId } = input;

  pond.on("error", (error, file) => {
    const flag = error.code && error.code === 500;
    const message = flag ? error.body : `${error.main} ${error.sub}`;
    createAlert(
      inputId,
      `${file.filename}. ${message}. Por favor ingrese otro.`,
      "danger"
    );
    pond.removeFile(file.id);
  });

  pond.on("removefile", (error, file) => {
    validateMinFilesIntoFilePond(pond, inputId, minFiles);
  });

  pond.on("warning", (error) => {
    validateMaxFilesIntoFilePond(pond, inputId);
  });

  return pond;
}

function getServerOptions(nameInput) {
  return {
    url: "/admin/api/files",
    process: {
      url: "/process",
      method: "POST",
      ondata: (formData) => {
        formData.append("inputName", nameInput);
        return formData;
      },
      onload: (response) => {
        const result =
          response instanceof XMLHttpRequest
            ? JSON.parse(response.responseText)
            : JSON.parse(response);
        return result.key;
      },
    },
    patch: "/process?patch=",
    restore: "/restore?file=",
    revert: "/deleteTmp",
    load: "/load?file=",
    remove: (source, load, error) => {
      addFileToDelete(nameInput, source);
      load();
    },
  };
}

function addFileToDelete(nameInput, source) {
  const deleteFileContainer = document.querySelector(`#delete-${nameInput}`);
  const fileToDelete = document.createElement("INPUT");
  fileToDelete.name = `delete-${nameInput}[]`;
  fileToDelete.type = "hidden";
  fileToDelete.value = source;
  deleteFileContainer.appendChild(fileToDelete);
}

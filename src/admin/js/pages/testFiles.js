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

import Swal from "sweetalert2";

FilePond.registerPlugin(
  FilePondPluginFileEncode,
  FilePondPluginImageValidateSize,
  FilePondPluginImageExifOrientation,
  FilePondPluginImagePreview,
  FilePondPluginFileValidateType,
  FilepondPluginMediaPreview,
  FilepondPluginPdfPreview
);

const form = document.querySelector("#form");
const inputsConfig = JSON.parse(document.querySelector("#config").value);
let filesToDelete = [];
const references = inputsConfig.map((inputConfig) => {
  const { name, minFiles, ...config } = inputConfig;
  const input = document.querySelector(`#${name}`);
  const pond = createPond(input, config, name);
  const reference = { pond, input, minFiles };
  //validateMinFilesIntoFilePond(reference);
  return reference;
});

form.addEventListener("submit", function (e) {
  e.preventDefault();
  const alerts = references.map((element) => {
    return hasMinFilesIntoFilePond(element);
  });

  if (alerts.some((alert) => alert === false)) return;

  this.submit();
});

function createPond(input, config, type) {
  const pond = FilePond.create(input, {
    ...config,
    server: getServerOptions(type),
    beforeRemoveFile: createAlertToDeleteServerFile,
  });

  const submitBtn = form.querySelector("[type='submit']");
  pond.on("addfilestart", (e) => {
    if (e.origin === 1) {
      submitBtn.disabled = true;
    }
  });
  pond.on("processfile", () => {
    submitBtn.disabled = false;
  });

  return pond;
}

async function createAlertToDeleteServerFile(item) {
  if (item.origin === 3) {
    const response = await Swal.fire({
      icon: "warning",
      title: `¿Desea eliminar el archivo ${item.filename}?`,
      text: "Esta acción no podrá deshacerse una vez que se hayan guardado los cambios",
      confirmButtonText: "Eliminar",
      cancelButtonText: "Cancelar",
      showCancelButton: true,
    });

    return response.isConfirmed;
  }

  return true;
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
    revert: "/deleteTmp",
    load: "/load?file=",
    remove: async (source, load, error) => {
      addFileToDelete(nameInput, source);
      load();
    },
  };
}

function hasMinFilesIntoFilePond({ pond, input, minFiles }) {
  if (!minFiles) return;

  if (pond.getFiles().length < minFiles) {
    createAlertModal(
      input,
      `El minimo de archivos necesarios es de ${minFiles}`,
      "warning"
    );

    return false;
  }

  return true;
}

function createAlertModal(input, message, type) {
  if (!document.querySelector(`#alert-${input.id}`)) {
    const alertModal = document.createElement("DIV");
    alertModal.id = `alert-${input.id}`;
    alertModal.classList.add(`alert-${type}`, "alert");
    alertModal.role = "alert";
    alertModal.textContent = message;

    document.querySelector(`#${input.id}`).before(alertModal);
  }
}

function addFileToDelete(nameInput, source) {
  const deleteFileContainer = document.querySelector(`#delete-${nameInput}`);
  const fileToDelete = document.createElement("INPUT");
  fileToDelete.name = `delete-${nameInput}[]`;
  fileToDelete.type = "hidden";
  fileToDelete.value = source;
  deleteFileContainer.appendChild(fileToDelete);
}

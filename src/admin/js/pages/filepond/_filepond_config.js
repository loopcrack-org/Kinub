export const serverOptions = {
  url: "api/files",
  process: {
    url: "/process",
    method: "POST",
    onload: (response) => {
      response =
        response instanceof XMLHttpRequest
          ? JSON.parse(response.responseText)
          : JSON.parse(response);
      return response.key;
    },
  },
  patch: "/process?patch=",
  revert: "/revert",
  load: "/load?file=",
  remove: removeFile,
};

export const defaultConfig = {
  chunkUploads: true,
  chunkSize: 1000000,
  labelFileTypeNotAllowed: "Archivo no valido",
  fileValidateTypeLabelExpectedTypes: `Se espera {allTypes}`,
  chunkUploads: true,
  chunkSize: 1000000,

  beforeRemoveFile: (item) => {
    return item.origin === 1 ? true : confirm("Quieres eliminarlo?");
  },
};

export const imageOptions = {
  imagePreviewHeight: 170,
  imageCropAspectRatio: "1:1",
  imageResizeTargetWidth: 200,
  imageResizeTargetHeight: 200,
};

export const mediaOptions = {
  allowVideoPreview: true,
  allowAudioPreview: true,
};

export const pdfOptions = {
  allowPdfPreview: true,
  pdfPreviewHeight: 200,
};

export function addData(formData, objectFilePond, nameInput) {
  formData.append("fileName", objectFilePond.getFile().filename);
  formData.append("type", nameInput);
  return formData;
}

export async function removeFile(source, load, error) {
  const response = await fetch("./api/files/revert", {
    headers: {
      "Content-Type": "text/plain;charset=UTF-8",
    },
    method: "DELETE",
    body: source,
  });

  load();
}

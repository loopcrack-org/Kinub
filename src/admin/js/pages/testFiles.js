import * as FilePond from "filepond";

// PLUGINS
//  image-preview
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
// ----
// validate-size
import FilePondPluginImageValidateSize from "filepond-plugin-file-validate-size";
// ----
// exif-ofientation
import FilePondPluginImageExifOrientation from "filepond-plugin-image-exif-orientation";
// ----
// file-encode
import FilePondPluginFileEncode from "filepond-plugin-file-encode";
// ----
// validation-type
// ----
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
// ----
// media preview
// ----
import FilepondPluginMediaPreview from "filepond-plugin-media-preview";
// ----
// pdf preview
// ----
import FilepondPluginPdfPreview from "filepond-plugin-pdf-preview";

FilePond.registerPlugin(
  // encodes the file as base64 data
  FilePondPluginFileEncode,
  // validates the size of the file
  FilePondPluginImageValidateSize,
  // corrects mobile image orientation
  FilePondPluginImageExifOrientation,
  // previews dropped images
  FilePondPluginImagePreview,
  // validation types
  FilePondPluginFileValidateType,
  // preview media
  FilepondPluginMediaPreview,
  // preview pdf
  FilepondPluginPdfPreview
);

const inputsConfig = JSON.parse(document.querySelector("#config").value);

inputsConfig.forEach((inputConfig) => {
  const { name, ...config } = inputConfig;
  const input = document.querySelector(`#${name}`);
  const pond = createPond(input, config, name);
  console.log(pond.files);
});

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
    revert: "/delete",
    load: "/load?file=",
    remove: async (source, load, error) => {
      const response = await fetch("/admin/api/files/delete", {
        headers: {
          "Content-Type": "text/plain;charset=UTF-8",
          type: "local",
        },
        method: "DELETE",
        body: source,
      });

      load();
    },
  };
}

function createPond(input, config, type) {
  const pond = FilePond.create(input, {
    ...config,
    server: getServerOptions(type),
    beforeRemoveFile: (item) => {
      return item.origin === 1 ? true : confirm("¿Quieres eliminarlo?");
    },
  });
  return pond;
}

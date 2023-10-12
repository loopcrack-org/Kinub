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

// import { getServerOptions } from "./filepond/_filepond_config";

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

function getServerOptions(nameInput, pond) {
  return {
    server: {
      url: "api/files",
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
        const response = await fetch("./api/files/delete", {
          headers: {
            "Content-Type": "text/plain;charset=UTF-8",
          },
          method: "DELETE",
          body: source,
        });

        load();
      },
    },
  };
}
function createPond(input, config, type) {
  const pond = FilePond.create(input, config);
  pond.setOptions(getServerOptions(type, pond));
  return pond;
}

// get a reference to the fieldset elements
const imageFieldset = document.querySelector("#images-files");
const svgFieldset = document.querySelector("#svg-files");
const videoFieldset = document.querySelector("#video-files");
const pdfFieldset = document.querySelector("#pdf-files");
// get a reference to the input elements
const inputImage = document.querySelector("#inputImage");
const inputSvg = document.querySelector("#inputSvg");
const inputVideo = document.querySelector("#inputVideo");
const inputPdf = document.querySelector("#inputPdf");
const config = JSON.parse(document.querySelector("#config").value);

const imagePond = createPond(
  imageFieldset,
  config.image,
  inputImage.getAttribute("name").replace("[]", "")
);
console.log(imagePond.server.load);
const svgPond = createPond(
  svgFieldset,
  config.svg,
  inputSvg.getAttribute("name").replace("[]", "")
);
const videoPond = createPond(
  videoFieldset,
  config.video,
  inputVideo.getAttribute("name").replace("[]", "")
);
const pdfPond = createPond(
  pdfFieldset,
  config.pdf,
  inputPdf.getAttribute("name").replace("[]", "")
);

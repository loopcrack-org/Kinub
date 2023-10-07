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

import {
  serverOptions,
  defaultConfig,
  mediaOptions,
  pdfOptions,
  imageOptions,
  addData,
} from "./filepond/_filepond_config";

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

FilePond.setOptions({
  ...defaultConfig,
});

// get a reference to the input elements
const imageInput = document.querySelector("#images-files");
const svgInput = document.querySelector("#svg-files");
const videoInput = document.querySelector("#video-files");
const documentInput = document.querySelector("#document-files");

const imagePond = FilePond.create(imageInput, {
  acceptedFileTypes: ["image/jpg", "image/png", "image/jpeg"],
  fileValidateTypeLabelExpectedTypes: "Selecciona jpg, jpeg o png",
  ...imageOptions,

  server: {
    ...serverOptions,
    process: {
      ...serverOptions.process,
      ondata: (formData) => addData(formData, imagePond, "image"),
    },
  },
});
const svgPond = FilePond.create(svgInput, {
  acceptedFileTypes: ["image/svg+xml"],
  fileValidateTypeLabelExpectedTypes: "Selecciona svg",
  ...imageOptions,
  server: {
    ...serverOptions,
    process: {
      ...serverOptions.process,
      ondata: (formData) => addData(formData, svgPond, "svg"),
    },
  },
});
const videoPond = FilePond.create(videoInput, {
  acceptedFileTypes: ["video/mp4"],
  fileValidateTypeLabelExpectedTypes: "Selecciona mp4",
  ...mediaOptions,
  server: {
    ...serverOptions,
    process: {
      ...serverOptions.process,
      ondata: (formData) => addData(formData, videoPond, "video"),
    },
  },
});

const pdfPond = FilePond.create(documentInput, {
  acceptedFileTypes: ["application/pdf"],
  fileValidateTypeLabelExpectedTypes: "Selecciona pdf",
  ...pdfOptions,
  server: {
    ...serverOptions,
    process: {
      ...serverOptions.process,
      ondata: (formData) => addData(formData, pdfPond, "pdf"),
    },
  },
});

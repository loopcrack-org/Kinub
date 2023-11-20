// FilePond
import * as FilePond from 'filepond';

import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';

import FilePondPluginFileEncode from 'filepond-plugin-file-encode';

import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';

import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';

FilePond.registerPlugin(
  // encodes the file as base64 data
  FilePondPluginFileEncode,
  // validates the size of the file
  FilePondPluginFileValidateSize,
  // corrects mobile image orientation
  FilePondPluginImageExifOrientation,
  // previews dropped images
  FilePondPluginImagePreview,
  FilePondPluginFileValidateType
);

FilePond.setOptions({
  labelIdle:
    'Arrastra y suelta tu imagen o <span class="filepond--label-action"> Selecciona </span>',
  labelFileTypeNotAllowed: 'Archivo no valido',
  fileValidateTypeLabelExpectedTypes: `Se espera {allTypes}`,
  allowReorder: true,
  maxFiles: 1,
  maxFileSize: '3MB',
});

//Since the input names should be unique, instances are created for each input that filepond will use.
FilePond.create(document.querySelector('input#icon'), {
  labelIdle:
    'Arrastra y suelta tu icono o <span class="filepond--label-action"> Selecciona </span>',
  acceptedFileTypes: 'image/svg+xml',
});

FilePond.create(document.querySelector('input#image'), {
  acceptedFileTypes: 'image/*',
});

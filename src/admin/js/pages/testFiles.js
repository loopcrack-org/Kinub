import * as FilePond from 'filepond';

// PLUGINS
//  image-preview
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
// ----
// validate-size
import FilePondPluginImageValidateSize from 'filepond-plugin-file-validate-size';
// ----
// exif-ofientation
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
// ----
// file-encode
import FilePondPluginFileEncode from 'filepond-plugin-file-encode';
// ---- 
// validation-type
// ----
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';


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
    FilePondPluginFileValidateType
);

FilePond.setOptions({
    labelIdle: 'Arrastra y suelta tu imagen o  <u style="cursor:pointer;">Selecciona</u>',
    imagePreviewHeight: 170,
    imageCropAspectRatio: '1:1',
    imageResizeTargetWidth: 200,
    imageResizeTargetHeight: 200,
    labelFileTypeNotAllowed: 'Achivo no válido',
    chunkUploads: true,
    chunkSize: 1000000,
    allowMultiple: true,
    maxFiles: 3,
    
    server: {
        url: window.location,
        process: {
            url: '/process',
            method: 'POST',
            headers: {
                'x-header': 'Hello World',
            },
            withCredentials: false,
            onload: (response) => {
                if(response instanceof XMLHttpRequest) {
                    response = JSON.parse(response.responseText);
                } else {
                    response = JSON.parse(response);
                }
                return response.key;
            },
            onerror: (response) => {
                console.table({
                    "data": response.data
                });
                return response.data;
            },
            ondata: (formData) => {
            },
        },
        revert: '/revert',       
    }
});

// get a reference to the input elements
const imageInput = document.querySelector('#images-files');
const svgInput = document.querySelector('#svg-files');
const videoInput = document.querySelector('#video-files');
const documentInput = document.querySelector('#document-files');

FilePond.create(imageInput, {
    acceptedFileTypes: ['image/jpg', 'image/png', 'image/jpeg'],
    fileValidateTypeLabelExpectedTypes: 'Selecciona jpg, jpeg o png',
});
FilePond.create(svgInput, {
    acceptedFileTypes: ['image/svg+xml'],
    fileValidateTypeLabelExpectedTypes: 'Selecciona svg',
});
FilePond.create(videoInput, {
    acceptedFileTypes: ['video/mp4'],
    fileValidateTypeLabelExpectedTypes: 'Selecciona mp4',
});
FilePond.create(documentInput, {
    acceptedFileTypes: ['application/pdf'],
    fileValidateTypeLabelExpectedTypes: 'Selecciona pdf',
});


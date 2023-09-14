/*
Template Name: Velzon - Admin & Dashboard Template
Author: Themesbrand
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: Form file upload Js File
*/

// FilePond
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


var inputMultipleElements = document.querySelectorAll('input.filepond-input-multiple');
if (inputMultipleElements) {

    // loop over input elements
    Array.from(inputMultipleElements).forEach(function (inputElement) {
        // create a FilePond instance at the input element location
        FilePond.create(inputElement, {
            labelIdle:
                'Arrastra y suelta tu imagen o  <u style="cursor:pointer;">Selecciona</u>',
            acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg", "video/mp4"],
            labelFileTypeNotAllowed: "Archivo no valido",
            fileValidateTypeLabelExpectedTypes: `Se espera {allTypes}`,
        });

    })

}
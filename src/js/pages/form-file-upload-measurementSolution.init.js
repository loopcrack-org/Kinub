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


FilePond.setOptions({
    labelIdle:
        'Arrastra y suelta tu imagen o <span class="filepond--label-action"> Selecciona </span>',
    labelFileTypeNotAllowed: "Archivo no valido",
    fileValidateTypeLabelExpectedTypes: `Se espera {allTypes}`,
    allowReorder: true,
    maxFiles: 1,
    maxFileSize: "3MB",
});

//Since the input names should be unique, instances are created for each input that filepond will use.
FilePond.create(document.querySelector("input[name='icon']"), {
    labelIdle:
        'Arrastra y suelta tu icono o <span class="filepond--label-action"> Selecciona </span>',
    acceptedFileTypes: "image/svg+xml",
});

FilePond.create(document.querySelector("input[name='image']"), {
    acceptedFileTypes: "image/*",
});

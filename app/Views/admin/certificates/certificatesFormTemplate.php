<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <label class="form-label mb-0" for="category-title-input">
                    <h5 class="card-title mb-0">Nombre del Certificado</h5>
                </label>
            </div>
            <div class="card-body">
                <div class="hstack gap-3 align-items-start">
                    <input type="text" class="form-control" name="certificatefileName" id="name" value="<?= old('certificatefileName') ?? $certificate['certificatefileName'] ?? ''; ?>" placeholder="Ingrese el nombre" required>
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<!-- end row -->

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Imagen de previsualización</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <input type="file" class="filepond" name="certificatePreviewId" required>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Archivo del certificado</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <input type="file" class="filepond" name="certificatefileId" required>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->
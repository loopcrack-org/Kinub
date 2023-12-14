<?php $errors = session()->get('errors'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <label class="form-label mb-0" for="category-title-input">
                    <h5 class="card-title mb-0">Nombre del Certificado</h5>
                </label>
            </div>
            <div class="card-body">
                <div>
                    <input type="text"  class="form-control <?= isset($errors['certificatefileName']) ? 'is-invalid' : '' ?>" name="certificatefileName" id="certificatefileName" value="<?= old('certificatefileName') ?? $certificate['certificatefileName'] ?? ''; ?>" placeholder="Ingrese el nombre" required>
                    <?php if (isset($errors['certificatefileName'])) : ?>
                        <div class="invalid-feedback">
                            <?= $errors['certificatefileName'] ?>
                        </div>
                    <?php endif ?>
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
                <?= view('admin/components/inputFilePond', ['config' => $filepondConfig['certificatePreviewId']]) ?>
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
                 <?= view('admin/components/inputFilePond', ['config' => $filepondConfig['certificatefileId']]) ?>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

<?php
    if (session()->has('response')) {
        $response = session()->get('response');
        ?>
    <div id="alertElement" data-response="<?= htmlspecialchars(json_encode($response)) ?>"></div>
<?php } ?>
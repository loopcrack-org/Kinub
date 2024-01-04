<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <label class="form-label mb-0" for="categoryName">
                    <h5 class="card-title mb-0">Título de la categoría</h5>
                </label>
            </div>
            <?php $errors = session()->get('errors') ?>
            <div class="card-body">
                <div class="hstack gap-3 align-items-start">
                    <div class="flex-grow-1">
                        <input type="text" class="form-control <?= isset($errors['categoryName']) ? 'is-invalid' : '' ?>" name="categoryName" id="categoryName" value="<?= old('categoryName') ?? $category['categoryName'] ?? ''; ?>" placeholder="Ingrese el título" maxlength="20" required>
                        <?= view('admin/templates/invalidInputError', ['error' => $errors['categoryName'] ?? null])?>
                    </div>
                </div>
                <div class="text-primary d-block text-end mt-1" id="categoryNameCharacterCount">0/20</div>
            </div>
        </div>
    </div>
    <!-- end col -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <label class="form-label mb-0" for="categorySubname">
                    <h5 class="card-title mb-0">Subtítulo de la categoría</h5>
                </label>
            </div>
            <?php $errors = session()->get('errors') ?>
            <div class="card-body">
                <div class="hstack gap-3 align-items-start">
                    <div class="flex-grow-1">
                        <input type="text" class="form-control <?= isset($errors['categorySubname']) ? 'is-invalid' : '' ?>" name="categorySubname" id="categorySubname" value="<?= old('categorySubname') ?? $category['categorySubname'] ?? ''; ?>" placeholder="Ingrese el subtitulo" maxlength="20" required>
                        <?= view('admin/templates/invalidInputError', ['error' => $errors['categorySubname'] ?? null])?>
                    </div>
                </div>
                <div class="text-primary d-block text-end mt-1" id="categorySubnameCharacterCount">0/20</div>
            </div>
        </div>
    </div>
    <!-- end col -->
</div>
<!-- end row -->


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Tags de la categoría</h5>
            </div>
            <div class="card-body">
                <div class="hstack gap-3 align-items-start">
                    <div class="flex-grow-1">
                        <input class="form-control <?= isset($errors['categoryTags']) ? 'is-invalid' : '' ?>" name="categoryTags" id="choices-text-remove-button" data-choices data-choices-multiple-remove="true" type="text" value="<?= old('categoryTags') ?? $category['categoryTags'] ?? ''; ?>" required />
                        <?= view('admin/templates/invalidInputError', ['error' => $errors['categoryTags'] ?? null])?>
                    </div>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Icono</h4>
            </div><!-- end card header -->

            <?= view('admin/components/inputFilePond', ['config' => $filepondConfig['icon']]) ?>
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Imagen de fondo</h4>
            </div><!-- end card header -->

            <?= view('admin/components/inputFilePond', ['config' => $filepondConfig['image']]) ?>
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
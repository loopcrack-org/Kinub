<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <label class="form-label mb-0" for="category-title-input">
                    <h5 class="card-title mb-0">Titulo de la categoría</h5>
                </label>
            </div>
            <?php $errors = session()->get('errors') ?>
            <div class="card-body">
                <div class="hstack gap-3 align-items-start">
                    <div class="flex-grow-1">
                        <input type="text" class="form-control <?= isset($errors['categoryName']) ? 'is-invalid' : '' ?>" name="categoryName" id="name" value="<?= old('categoryName') ?? $category['categoryName'] ?? ''; ?>" placeholder="Ingrese el título" required>
                        <?= view('admin/templates/invalidInputError', ['error' => $errors['categoryName'] ?? null])?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
    <div class="col-md-6">
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

            <div class="card-body">
                <input type="file" class="filepond" name="icon">
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
                <h4 class="card-title mb-0">Imagen de fondo</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <input type="file" class="filepond" name="image">
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
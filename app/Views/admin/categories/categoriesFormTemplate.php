<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <label class="form-label mb-0" for="category-title-input">
                    <h5 class="card-title mb-0">Titulo de la categoría</h5>
                </label>
            </div>
            <div class="card-body">
                <div class="hstack gap-3 align-items-start">
                    <input type="text" class="form-control" name="name" id="name" value="<?= $category["categoryName"] ?? "";?>" placeholder="Ingrese el título" required>
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
                        <input class="form-control" name="tags" id="choices-text-remove-button" data-choices data-choices-multiple-remove="true" type="text" value="<?= $category["tags"] ?? "";?>"/>
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
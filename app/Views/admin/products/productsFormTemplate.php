<div class="row">
    <!-- Product Name -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Nombre de producto</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <?= validation_show_error('name', 'validationError') ?>
                <label class="card-text" for="product_name">Ingresa el nombre del producto</label>
                <input type="text" class="form-control" name="product_name" id="name" placeholder="por ejemplo: Medidor..." value="<?= old('product_name') ?? ''?>" required>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->

    <!-- Product Model -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Nombre del modelo</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <?= validation_show_error('product_model', 'validationError') ?>
                <label class="card-text" for="product_model">Ingresa el modelo</label>
                <input type="text" class="form-control" name="product_model" id="model" placeholder="por ejemplo: E-639" value="<?= old('product_model') ?? ''?>" required>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

<div class="row">
    <!-- Product Category -->
    <div class="col-xl-4 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Categoría del producto</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <?= validation_show_error('product_category', 'validationError') ?>
                <label class="card-text" for="product_category">Selecciona la categoría</label>
                <input type="text" class="form-control" name="product_category" id="category" placeholder="por ejemplo: Telemetría..." value="<?= old('product_category') ?? ''?>" required>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->

    <!-- Category Tags -->
    <div class="col-xl-4 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Tags de categoría</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <?= validation_show_error('category_tags', 'validationError') ?>
                <label class="card-text" for="category_tags">Selecciona los tags de la categoría</label>
                <input type="text" class="form-control" name="category_tags" id="category-tags" value="<?= old('category_tags') ?? ''?>" required>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->

    <!-- Product Tags -->
    <div class="col-xl-4 col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Tags del producto</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <?= validation_show_error('product_tags', 'validationError') ?>
                <label class="card-text" for="product_tags">Selecciona los tags del producto</label>
                <input type="text" class="form-control" name="product_tags" id="product-tags" value="<?= old('product_tags') ?? ''?>" required>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

<div class="row">
    <!-- Product description -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Descripción del producto</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <?= validation_show_error('name', 'validationError') ?>
                <label class="card-text">Agrega una descripción al producto</label>
                <div class="wysiwyg-editor">
                    <div class="editor"></div>
                    <input class="input-wysiwyg" type="hidden" name="product_description" value="<?= old('product_description') ?? '<h1>Aquí un ejemplo</h1><br><p>Escribe una descripción para el producto</p>'?>" >
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
    <!-- Images -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Imagenes</h4>
            </div><!-- end card header -->
            <?= view('admin/components/inputFilePond', [
                'config' => $fileConfig['image'],
            ]) ?>

        </div>
        <!-- end card -->
    </div>
</div>
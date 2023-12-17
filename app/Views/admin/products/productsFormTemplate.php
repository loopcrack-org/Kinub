<div class="grid gap-0 column-gap-3 position-relative" style="--bs-rows: 2; --bs-columns: 2;">
    <div class="g-col-12 g-col-md-8" >
        <!-- Product Information -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Información del producto</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <!-- Product Name -->
                <div class="mb-3">
                    <?= validation_show_error('name', 'validationError') ?>
                    <label class="card-text" for="productName">Nombre del producto</label>
                    <input type="text" class="form-control" name="productName" id="name" placeholder="por ejemplo: Medidor..." value="<?= old('productName') ?? ''?>" required>
                </div>
                <!-- Product Model -->
                <div class="mb-3">
                    <?= validation_show_error('productModel', 'validationError') ?>
                    <label class="card-text" for="productModel">Ingresa el modelo</label>
                    <input type="text" class="form-control" name="productModel" id="model" placeholder="por ejemplo: E-639" value="<?= old('productModel') ?? ''?>" required>
                </div>
                <!-- Product description -->
                <div class="mb-3">
                    <?= validation_show_error('productDescription', 'validationError') ?>
                    <label class="card-text">Descripción del producto</label>
                    <div class="wysiwyg-editor">
                        <div class="editor"></div>
                        <input class="input-wysiwyg" type="hidden" name="productDescription" value="<?= old('productDescription') ?? '<h2>Producto de software</h2><p>El mejor producto de en el área de software</p><ul><li>Precio</li><li>Calidad</li><li>Rapidez</li></ul>'?>" >
                    </div>
                </div>
                <!-- Technical informatino -->
                <div class="mb-3 mt-4">
                    <?= validation_show_error('productTechnicalInfo', 'validationError') ?>
                    <div class="row gap-2 mb-2 align-items-center">
                        <div class="col-12 col-sm">
                            <label class="card-text">Agrega aquí las especificaciones</label>
                        </div>
                        <div class="mx-auto col-12 col-sm-5 col-md-4 col-l-3 row gap-3 justify-content-end">
                            <div id="keyValueButtonAdd" class="btn btn-sm btn-success col"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                data-bs-title="Agrega un fila Clave-Valor"
                                data-bs-custom-class="custom-tooltip"
                            >Agregar</div>
                        </div>
                    </div>
                    <div class="keyValue row justify-content-center px-1">
                        <?php foreach(old('technicalInfo') ?? [] as $key => $value):?>
                        <div class="keyValueRow row gap-3 align-items-center p-2">
                            <div class="col col-sm-auto p-0 mt-0">
                                <div
                                    class="btn btn-danger col keyValueButtonDelete"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Elimina esta fila Clave-Valor"
                                    data-bs-custom-class="custom-tooltip"
                                >
                                    <i class="ri-delete-bin-2-line"></i>
                                </div>
                            </div>
                            <div class="col-12 col-sm input-group p-0 my-auto">
                                <div class="input-group-text">Clave:</div>
                                <input value="<?=$key?>" type="text" class="keyValueKey form-control" id="inlineFormInputGroupUsername" placeholder="ej: Peso...">
                            </div>
                            <div class="col-12 col-sm input-group p-0 my-auto">
                                <div class="input-group-text">Valor:</div>
                                <input type="text" name="technicalInfo[<?=$key?>]" value="<?=$value?>" class="keyValueValue form-control" id="inlineFormInputGroupUsername" placeholder="5 kg">
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->

        <!-- Main Image -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Imagen principal</h4>
            </div><!-- end card header -->
            <?= view('admin/components/inputFilePond', [
                'config' => $fileConfig['main_image'],
            ]) ?>

        </div>
        <!-- end card -->

        <!-- Images -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Imagenes</h4>
            </div><!-- end card header -->
            <?= view('admin/components/inputFilePond', [
                'config' => $fileConfig['image'],
            ]) ?>

        </div>
        <!-- end card -->

        <!-- Videos -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Videos</h4>
            </div><!-- end card header -->
            <?= view('admin/components/inputFilePond', [
                'config' => $fileConfig['video'],
            ]) ?>

        </div>
        <!-- end card -->

        <!-- Brochures -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Brochure</h4>
            </div><!-- end card header -->
            <?= view('admin/components/inputFilePond', [
                'config' => $fileConfig['brochure'],
            ]) ?>
        </div>
        <!-- end card -->

        <!-- Certificates -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Certificados del producto</h4>
            </div><!-- end card header -->
            <?= view('admin/components/inputFilePond', [
                'config' => $fileConfig['product_certificate'],
            ]) ?>
        </div>
        <!-- end card -->

        <!-- User Manual -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Brochure</h4>
            </div><!-- end card header -->
            <?= view('admin/components/inputFilePond', [
                'config' => $fileConfig['user_manual'],
            ]) ?>
        </div>
        <!-- end card -->

        <!-- Datasheet -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Certificados del producto</h4>
            </div><!-- end card header -->
            <?= view('admin/components/inputFilePond', [
                'config' => $fileConfig['datasheet'],
            ]) ?>
        </div>
        <!-- end card -->

    </div>

    <!-- Tags -->
    <div class="g-col-12 g-col-md-4 p-0 sticky-md-top" style="top: 5.5rem;">
        <div class="sticky-md-top" style="top: 5.5rem;">
            <!-- Product Category -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Categoría del producto</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <?= validation_show_error('product_category', 'validationError') ?>
                    <label class="card-text" for="product_category">Selecciona la categoría</label>
                    <select id="category" name="category" class="" >
                        <option value="" selected>Selecciona</option>
                        <?php foreach ($categories as $category):?>
                        <option
                            value="<?= $category['categoryId']?>"
                            <?=old('category') === $category['categoryId'] ? 'selected' : '' ?>
                        >
                            <?=$category['categoryName']?>
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <!-- Category Tags -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Tags de categoría</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <?= validation_show_error('category_tags', 'validationError') ?>
                    <label class="card-text" for="categoryTags[]">Selecciona los tags de la categoría</label>
                    <select id="categoryTags" name="categoryTags[]" class="form-control" multiple>
                        <option value="">Selecciona una categoría</option>
                        <?php foreach (old('categoryTags') ?? [] as $categoryTag):?>
                        <option
                            value="<?= $categoryTag?>"
                        >
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <!-- Product Tags -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Tags del producto</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <?= validation_show_error('productTags', 'validationError') ?>
                    <label class="card-text" for="productTags">Selecciona los tags del producto</label>
                    <input type="text" class="form-control" name="productTags" id="productTags" value="<?= old('productTags') ?? ''?>" required>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
</div>
<!-- end row -->
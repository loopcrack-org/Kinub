<div class="grid gap-0 column-gap-3 position-relative">
    <div class="g-col-12 g-col-lg-8" >
        <!-- Product Information -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Información del producto</h4>
            </div><!-- end card header -->

            <div class="card-body grid row-gap-2">
                <div class="g-col-12 g-col-xxl-6">
                    <!-- Product Name -->
                    <div class="mb-3">
                        <?= validation_show_error('name', 'validationError') ?>
                        <label class="card-text" for="productName">Nombre del producto</label>
                        <input type="text" class="form-control" name="productName" id="name" placeholder="Medidor..." value="<?= old('productName') ?? ''?>" required>
                    </div>
                    <!-- Product Model -->
                    <div class="mb-3">
                        <?= validation_show_error('productModel', 'validationError') ?>
                        <label class="card-text" for="productModel">Ingresa el modelo</label>
                        <input type="text" class="form-control" name="productModel" id="model" placeholder="E-639..." value="<?= old('productModel') ?? ''?>" required>
                    </div>
                    <!-- Product Tags -->
                    <div class="mb-3">
                        <?= validation_show_error('productTags', 'validationError') ?>
                        <label class="card-text" for="productTags">Selecciona los tags del producto</label>
                        <input type="text" class="form-control" name="productTags" id="productTags" value="<?= old('productTags') ?? ''?>">
                    </div>
                    <!-- Technical information -->
                    <div class="m-3">
                        <?= validation_show_error('productTechnicalInfo', 'validationError') ?>
                        <div class="row gap-2 mb-2 align-items-center">
                            <div class="col-12 col-sm">
                                <label class="card-text">Detalles del producto</label>
                            </div>
                            <div class="mx-auto col-12 col-sm-5 col-md-4 col-l-3 row gap-3 justify-content-end">
                                <div id="keyValueButtonAdd" class="btn btn-sm btn-success col">Agregar</div>
                            </div>
                        </div>
                        <div class="keyValue row justify-content-center px-1">
                            <?php if(empty(old('technicalInfo'))): ?>
                                <?=view('admin/components/keyValueInput', ['key' => '', 'value' => ''])?>
                            <?php endif; ?>
                            <?php foreach(old('technicalInfo') ?? [] as $key => $value):?>
                            <?=view('admin/components/keyValueInput', ['key' => $key, 'value' => $value])?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="mb-3 g-col-12 g-col-xxl-6">
                    <!-- Main Image -->
                    <div class="mb-3">
                        <label class="card-text">Imagen principal</label>
                        <?= view('admin/components/inputFilePond', [
                            'config' => $fileConfig['main_image'],
                        ]) ?>
                    </div>
                </div>

                <!-- Carrousel images and videos -->
                <div class="g-col-12">
                    <!-- Images -->
                    <div class="mb-3">
                        <label class="card-text">Imagenes</label>
                        <?= view('admin/components/inputFilePond', [
                            'config' => $fileConfig['image'],
                        ]) ?>
                    </div>
                    <!-- Videos -->
                    <div class="mb-3">
                        <label class="card-text">Videos</label>
                        <?= view('admin/components/inputFilePond', [
                            'config' => $fileConfig['video'],
                        ]) ?>
                    </div>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>

    <div class="sidebar g-col-12 g-col-lg-4 p-0 sticky-lg-top" style="top: 5.5rem; height:min-content">
        <!-- Tags -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Categoría del producto</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <!-- Category -->
                <div class="mb-3">
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
                <!-- Category Tags -->
                <div class="mb-3">
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
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>

    <div class="g-col-12 g-col-lg-8">
        <!-- Detail Product Information -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Información detallada del producto</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <!-- Product description -->
                <div class="mb-3">
                    <?= validation_show_error('productDescription', 'validationError') ?>
                    <label class="card-text">Descripción del producto</label>
                    <div class="wysiwyg-editor"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        data-bs-title="Este campo es obligatorio"
                        data-bs-custom-class="custom-tooltip"
                    >
                        <div class="editor"></div>
                        <input class="input-wysiwyg" type="hidden" name="productDescription" value="<?= old('productDescription') ?? ''?>" required >
                    </div>
                </div>

                <!-- Technical specification-->
                <div class="mb-3">
                    <?= validation_show_error('productDescription', 'validationError') ?>
                    <label class="card-text">Especificaciones técnicas</label>
                    <div class="wysiwyg-editor"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        data-bs-title="Este campo es obligatorio"
                        data-bs-custom-class="custom-tooltip"
                    >
                        <div class="editor"></div>
                        <input class="input-wysiwyg" type="hidden" name="productDescription" value="<?= old('productDescription') ?? '<h2>Producto de software</h2><p>El mejor producto de en el área de software</p><ul><li>Precio</li><li>Calidad</li><li>Rapidez</li></ul>'?>" required >
                    </div>
                </div>

                <!-- Download Área -->
                <div class="mb-3">
                    <h5 class="card-subtitle">Área de descarga</h5>
                </div>
                <!-- Brochure -->
                <div class="mb-3">
                    <label class="card-text" for="">Brochures</label>
                    <?= view('admin/components/inputFilePond', [
                        'config' => $fileConfig['brochure'],
                    ]) ?>
                </div>
                <!-- Datasheet -->
                <div class="mb-3">
                    <label class="card-text" for="">Datasheet</label>
                    <?= view('admin/components/inputFilePond', [
                        'config' => $fileConfig['datasheet'],
                    ]) ?>
                </div>
                <!-- User Manual -->
                <div class="mb-3">
                    <label class="card-text" for="">Manual de usuario</label>
                    <?= view('admin/components/inputFilePond', [
                        'config' => $fileConfig['user_manual'],
                    ]) ?>
                </div>
                <!-- Certificate -->
                <div class="mb-3">
                    <label class="card-text" for="">Certificados</label>
                    <?= view('admin/components/inputFilePond', [
                        'config' => $fileConfig['certificate'],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
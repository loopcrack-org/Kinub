<div class="grid gap-0 column-gap-3 position-relative">
    <div class="g-col-12 g-col-lg-8">
        <!-- Product Information -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Información del producto</h4>
            </div><!-- end card header -->

            <div class="card-body grid row-gap-0 column-gap-0">
                <div class="g-col-12">
                    <!-- Product Name -->
                    <div class="mb-3">
                        <label class="card-text" for="productName">Nombre del producto</label>
                        <input type="text" class="form-control <?= isset($errors['productName']) ? 'is-invalid' : '' ?>" name="productName" id="productName" placeholder="Ingresa el nobre del producto" value="<?= old('productName') ?? ''?>" required>
                        <?= view('admin/templates/invalidInputError', ['error' => $errors['productName'] ?? null])?>
                    </div>
                    <!-- Product Model -->
                    <div class="mb-3">
                        <label class="card-text" for="productModel">Ingresa el modelo</label>
                        <input type="text" class="form-control <?= isset($errors['productName']) ? 'is-invalid' : '' ?>" name="productModel" id="productModel" placeholder="Ingresa el modelo del producto" value="<?= old('productModel') ?? ''?>" required>
                        <?= view('admin/templates/invalidInputError', ['error' => $errors['productName'] ?? null])?>
                    </div>
                    <!-- Product Tags -->
                    <div class="mb-3">
                        <label class="card-text" for="productTags">Tags del producto</label>
                        <input type="text" class="form-control" name="productTags" id="productTags" value="<?= old('productTags') ?? ''?>">
                    </div>
                    <!-- Technical information -->
                    <div class="mb-3">
                        <div class="row mb-2 align-items-center">
                            <div class="col-12 col-sm">
                                <label class="card-text">Detalles del producto</label>
                            </div>
                        </div>
                        <div class="mb-2">
                            <?= view('admin/templates/invalidInputError', ['error' => $errors['productTechnicalInfo'] ?? null])?>
                            <?= view('admin/components/keyValue/keyValueContainer', [
                                'keyValues' => old('productTechnicalInfo') ?? [
                                    '' => '',
                                ],
                                'minValues' => 2,
                                'name'      => 'productTechnicalInfo',
                                'error'     => $errors['productTechnicalInfo'] ?? null,
                            ]) ?>
                        </div>
                    </div>
                </div>

                <!-- Carrousel images and videos -->
                <div class="g-col-12">
                    <!-- Main Image -->
                    <div class="mb-4">
                        <h5 class="fs-14 mb-2">Imagen principal</h5>
                        <label class="text-muted mb-3">Ingresa la imagen principal</label>
                        <?= view('admin/components/inputFilePond', [
                            'config' => $fileConfig['mainImage'],
                        ]) ?>
                    </div>
                    <!-- Main Video -->
                    <div class="mb-4">
                        <h5 class="fs-14 mb-2">Video principal</h5>
                        <label class="text-muted mb-3">Ingresa el video principal</label>
                        <?= view('admin/components/inputFilePond', [
                            'config' => $fileConfig['mainVideo'],
                        ]) ?>
                    </div>
                    <!-- Images -->
                    <div class="mb-4">
                        <h5 class="fs-14 mb-2">Imagenes</h5>
                        <label class="text-muted mb-3">Ingresa imagenes de galería</label>
                        <?= view('admin/components/inputFilePond', [
                            'config' => $fileConfig['image'],
                        ]) ?>
                    </div>
                    <!-- Videos -->
                    <div class="mb-4">
                        <h5 class="fs-14 mb-2">Videos</h5>
                        <label class="text-muted mb-3">Ingresa videos de galería</label>
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

    <div class="g-col-12 g-col-lg-4 p-0 sticky-lg-top z-1" style="top: 5.5rem; height:min-content">
        <!-- Tags -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Categoría del producto</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <!-- Category -->
                <div class="mb-4">
                    <h5 class="fs-14 mb-3">Categoría</h5>
                    <div class="form-control <?=isset($errors['productCategoryId']) ? 'is-invalid' : ''?> p-0 position-relative" style="background-image: none !important;">
                        <?php if(isset($errors['productCategoryId'])): ?>
                            <i class="las la-exclamation-circle position-absolute z-1" style="
                                right: 35px;
                                top: 9px;
                                color: var(--vz-red);
                                font-size: 20px;"
                            ></i>
                        <?php endif; ?>
                        <select id="productCategoryId" name="productCategoryId" required>
                            <option value="" selected>Selecciona</option>
                            <?php foreach ($categories as $category):?>
                            <option
                                value="<?= $category['categoryId']?>"
                                <?=old('productCategoryId') === $category['categoryId'] ? 'selected' : '' ?>
                            >
                                <?=$category['categoryName']?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <?= view('admin/templates/invalidInputError', ['error' => $errors['productCategoryId'] ?? null])?>
                </div>
                <!-- Category Tags -->
                <div class="mb-4">
                    <h5 class="fs-14 mb-2">Tags de categoría</h5>
                    <label class="text-muted mb-3">Ingresa tags de la categoría</label>
                    <div class="form-control <?=isset($errors['categoryTags[]']) ? 'is-invalid' : ''?> position-relative p-0" style="background-image: none !important;">
                        <div class="d-flex align-items-center h-100 position-absolute z-1 gap-2" style="right: 10px">
                            <?php if(isset($errors['categoryTags[]'])): ?>
                                <i class="las la-exclamation-circle" style="
                                    color: var(--vz-red);
                                    font-size: 20px;"
                                ></i>
                            <?php endif; ?>
                            <div id="tagSpinner"></div>
                        </div>
                        <select id="categoryTags" name="categoryTags[]" class="position-absolute z-1" multiple required>
                            <option value="">Selecciona</option>
                            <?php foreach (old('categoryTags') ?? [] as $categoryTag):?>
                            <option
                                value="<?= $categoryTag?>"
                            >
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <?= view('admin/templates/invalidInputError', ['error' => $errors['categoryTags[]'] ?? null])?>
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
                <div class="mb-4">
                    <?= validation_show_error('productDescription', 'validationError') ?>
                    <h5 class="fs-14 mb-2">Descripción</h5>
                    <label class="text-muted mb-3">Ingresa una descripción para el producto</label>
                    <div class="wysiwyg-editor position-relative z-1">
                        <div class="editor"></div>
                        <input class="input-wysiwyg" type="hidden" name="productDescription" value="<?= old('productDescription') ?? '<h2>Producto de software</h2><p>El mejor producto en el área de software</p><ul><li>Precio</li><li>Calidad</li><li>Rapidez</li></ul>'?>" required >
                    </div>
                </div>

                <!-- Product specific information-->
                <div class="mb-4">
                    <?= validation_show_error('productSpecificInformation', 'validationError') ?>
                    <h5 class="fs-14 mb-2">Especificaciones técnicas del producto</h5>
                    <label class="text-muted mb-3">Ingresa información más detallada del producto</label>
                    <div class="wysiwyg-editor">
                        <div class="editor"></div>
                        <input class="input-wysiwyg" type="hidden" name="productSpecificInformation" value="<?= old('productSpecificInformation') ?? '<h2>Producto de software</h2><p>El mejor producto en el área de software</p><ul><li>Precio</li><li>Calidad</li><li>Rapidez</li></ul>'?>" required >
                    </div>
                </div>

                <!-- Download Área -->
                <div class="mb-4 card-header py-3 px-0">
                    <h5>Área de descarga</h5>
                    <label class="text-muted mb-0">Documentos del producto</label>
                </div>
                <!-- Brochure -->
                <div class="mb-4">
                    <h5 class="fs-14 mb-3">Brochure</h5>
                    <?= view('admin/components/inputFilePond', [
                        'config' => $fileConfig['brochure'],
                    ]) ?>
                </div>
                <!-- Datasheet -->
                <div class="mb-4">
                    <h5 class="fs-14 mb-3">Datasheet</h5>
                    <?= view('admin/components/inputFilePond', [
                        'config' => $fileConfig['datasheet'],
                    ]) ?>
                </div>
                <!-- User Manual -->
                <div class="mb-4">
                    <h5 class="fs-14 mb-3">Manual de usuario</h5>
                    <?= view('admin/components/inputFilePond', [
                        'config' => $fileConfig['userManual'],
                    ]) ?>
                </div>
                <!-- Certificate -->
                <div class="mb-4">
                    <h5 class="fs-14 mb-3">Certificados</h5>
                    <?= view('admin/components/inputFilePond', [
                        'config' => $fileConfig['certificate'],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
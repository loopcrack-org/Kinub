<?php $errors = session()->get('errors'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <label class="form-label mb-0" for="category-title-input">
                    <h5 class="card-title mb-0">Titulo de la Solución de Medición</h5>
                </label>
            </div>
            <div class="card-body">
                <div class="hstack gap-3 align-items-start flex-column">
                    <input type="text" class="form-control  <?= isset($errors['msName']) ? 'is-invalid' : '' ?>" name="msName" id="name" value="<?= old('msName') ?? $solution['msName'] ?? ''; ?>" placeholder="Ingrese el título" required>
                    <?= view('admin/templates/invalidInputError', ['error' => $errors['msName'] ?? null])?>
                </div>
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
                <h5 class="card-title mb-0">Descripción de la Solución de Medición</h5>
            </div>
            <div class="card-body">
                <div class="hstack gap-3 align-items-start ">
                    <div class="flex-grow-1">
                        <textarea class="form-control <?= isset($errors['msDescription']) ? 'is-invalid' : '' ?>" rows="3" name="msDescription" placeholder="Ingrese la descripción de la solución de medición" required><?= old('msDescription') ?? $solution['msDescription'] ?? ''; ?></textarea>
                        <?= view('admin/templates/invalidInputError', ['error' => $errors['msDescription'] ?? null])?>
                    </div>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Icono</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <?= view('admin/components/inputFilePond', ['config' => $filepondConfig['msIcon']]) ?>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Imagen de fondo</h4>
            </div><!-- end card header -->

            <?= view('admin/components/inputFilePond', ['config' => $filepondConfig['msImage']]) ?>
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>

<!-- end row -->
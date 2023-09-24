<?php $this->extend('public/templates/layout'); ?>

<!-- CSS -->
<?php $this->section('css'); ?>
<link rel="stylesheet" href="assets/css/public.min.css" type="text/css">
<?php $this->endSection(); ?>

<!-- JS -->
<?php $this->section('js'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/libs/vanilla-validator/vanilla-validator-concat.min.js"></script>
<script src="assets/js/public/support.js"></script>
<?php $this->endSection(); ?>

<!-- FONTS -->
<?php $this->section('fonts'); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;700;800&family=Nunito+Sans:opsz,wght@6..12,400;6..12,700;6..12,900&display=swap" rel="stylesheet">
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<?php $errors = session()->get('errors'); ?>

    <main class="support">
        <h1 class="support__heading">Soporte Técnico</h1>

        <div class="container-sm support__content">
            <div class="support-progress">
                <div class="support-progress__step">
                    <p class="support-progress__name">Cliente</p>
                    <div class="support-progress__bullet">
                        <span class="support-progress__span">1</span>
                    </div>
                </div>

                <div class="support-progress__step">
                    <p class="support-progress__name">Producto</p>
                    <div class="support-progress__bullet">
                        <span class="support-progress__span">2</span>
                    </div>
                </div>

                <div class="support-progress__step">
                    <p class="support-progress__name">Problema</p>
                    <div class="support-progress__bullet">
                        <span class="support-progress__span">3</span>
                    </div>
                </div>
            </div>

            <?php 
                if (session()->has('response')):
                $response = session()->get('response');
            ?>
            <div id="alert-response" data-response="<?= htmlspecialchars(json_encode($response)) ?>"></div>
            <?php endif;?>

            <form class="support-form" id="support-form" action="/email/soporte" method="POST" novalidate> 
                <fieldset class="support-form__fieldset support-form__fieldset--active support-form__step" data-step="1">
                    <legend class="support-form__legend">Información del Cliente</legend>

                    <div class="support-form__field">
                        <label for="support-customer" class="support-form__label">Nombre</label>
                        
                        <?= isset($errors['support-customer']) ? '<p class="support-form__error support-form__error--active">'.$errors['support-customer'].'</p>' : '<p class="support-form__error" id="errors-1"></p>' ?>

                        <input 
                            id="support-customer"
                            name="support-customer"
                            type="text" 
                            class="support-form__input required" 
                            data-errors-id="errors-1"
                            placeholder="Ingrese su nombre"
                            value="<?php echo old("support-customer")?>"
                        >
                    </div>

                    <div class="support-form__field">
                        <label for="support-phone" class="support-form__label">Teléfono</label>
                        
                        <?= isset($errors['support-phone']) ? '<p class="support-form__error support-form__error--active">'.$errors['support-phone'].'</p>' : '<p class="support-form__error" id="errors-2"></p>' ?>

                        <input 
                            id="support-phone"
                            name="support-phone"
                            type="tel" 
                            class="support-form__input required phone" 
                            data-errors-id="errors-2"
                            placeholder="Ingrese su número telefónico"
                            value="<?php echo old("support-phone")?>"
                        >
                    </div>

                    <div class="support-form__field">
                        <label for="support-email" class="support-form__label">Correo</label>
                        
                        <?= isset($errors['support-email']) ? '<p class="support-form__error support-form__error--active">'.$errors['support-email'].'</p>' : '<p class="support-form__error" id="errors-3"></p>' ?>

                        <input 
                            id="support-email"
                            name="support-email"
                            type="email" 
                            class="support-form__input required email" 
                            data-errors-id="errors-3"
                            placeholder="Ingrese su correo"
                            value="<?php echo old("support-email")?>"
                        >
                    </div>

                    <span class="support-form__btn next-step">Siguiente</span>
                </fieldset>

                <fieldset class="support-form__fieldset support-form__step" data-step="2">
                    <legend class="support-form__legend">Información del Producto</legend>
                    <div class="support-form__field">
                        <label for="support-model" class="support-form__label">Modelo del Producto</label>
                        
                        <?= isset($errors['support-model']) ? '<p class="support-form__error support-form__error--active">'.$errors['support-model'].'</p>' : '<p class="support-form__error" id="errors-4"></p>' ?>

                        <input 
                            id="support-model"
                            name="support-model"
                            type="text" 
                            class="support-form__input required" 
                            data-errors-id="errors-4"
                            placeholder="Ingrese el modelo del producto"
                            value="<?php echo old("support-model")?>"
                        >
                    </div>

                    <div class="support-form__field">
                        <label for="support-serial" class="support-form__label">Número de Serie</label>
                        
                        <?= isset($errors['support-serial']) ? '<p class="support-form__error support-form__error--active">'.$errors['support-serial'].'</p>' : '<p class="support-form__error" id="errors-5"></p>' ?>

                        <input 
                            id="support-serial"
                            name="support-serial"
                            type="text" 
                            class="support-form__input required" 
                            data-errors-id="errors-5"
                            placeholder="Ingrese el numero de serie"
                            value="<?php echo old("support-serial")?>"
                        >
                    </div>

                    <div class="support-form__btns">
                        <span class="support-form__btn prev-step">Anterior</span>
                        
                        <span class="support-form__btn next-step">Siguiente</span>
                    </div>
                </fieldset>

                <fieldset class="support-form__fieldset" data-step="3">
                    <legend class="support-form__legend">Detalles del Problema</legend>
                    
                    <div class="support-form__field">   
                        <label for="support-problem-type" class="support-form__label">Tipo de Problema</label>
                        
                        <?= isset($errors['support-problem-type']) ? '<p class="support-form__error support-form__error--active">'.$errors['support-problem-type'].'</p>' : '<p class="support-form__error" id="errors-6"></p>' ?>

                        <select class="support-form__select required" data-errors-id="errors-6" id="support-problem-type" name="support-problem-type">
                            <option class="support-form__option support-form__option--selected" value="" disabled selected>Seleccionar opción</option>
                            <option class="support-form__option" <?php echo (old("support-problem-type") == "1") ?  'selected' : '' ?> value="1">categoria 1</option>
                            <option class="support-form__option" <?php echo (old("support-problem-type") == "2") ?  'selected' : '' ?>  value="2">categoria 2</option>
                            <option class="support-form__option" <?php echo (old("support-problem-type") == "3") ?  'selected' : '' ?> value="3">categoria 3</option>
                            <option class="support-form__option" <?php echo (old("support-problem-type") == "4") ?  'selected' : '' ?> value="4">categoria 4</option>
                        </select>
                    </div>

                    <div class="support-form__field">
                        <label for="support-problem" class="support-form__label">Problema del Producto</label>
                        
                        <?= isset($errors['support-problem']) ? '<p class="support-form__error support-form__error--active">'.$errors['support-problem'].'</p>' : '<p class="support-form__error" id="errors-7"></p>' ?>

                        <textarea class="support-form__textarea required" data-errors-id="errors-7" id="support-problem" name="support-problem" rows="5" placeholder="Describa el problema del producto"><?php echo old("support-problem")?></textarea>
                    </div>

                    <div class="support-form__btns">
                    <span class="support-form__btn prev-step">Anterior</span>
                    
                    <input class="support-form__submit" id="btn-submit" type="submit" value="Enviar">
                    </div>
                </fieldset>
            </form>
        </div>
    </main>
<?php $this->endSection('content');?>
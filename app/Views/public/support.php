<?php $this->extend('public/templates/layout'); ?>

<!-- CSS -->
<?php $this->section('css'); ?>
<link rel="stylesheet" href="assets/css/public.min.css" type="text/css">
<?php $this->endSection(); ?>

<!-- JS -->
<?php $this->section('js'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        <?php foreach(session()->get('errors') ?? [] as $error): ?>
            <p class="alert alert__error"><?php echo $error ?></p>
        <?php endforeach; ?>

        <div class="container-sm support__content">

            <div class="support-progress">
                <div class="support-progress__step">
                    <p class="support-progress__name">Cliente</p>
                    <div class="support-progress__bullet">
                        <span class="support-progress__span">1</span>
                    </div>
                    <div class="support-progress__check">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                        </svg>
                    </div>
                </div>

                <div class="support-progress__step">
                    <p class="support-progress__name">Producto</p>
                    <div class="support-progress__bullet">
                        <span class="support-progress__span">2</span>
                    </div>
                    <div class="support-progress__check">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                        </svg>
                    </div>
                </div>

                <div class="support-progress__step">
                    <p class="support-progress__name">Problema</p>
                    <div class="support-progress__bullet">
                        <span class="support-progress__span">3</span>
                    </div>
                    <div class="support-progress__check">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <?php 
                $response = session()->get('response');
                if(isset($response)):
            ?>
                <script type="module">
                    Swal.fire({
                        title: "<?= $response['title']; ?>",
                        text: "<?= $response['message']; ?>",
                        icon: "<?= $response['type']; ?>",
                        confirmButtonColor: '#0174F6'
                    })
                </script>
            <?php endif;?>

            <form class="support-form" id="support-form" method="POST"> 
                <fieldset class="support-form__fieldset">
                    <legend class="support-form__legend">Detalles del Problema</legend>
                    
                    <div class="support-form__field">   
                        <label for="support-categories" class="support-form__label">Tipo de Problema</label>
                        
                        <?= isset($errors['support-categories']) ? '<p class="support-form__error support-form__error--active">'.$errors['support-categories'].'</p>' : '<p class="support-form__error"></p>' ?>

                        <select class="support-form__select" id="support-categories" name="support-categories">
                            <option class="support-form__option support-form__option--selected" value="" disabled selected>Seleccionar opción</option>
                            <option class="support-form__option" <?php echo (old("support-categories") == "1") ?  'selected' : '' ?> value="1">categoria 1</option>
                            <option class="support-form__option" <?php echo (old("support-categories") == "2") ?  'selected' : '' ?>  value="2">categoria 2</option>
                            <option class="support-form__option" <?php echo (old("support-categories") == "3") ?  'selected' : '' ?> value="3">categoria 3</option>
                            <option class="support-form__option" <?php echo (old("support-categories") == "4") ?  'selected' : '' ?> value="4">categoria 4</option>
                        </select>
                    </div>

                    <div class="support-form__field">
                        <label for="support-message" class="support-form__label">Problema del Producto</label>
                        
                        <?= isset($errors['support-message']) ? '<p class="support-form__error support-form__error--active">'.$errors['support-message'].'</p>' : '<p class="support-form__error"></p>' ?>

                        <textarea class="support-form__textarea" id="support-message" name="support-message" rows="5" placeholder="Describa el problema del producto"><?php echo old("support-message")?></textarea>
                    </div>

                    <div class="support-form__btns">
                    <a class="support-form__btn" id="btn-prev-2">Anterior</a>
                    
                    <input class="support-form__submit" id="btn-submit" type="submit" value="Enviar">
                    </div>
                </fieldset>
            </form>
        </div>
    </main>
<?php $this->endSection('content');?>
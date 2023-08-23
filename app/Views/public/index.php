<?php $this->extend('public/templates/layout'); ?>

<?php $this->section('content'); ?>
<section id="form">
    <form class="container-sm form" method="POST">
        <div class="form__icon">
            <svg xmlns="http://www.w3.org/2000/svg" height="60" fill="#53d4ff" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
            </svg>
        </div>

        <legend class="form__legend">Contáctanos</legend>
        
        <div class="form__field">
            <label for="product-name" class="form__label">Nombre del Producto</label>
            <input id="product-name" name="product-name" type="text" class="form__input" value="<?php echo old("product-name")?>" placeholder="Ingrese el nombre del producto">
        </div>

        <div class="form__field">
            <label for="inquirer-name" class="form__label">Nombre del Solicitante</label>
            <input id="inquirer-name" name="inquirer-name" type="text" class="form__input" value="<?php echo old("inquirer-name")?>" placeholder="Ingrese su nombre">
        </div>

        <div class="form__field">
            <label for="inquirer-email" class="form__label">E-Mail</label>
            <input id="inquirer-email" name="inquirer-email" type="email" class="form__input" value="<?php echo old("inquirer-email")?>" placeholder="Ingrese su correo">
        </div>

        <div class="form__field">
            <label for="message" class="form__label">Mensaje</label>
            <textarea id="message" name="message" rows="5" class="form__textarea" placeholder="Ingrese su mensaje"><?php echo old("message")?></textarea>
        </div>

        <div class="form__submit">
            <input type="submit" value="Enviar">
            
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffffff" class="bi bi-send-fill" viewBox="0 0 16 16">
                <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
            </svg>
        </div>
    </form>
</section>
<?php $this->endSection('content');?>
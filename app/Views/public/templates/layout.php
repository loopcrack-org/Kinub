<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kinub | <?= $metaTitle ?? 'Inicio' ?></title>
    <meta property="og:site_name" content="Kinub">
    <meta property="og:title" content="Kinub | <?= $metaTitle ?? 'Inicio' ?>">
    <meta property="og:type" content="website" />
    <meta property="og:image" content="<?= $metaImage ?? base_url() . 'assets/images/kinub-logo-meta.png' ?>">
    <meta property="og:description" content="<?= $metaDescription ?? 'Bienvenido a Kinub' ?>">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta name="twitter:card" content="summary_large_image">
    <?php $this->renderSection('fonts'); ?>
    <?php $this->renderSection('css'); ?>
</head>
<body>

<?= $this->include('public/templates/header'); ?>
<?= $this->include('public/templates/whatsapp'); ?>
<?php $this->renderSection('content'); ?>

<?= $this->include('public/templates/footer'); ?>

<?php $this->renderSection('js'); ?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kinub | Home</title>
    <?php $this->renderSection('fonts'); ?>
    <?php $this->renderSection('css'); ?>
</head>
<body>

<?php $this->renderSection('content'); ?>

<?= $this->include("public/templates/footer"); ?>

<?php $this->renderSection('js'); ?>
</body>
</html>

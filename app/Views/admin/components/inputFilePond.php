<div class="card-body" data-name="<?= $config['name']?>">
    <!-- show an alert if validation failed -->
    <?= validation_show_error($config['name'], 'validationError') ?>

    <!-- show expected types -->
    <p class="card-text"><?=$config['fileValidateTypeLabelExpectedTypes']?></p>
    <!-- input filepond -->
    <input id="<?= $config['name']?>" type="file" name="<?= $config['name']?>[]">
    <!-- for delete files -->
    <div id="delete-<?=$config['name']?>" class="deleteFile">
        <?php foreach($config["deleteFiles"] ?? [] as $forDeleteFile): ?>
        <input type="hidden" name="delete-<?=$config['name']?>[]" value="<?=$forDeleteFile?>">
        <?php endforeach; ?>
    </div>
</div>
<div class="card-body" data-name="<?= $inputConfig['name']?>">
    <?php if(isset($error) && !empty($error)): ?>
        <p class="card-text alert alert-danger"><?=$error?></p>
    <?php endif; ?>
    <p class="card-text"><?=$inputConfig['fileValidateTypeLabelExpectedTypes']?></p>
    <input id="<?= $inputConfig['name']?>" type="file" name="<?= $inputConfig['name']?>[]">
    <div id="delete-<?=$inputConfig['name']?>" class="deleteFile"></div>
</div>
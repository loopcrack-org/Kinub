<div class="card-body" data-name="<?= $inputConfig['name']?>">
    <p class="card-text"><?=$inputConfig['fileValidateTypeLabelExpectedTypes']?></p>
    <div class="alert d-none"></div>
    <input id="<?= $inputConfig['name']?>" type="file" name="<?= $inputConfig['name']?>[]">
</div>
<!--
    This component use the following variables into $config passed:
    name:                                   The input name that represents the file type
    error:                                  Contains an error. It is used if there is a validation error.
    fileValidateTypeLabelExpectedTypes:     Message with the file types available
    deleteFiles:                            Save the files the user wants to delete
 -->
<div class="card-body filepond" data-name="<?= $config['name']?>">
    <!-- show an alert if validation failed -->
    <?= validation_show_error($config['name'], 'validationError') ?>
    <!-- show expected types -->
    <p class="card-text"><?=$config['fileValidateTypeLabelExpectedTypes']?></p>
    <!-- input filepond -->
    <input id="<?= $config['name']?>" type="file" name="<?= $config['name']?>[]">
    <!-- for delete files -->
    <div id="delete-<?=$config['name']?>" class="deleteFile">
        <?php if(isset($config['deleteFiles'])): ?>
        <?php foreach($config['deleteFiles'] as $forDeleteFile): ?>
        <input type="hidden" name="delete-<?=$config['name']?>[]" value="<?=$forDeleteFile?>">
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
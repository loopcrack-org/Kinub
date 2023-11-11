<!--
    This component use the following variables into $config passed:
    name:                                   The input name that represents the file type
    error:                                  Contains an error. It is used if there is a validation error.
    fileValidateTypeLabelExpectedTypes:     Message with the file types available
    deleteFiles:                            Save the files the user wants to delete
 -->
<div class="card-body" data-name="<?= $config['name']?>">
    <?php if(isset($config['error'])): ?>
        <!-- show an alert if validation failed -->
        <p class="card-text alert alert-danger"><?=$config['error']?></p>
    <?php endif; ?>
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
<div>
    <div class="keyValue px-0 row gap-3 justify-content-center w-100 mx-auto" data-min="<?=$minValues?>" data-name="<?=$name?>">
        <?php foreach($keyValues as $key => $value):?>
        <?=view(
            'admin/components/keyValue/keyValueInput',
            [
                'key' => ! is_numeric($key) ? $key : '', 'value' => $value, 'name' => $name,
            ]
        )?>
        <?php endforeach; ?>
    </div>
    <div class="p-0 mt-3 me-0 mx-auto col-12 col-sm-5 col-md-4 col-l-3 col-xl-3 col-xxl-3 row gap-3 justify-content-end">
        <button type="button" id="keyValueButtonAdd" class="btn btn-success col">Agregar</button>
    </div>
</div>
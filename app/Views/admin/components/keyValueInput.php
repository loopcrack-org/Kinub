<div class="keyValueRow row gap-3 align-items-center p-2">
    <div class="col-auto p-0 mt-0">
        <button
            class="btn btn-danger keyValueButtonDelete">
            <i class="ri-delete-bin-2-line"></i>
        </button>
    </div>
    <div class="col-12 col-sm input-group p-0 my-auto">
        <div class="input-group-text">Clave:</div>
        <input value="<?= $key?>" type="text" class="keyValueKey form-control" id="inlineFormInputGroupUsername" placeholder="ej: Peso..." required>
    </div>
    <div class="col-12 col-sm input-group p-0 my-auto">
        <div class="input-group-text">Valor:</div>
        <input type="text" name="technicalInfo[<?= $key?>]" value="<?= $value?>" class="keyValueValue form-control" id="inlineFormInputGroupUsername" placeholder="5 kg" required>
    </div>
</div>
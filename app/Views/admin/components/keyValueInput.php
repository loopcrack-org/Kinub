<div class="keyValueRow row gap-3 align-items-center p-2">
    <div class="col col-sm-auto p-0 mt-0">
        <div
            class="btn btn-danger col keyValueButtonDelete"
            data-bs-toggle="tooltip"
            data-bs-placement="top"
            data-bs-title="Elimina esta fila Clave-Valor"
            data-bs-custom-class="custom-tooltip"
        >
            <i class="ri-delete-bin-2-line"></i>
        </div>
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
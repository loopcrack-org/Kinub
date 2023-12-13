<!-- Modal -->
<div class="modal fade flip" id="<?= $idModal; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#25a0e2,secondary:#00bd9d" style="width:130px;height:130px">
                    </lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>¿Estás seguro?</h4>
                        <p class="text-muted mx-4 mb-0">
                            <?= $message; ?>
                        </p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <form class="modal-delete-form" action="<?= $action; ?>" method="post">
                        <input type="hidden" name="<?= $inputName; ?>" id="elementId" value="">
                        <button type="submit" class="btn w-sm btn-primary" id="delete-record">¡Sí, bórralo!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end modal -->
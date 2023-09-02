<div class="card-body p-4 text-center">
    <div class="avatar-lg mx-auto mt-2">
        <div class="avatar-title bg-light text-<?= $response['type'] ?> display-3 rounded-circle">
            <i class="ri-<?= $response['type'] != "success" ? 'error-warning' : 'checkbox-circle' ?>-fill"></i>
        </div>
    </div>
    <div class="mt-4 pt-2">
        <h4><?= $response['title'] ?></h4>
        <p class="text-muted mx-4"><?= $response['message'] ?></p>
        <div class="mt-4">
            <a href="/login" class="btn btn-<?= $response['type'] ?> w-100">Iniciar Sesión</a>
        </div>
    </div>
</div>
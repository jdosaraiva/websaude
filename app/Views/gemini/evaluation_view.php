<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2>Avaliação do Paciente</h2>
    <?php if ($data['status'] == 'OK'): ?>
        <div class="alert alert-success">
            <?= nl2br($data['message']) ?>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">
            <?= $data['message'] ?>
        </div>
    <?php endif; ?>
    <a href="<?= base_url('/formulario/listar_pacientes') ?>" class="btn btn-primary">Voltar</a>
</div>
<?= $this->endSection() ?>
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        Sucesso
    </div>
    <div class="card-body">
        <h5>Processo Finalizado com Sucesso!</h5>
        <p>Obrigado por fornecer todas as informações. Seu registro foi concluído com sucesso.</p>
        <a href="<?= site_url('/formulario/listar_pacientes') ?>" class="btn btn-primary">Voltar para a Página Inicial</a>
    </div>
</div>
<?= $this->endSection() ?>

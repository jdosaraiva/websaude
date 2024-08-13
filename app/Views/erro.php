<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Erro!</h4>
    <p><?= isset($mensagem) ? $mensagem : 'Ocorreu um erro inesperado. Por favor, tente novamente mais tarde.' ?></p>
    <hr>
    <p class="mb-0"><a href="<?= site_url('/') ?>" class="btn btn-primary">Voltar para a página inicial</a></p>
</div>
<?= $this->endSection() ?>

<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        Sintomas Atuais
    </div>
    <div class="card-body">
        <form action="<?= site_url('formulario/salvarSintomasAtuais/' . $paciente['id']) ?>" method="post">
            <input type="hidden" name="id" value="<?= $paciente['id'] ?>">
            <div class="form-group">
                <label for="sintomas">Sintomas:</label>
                <textarea class="form-control" id="sintomas" name="sintomas"><?= isset($paciente['sintomas']) ? $paciente['sintomas'] : '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="duracao_sintomas">Duração dos Sintomas:</label>
                <input type="text" class="form-control" id="duracao_sintomas" name="duracao_sintomas" value="<?= isset($paciente['duracao_sintomas']) ? $paciente['duracao_sintomas'] : '' ?>">
            </div>
            <div class="form-group">
                <label for="intensidade_sintomas">Intensidade dos Sintomas:</label>
                <input type="text" class="form-control" id="intensidade_sintomas" name="intensidade_sintomas" value="<?= isset($paciente['intensidade_sintomas']) ? $paciente['intensidade_sintomas'] : '' ?>">
            </div>
            <div class="form-group">
                <label for="fatores">Fatores:</label>
                <textarea class="form-control" id="fatores" name="fatores"><?= isset($paciente['fatores']) ? $paciente['fatores'] : '' ?></textarea>
            </div>
            <div class="form-group d-flex justify-content-between">
                <button type="submit" name="action" value="voltar" class="btn btn-secondary">Voltar</button>
                <button type="submit" name="action" value="proximo" class="btn btn-primary">Próximo</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

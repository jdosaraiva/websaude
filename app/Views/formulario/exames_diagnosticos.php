<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        Exames e Diagnósticos
    </div>
    <div class="card-body">
        <form action="<?= site_url('formulario/salvarExamesDiagnosticos/' . $paciente['id']) ?>" method="post">
            <input type="hidden" name="id" value="<?= $paciente['id'] ?>">
            <div class="form-group">
                <label for="exames">Exames:</label>
                <textarea class="form-control" id="exames" name="exames"><?= isset($paciente['exames']) ? $paciente['exames'] : '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="resultados">Resultados:</label>
                <textarea class="form-control" id="resultados" name="resultados"><?= isset($paciente['resultados']) ? $paciente['resultados'] : '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="diagnosticos">Diagnósticos:</label>
                <textarea class="form-control" id="diagnosticos" name="diagnosticos"><?= isset($paciente['diagnosticos']) ? $paciente['diagnosticos'] : '' ?></textarea>
            </div>
            <div class="form-group d-flex justify-content-between">
                <button type="submit" name="action" value="voltar" class="btn btn-secondary">Voltar</button>
                <button type="submit" name="action" value="proximo" class="btn btn-primary">Próximo</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        Notas e Plano de Tratamento
    </div>
    <div class="card-body">
        <form action="<?= site_url('formulario/salvarNotasPlanoTratamento/' . $paciente['id']) ?>" method="post">
            <input type="hidden" name="id" value="<?= $paciente['id'] ?>">
            <div class="form-group">
                <label for="notas">Notas:</label>
                <textarea class="form-control" id="notas" name="notas"><?= isset($paciente['notas']) ? $paciente['notas'] : '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="plano_tratamento">Plano de Tratamento:</label>
                <textarea class="form-control" id="plano_tratamento" name="plano_tratamento"><?= isset($paciente['plano_tratamento']) ? $paciente['plano_tratamento'] : '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="proximas_consultas">Próximas Consultas:</label>
                <textarea class="form-control" id="proximas_consultas" name="proximas_consultas"><?= isset($paciente['proximas_consultas']) ? $paciente['proximas_consultas'] : '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="consentimento">Consentimento:</label>
                <textarea class="form-control" id="consentimento" name="consentimento"><?= isset($paciente['consentimento']) ? $paciente['consentimento'] : '' ?></textarea>
            </div>
            <div class="form-group d-flex justify-content-between">
                <button type="submit" name="action" value="voltar" class="btn btn-secondary">Voltar</button>
                <button type="submit" name="action" value="proximo" class="btn btn-primary">Próximo</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

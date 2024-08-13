<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        Histórico Médico
    </div>
    <div class="card-body">
        <form action="<?= site_url('formulario/salvarHistoricoMedico/' . $paciente['id']) ?>" method="post">
            <input type="hidden" name="id" value="<?= $paciente['id'] ?>">
            <div class="form-group">
                <label for="condicoes">Condições Médicas Preexistentes:</label>
                <textarea class="form-control" id="condicoes" name="condicoes"><?= isset($paciente['condicoes']) ? $paciente['condicoes'] : '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="alergias">Alergias:</label>
                <textarea class="form-control" id="alergias" name="alergias"><?= isset($paciente['alergias']) ? $paciente['alergias'] : '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="medicacoes">Medicações:</label>
                <textarea class="form-control" id="medicacoes" name="medicacoes"><?= isset($paciente['medicacoes']) ? $paciente['medicacoes'] : '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="cirurgias">Cirurgias:</label>
                <textarea class="form-control" id="cirurgias" name="cirurgias"><?= isset($paciente['cirurgias']) ? $paciente['cirurgias'] : '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="historico_familiar">Histórico Familiar:</label>
                <textarea class="form-control" id="historico_familiar" name="historico_familiar"><?= isset($paciente['historico_familiar']) ? $paciente['historico_familiar'] : '' ?></textarea>
            </div>
            <div class="form-group d-flex justify-content-between">
                <button type="submit" name="action" value="voltar" class="btn btn-secondary">Voltar</button>
                <button type="submit" name="action" value="proximo" class="btn btn-primary">Próximo</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

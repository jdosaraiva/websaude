<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        Estilo de Vida
    </div>
    <div class="card-body">
        <form action="<?= site_url('formulario/salvarEstiloVida/' . $paciente['id']) ?>" method="post">
            <input type="hidden" name="id" value="<?= $paciente['id'] ?>">
            <div class="form-group">
                <label for="habitos_alimentares">Hábitos Alimentares:</label>
                <textarea class="form-control" id="habitos_alimentares" name="habitos_alimentares"><?= isset($paciente['habitos_alimentares']) ? $paciente['habitos_alimentares'] : '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="atividade_fisica">Atividade Física:</label>
                <textarea class="form-control" id="atividade_fisica" name="atividade_fisica"><?= isset($paciente['atividade_fisica']) ? $paciente['atividade_fisica'] : '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="alcool">Consumo de Álcool:</label>
                <textarea class="form-control" id="alcool" name="alcool"><?= isset($paciente['alcool']) ? $paciente['alcool'] : '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="tabaco">Consumo de Tabaco:</label>
                <textarea class="form-control" id="tabaco" name="tabaco"><?= isset($paciente['tabaco']) ? $paciente['tabaco'] : '' ?></textarea>
            </div>
            <div class="form-group d-flex justify-content-between">
                <button type="submit" name="action" value="voltar" class="btn btn-secondary">Voltar</button>
                <button type="submit" name="action" value="proximo" class="btn btn-primary">Próximo</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

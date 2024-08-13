<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        Confirmação
    </div>
    <div class="card-body">
        <h5>Informações Pessoais</h5>
        <p><strong>Nome:</strong> <?= $paciente['nome'] ?></p>
        <p><strong>Data de Nascimento:</strong> <?= $paciente['data_nascimento'] ?></p>
        <p><strong>Idade:</strong> <?= (new DateTime())->diff(new DateTime($paciente['data_nascimento']))->y ?></p>

        <h5>Histórico Médico</h5>
        <p><strong>Condições Médicas Preexistentes:</strong> <?= $paciente['condicoes'] ?></p>
        <p><strong>Alergias:</strong> <?= $paciente['alergias'] ?></p>
        <p><strong>Medicações:</strong> <?= $paciente['medicacoes'] ?></p>
        <p><strong>Cirurgias:</strong> <?= $paciente['cirurgias'] ?></p>
        <p><strong>Histórico Familiar:</strong> <?= $paciente['historico_familiar'] ?></p>

        <h5>Sintomas Atuais</h5>
        <p><strong>Sintomas:</strong> <?= $paciente['sintomas'] ?></p>
        <p><strong>Duração dos Sintomas:</strong> <?= $paciente['duracao_sintomas'] ?></p>
        <p><strong>Intensidade dos Sintomas:</strong> <?= $paciente['intensidade_sintomas'] ?></p>
        <p><strong>Fatores:</strong> <?= $paciente['fatores'] ?></p>

        <h5>Exames e Diagnósticos</h5>
        <p><strong>Exames:</strong> <?= $paciente['exames'] ?></p>
        <p><strong>Resultados:</strong> <?= $paciente['resultados'] ?></p>
        <p><strong>Diagnósticos:</strong> <?= $paciente['diagnosticos'] ?></p>

        <h5>Estilo de Vida</h5>
        <p><strong>Hábitos Alimentares:</strong> <?= $paciente['habitos_alimentares'] ?></p>
        <p><strong>Atividade Física:</strong> <?= $paciente['atividade_fisica'] ?></p>
        <p><strong>Consumo de Álcool:</strong> <?= $paciente['alcool'] ?></p>
        <p><strong>Consumo de Tabaco:</strong> <?= $paciente['tabaco'] ?></p>

        <h5>Notas e Plano de Tratamento</h5>
        <p><strong>Notas:</strong> <?= $paciente['notas'] ?></p>
        <p><strong>Plano de Tratamento:</strong> <?= $paciente['plano_tratamento'] ?></p>
        <p><strong>Próximas Consultas:</strong> <?= $paciente['proximas_consultas'] ?></p>
        <p><strong>Consentimento:</strong> <?= $paciente['consentimento'] ?></p>

        <div class="form-group d-flex justify-content-between">
            <a href="<?= site_url('formulario/notas_plano_tratamento/' . $paciente['id']) ?>" class="btn btn-secondary">Voltar</a>
            <a href="<?= site_url('formulario/finalizar/' . $paciente['id']) ?>" class="btn btn-primary">Confirmar</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

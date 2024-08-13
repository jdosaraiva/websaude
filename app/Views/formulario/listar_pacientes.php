<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .btn-view {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 12px;
        transition-duration: 0.4s;
    }

    .btn-view:hover {
        background-color: white;
        color: #007bff;
        border: 2px solid #007bff;
    }
</style>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Lista de Pacientes</span>
        <a href="<?= site_url('formulario/informacoes_pessoais') ?>" class="btn btn-success">Novo Paciente</a>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>Idade</th>
                    <th>Sexo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pacientes as $paciente): ?>
                    <tr>
                        <td><?= $paciente['nome'] ?></td>
                        <td><?= (new DateTime($paciente['data_nascimento']))->format('d/m/Y') ?></td>
                        <td><?= (new DateTime())->diff(new DateTime($paciente['data_nascimento']))->y ?></td>
                        <td><?= $paciente['sexo'] ?></td>
                        <td>
                            <a href="<?= site_url('formulario/informacoes_pessoais/' . $paciente['id']) ?>" class="btn btn-primary">Ver Informações</a>
                        </td>
                        <td>
                            <a href="<?= site_url('gemini/view/' . $paciente['id']) ?>" class="btn btn-view">Ver Avaliação</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>

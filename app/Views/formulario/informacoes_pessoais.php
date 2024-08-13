<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        Informações Pessoais
    </div>
    <div class="card-body">
        <form action="<?= site_url('formulario/salvarInformacoesPessoais') ?>" method="post">
            <input type="hidden" name="id" value="<?= isset($paciente['id']) ? $paciente['id'] : '' ?>">
            <div class="form-group">
                <label for="nome">Nome Completo:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= isset($paciente['nome']) ? $paciente['nome'] : '' ?>" readonly>
            </div>
            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?= isset($paciente['data_nascimento']) ? $paciente['data_nascimento'] : '' ?>" required>
            </div>
            <div class="form-group">
                <label for="idade">Idade:</label>
                <input type="text" class="form-control" id="idade" name="idade" value="<?= isset($paciente['data_nascimento']) ? (new DateTime())->diff(new DateTime($paciente['data_nascimento']))->y : '' ?>" readonly>
            </div>
            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <select class="form-control" id="sexo" name="sexo" required>
                    <option value="">Selecione</option>
                    <option value="Masculino" <?= isset($paciente['sexo']) && $paciente['sexo'] == 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                    <option value="Feminino" <?= isset($paciente['sexo']) && $paciente['sexo'] == 'Feminino' ? 'selected' : '' ?>>Feminino</option>
                    <option value="Nao Informado" <?= isset($paciente['sexo']) && $paciente['sexo'] == 'Nao Informado' ? 'selected' : '' ?>>Não Informado</option>
                </select>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">Próximo</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('data_nascimento').addEventListener('change', function() {
        var dataNascimento = new Date(this.value);
        var hoje = new Date();
        var idade = hoje.getFullYear() - dataNascimento.getFullYear();
        var mes = hoje.getMonth() - dataNascimento.getMonth();
        if (mes < 0 || (mes === 0 && hoje.getDate() < dataNascimento.getDate())) {
            idade--;
        }
        document.getElementById('idade').value = idade;
    });
</script>
<?= $this->endSection() ?>

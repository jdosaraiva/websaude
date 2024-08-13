<?php

namespace App\Controllers;

use App\Models\PacienteModel;

class FormularioController extends BaseController
{
    public function index($id = null)
    {
        $model = new PacienteModel();
        $data = [];

        if ($id) {
            $data['paciente'] = $model->find($id);
        }

        return view('formulario/informacoes_pessoais', $data);
    }

    public function salvarInformacoesPessoais()
    {
        $model = new PacienteModel();
        $data = $this->request->getPost();

        if (empty($data['nome'])) {
            $data['nome'] = $this->gerarNomeUnico();
        }        

        if (isset($data['id']) && !empty($data['id'])) {
            $model->save($data);
            $id = $data['id'];
        } else {
            $model->save($data);
            $id = $model->insertID();
        }

        return redirect()->to(site_url('formulario/historico_medico/' . $id));
    }

    private function gerarNomeUnico()
    {
        return 'Paciente_' . uniqid();
    }    

    public function historicoMedico($id)
    {
        $model = new PacienteModel();
        $data['paciente'] = $model->find($id);

        return view('formulario/historico_medico', $data);
    }

    public function salvarHistoricoMedico($id)
    {
        $model = new PacienteModel();
        $data = $this->request->getPost();
        $data['id'] = $id;
        $model->save($data);

        if ($this->request->getPost('action') === 'voltar') {
            return redirect()->to(site_url('formulario/informacoes_pessoais/' . $id));
        }

        return redirect()->to(site_url('formulario/sintomas_atuais/' . $id));
    }

    public function sintomasAtuais($id)
    {
        $model = new PacienteModel();
        $data['paciente'] = $model->find($id);

        return view('formulario/sintomas_atuais', $data);
    }

    public function salvarSintomasAtuais($id)
    {
        $model = new PacienteModel();
        $data = $this->request->getPost();
        $data['id'] = $id;
        $model->save($data);

        if ($this->request->getPost('action') === 'voltar') {
            return redirect()->to(site_url('formulario/historico_medico/' . $id));
        }

        return redirect()->to(site_url('formulario/exames_diagnosticos/' . $id));
    }


    public function examesDiagnosticos($id)
    {
        $model = new PacienteModel();
        $data['paciente'] = $model->find($id);

        return view('formulario/exames_diagnosticos', $data);
    }

    public function salvarExamesDiagnosticos($id)
    {
        $model = new PacienteModel();
        $data = $this->request->getPost();
        $data['id'] = $id;
        $model->save($data);

        if ($this->request->getPost('action') === 'voltar') {
            return redirect()->to(site_url('formulario/sintomas_atuais/' . $id));
        }

        return redirect()->to(site_url('formulario/estilo_vida/' . $id));
    }

    public function estiloVida($id)
    {
        $model = new PacienteModel();
        $data['paciente'] = $model->find($id);

        return view('formulario/estilo_vida', $data);
    }

    public function salvarEstiloVida($id)
    {
        $model = new PacienteModel();
        $data = $this->request->getPost();
        $data['id'] = $id;
        $model->save($data);

        if ($this->request->getPost('action') === 'voltar') {
            return redirect()->to(site_url('formulario/exames_diagnosticos/' . $id));
        }

        return redirect()->to(site_url('formulario/notas_plano_tratamento/' . $id));
    }

    public function notasPlanoTratamento($id)
    {
        $model = new PacienteModel();
        $data['paciente'] = $model->find($id);

        return view('formulario/notas_plano_tratamento', $data);
    }

    public function salvarNotasPlanoTratamento($id)
    {
        $model = new PacienteModel();
        $data = $this->request->getPost();
        $data['id'] = $id;
        $model->save($data);

        if ($this->request->getPost('action') === 'voltar') {
            return redirect()->to(site_url('formulario/estilo_vida/' . $id));
        }

        // Redirecionar para a próxima etapa ou página final
        return redirect()->to(site_url('formulario/confirmacao/' . $id));
    }

    public function confirmacao($id)
    {
        $model = new PacienteModel();
        $data['paciente'] = $model->find($id);

        return view('formulario/confirmacao', $data);
    }

    public function finalizar($id)
    {
        // Aqui você pode adicionar lógica para finalizar o processo, como enviar um e-mail de confirmação, gerar um relatório, etc.
        return redirect()->to(site_url('formulario/sucesso'));
    }

    public function sucesso()
    {
        return view('formulario/sucesso');
    }

    public function listarPacientes()
    {
        $model = new PacienteModel();
        $data['pacientes'] = $model->orderBy('id', 'DESC')->findAll();

        return view('formulario/listar_pacientes', $data);
    }
}

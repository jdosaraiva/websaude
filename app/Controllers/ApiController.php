<?php

namespace App\Controllers;

use App\Models\PacienteModel;
use App\Utils\ApiCallerUtil;

class ApiController extends BaseController
{

    protected $pacienteModel;
    protected $apiCallerUtil;    

    public function __construct()
    {
        $this->pacienteModel = new PacienteModel(); // Instancia o model

        // Instancia a classe utilitária
        $this->apiCallerUtil = new ApiCallerUtil();
    }

    public function callMaritaca($pacienteId)
    {
        // Dados a serem enviados para a API
        // $dadosPaciente = $this->pacienteModel->getPacienteJSON($pacienteId);
        $dadosPaciente = $this->pacienteModel->getPacienteTexto($pacienteId);

        // $this->logger->debug("DADOS: " . json_encode($dadosPaciente, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        $this->logger->debug("DADOS: " . $dadosPaciente);

        // Chama o método callMaritacaApi
        $response = $this->apiCallerUtil->callMaritacaApi($dadosPaciente);

        // Retorna a resposta como JSON
        return $this->response->setJSON($response);
    }

    public function viewEvaluation($pacienteId)
    {
        $patientData = $this->pacienteModel->getPacienteTexto($pacienteId);
        $data = $this->apiCallerUtil->callMaritacaApi($patientData);
        return view('maritaca/evaluation_view', ['data' => $data]);
    }    


}

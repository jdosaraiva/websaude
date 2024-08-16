<?php

namespace App\Controllers;

use App\Models\PacienteModel;
use App\Utils\ApiCallerUtil;

class ApiController extends BaseController
{

    protected $pacienteModel;

    public function __construct()
    {
        $this->pacienteModel = new PacienteModel(); // Instancia o model
    }

    public function callMaritaca($pacienteId)
    {
        // Instancia a classe utilitária
        $chatGPTUtil = new ApiCallerUtil();

        // Dados a serem enviados para a API
        // $dadosPaciente = $this->pacienteModel->getPacienteJSON($pacienteId);
        $dadosPaciente = $this->pacienteModel->getPacienteTexto($pacienteId);

        // $this->logger->debug("DADOS: " . json_encode($dadosPaciente, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        $this->logger->debug("DADOS: " . $dadosPaciente);

        // Chama o método callMaritacaApi
        $response = $chatGPTUtil->callMaritacaApi($dadosPaciente);

        // Retorna a resposta como JSON
        return $this->response->setJSON($response);
    }
}

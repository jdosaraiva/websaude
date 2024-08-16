<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PacienteModel;
use App\Utils\ApiCallerUtil;

class GeminiController extends ResourceController
{
    protected $pacienteModel;
    protected $apiCallerUtil;

    public function __construct()
    {
        $this->pacienteModel = new PacienteModel(); // Instancia o model
        $this->apiCallerUtil = new ApiCallerUtil(); 
    }

    public function viewEvaluation($pacienteId)
    {
        $patientData = $this->pacienteModel->getPacienteData($pacienteId);
        $data = $this->apiCallerUtil->callGeminiApi($patientData);
        return view('gemini/evaluation_view', ['data' => $data]);
    }    

    public function generateText($pacienteId)
    {
        $patientData = $this->pacienteModel->getPacienteData($pacienteId);
        $data = $this->apiCallerUtil->callGeminiApi($patientData);
    }

}

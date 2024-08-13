<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PacienteModel;

class GeminiController extends ResourceController
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = getenv('GEMINI_API_KEY'); // Carregar a chave de API de uma variável de ambiente
    }

    public function viewEvaluation($pacienteId)
    {
        $data = $this->gerarTexto($pacienteId);
        return view('gemini/evaluation_view', ['data' => $data]);
    }    

    public function generateText($pacienteId)
    {
        $data = $this->gerarTexto($pacienteId);
    }

    public function gerarTexto($pacienteId)
    {
        // Nome da classe e método para log
        $className = get_class($this) . '#generateText(' . $pacienteId . ')';
        $this->logger->debug($className);

        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $this->apiKey;
        $this->logger->info("PUT $url");

        $dadosPaciente = $this->getPacienteJSON($pacienteId);
        $prompt = "Avalie as informações do paciente abaixo e forneça uma avaliação médica completa, 
                incluindo possíveis diagnósticos, tratamentos e exames complementares:\n\n" 
                . json_encode($dadosPaciente, JSON_PRETTY_PRINT);

        $contents = [
            "contents" => [
                "parts" => [
                    "text" => $prompt,
                ]
            ]
        ];

        $curlOptPostFields = json_encode($contents);
        $this->logger->info($curlOptPostFields);

        $data = [];

        try {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $curlOptPostFields,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                $error_msg = curl_error($curl);

                $data = [
                    'status' => 'ERROR',
                    'message' => $error_msg,
                ];
            } else {
                $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                $this->logger->info("HTTP STATUS: $http_status");

                if ($http_status == 200) {
                    $retorno = json_decode($response, true);
                    $logMessage = "Response[" . json_encode($retorno, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "]";
                    $this->logger->info($logMessage);

                    $text = $retorno['candidates'][0]['content']['parts'][0]['text'];

                    $usageMetadata = $retorno['usageMetadata'];
                    $logMessage = "$className - USAGE METADATA[" . json_encode($usageMetadata, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "]";
                    $this->logger->debug($logMessage);

                    $data = [
                        'status' => 'OK',
                        'message' => $text,
                    ];
                } else {
                    $data = [
                        'status' => 'ERROR',
                        'message' => "NÃO FOI POSSÍVEL GERAR A AVALIAÇÃO PARA O PACIENTE (" . $pacienteId . ")",
                    ];
                }
            }

            curl_close($curl);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            // log_message('error', "Backtrace:\n" . print_r(debug_backtrace(), true));
        }

        // Log da resposta decodificada
        $logMessage = "$className - RESPOSTA DECODIFICADA[" . json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "]";
        $this->logger->debug($logMessage);

        // Retorna os dados de resposta
        return $data;
    }

    public function getPacienteJSON($id)
    {
        $pacienteModel = new PacienteModel();
        $paciente = $pacienteModel->find($id);

        if (!$paciente) {
            throw new \Exception('Paciente não encontrado');
        }

        $dadosPaciente = [
            'nome' => $paciente['nome'],
            'data_nascimento' => $paciente['data_nascimento'],
            'sexo' => $paciente['sexo'],
            'historico_medico' => [
                'condicoes' => $paciente['condicoes'],
                'alergias' => $paciente['alergias'],
                'medicacoes' => $paciente['medicacoes'],
                'cirurgias' => $paciente['cirurgias'],
                'historico_familiar' => $paciente['historico_familiar']
            ],
            'sintomas_atuais' => [
                'sintomas' => $paciente['sintomas'],
                'duracao_sintomas' => $paciente['duracao_sintomas'],
                'intensidade_sintomas' => $paciente['intensidade_sintomas'],
                'fatores' => $paciente['fatores']
            ],
            'exames_diagnosticos' => [
                'exames' => $paciente['exames'],
                'resultados' => $paciente['resultados'],
                'diagnosticos' => $paciente['diagnosticos']
            ],
            'estilo_vida' => [
                'habitos_alimentares' => $paciente['habitos_alimentares'],
                'atividade_fisica' => $paciente['atividade_fisica'],
                'alcool' => $paciente['alcool'],
                'tabaco' => $paciente['tabaco']
            ],
            'notas_plano_tratamento' => [
                'notas' => $paciente['notas'],
                'plano_tratamento' => $paciente['plano_tratamento'],
                'proximas_consultas' => $paciente['proximas_consultas'],
                'consentimento' => $paciente['consentimento']
            ]
        ];

        return $dadosPaciente;
    }

}

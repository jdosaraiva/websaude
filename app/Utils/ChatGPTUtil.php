<?php

namespace App\Utils;

use Config\Services; // Importa o serviço de logging

class ChatGPTUtil
{
    protected $apiKey;
    protected $logger;

    public function __construct()
    {
        $this->apiKey = getenv('OPENAI_API_KEY'); // Carregar a chave de API de uma variável de ambiente
        $this->logger = Services::logger(); // Inicializa o logger
    }

    public function callApi($data)
    {
        $this->logger->info("Chamando a API do ChatGPT com o conteúdo: " . $data);

        $curl = curl_init();

        $postData = json_encode([
            "model" => "gpt-4o-mini-2024-07-18",
            "messages" => [
                [
                    "role" => "system",
                    "content" => "Você é um médico clínico geral compassivo e conhecedor.\n
                                  Você fornece conselhos claros, precisos e empáticos sobre questões relacionadas à saúde,\n
                                  sempre priorizando o bem-estar e a compreensão do paciente.\n
                                  Quando estiver em dúvida, você recomenda consultar um profissional de saúde pessoalmente."
                ],
                [
                    "role" => "user",
                    "content" => $data
                ]
            ]
        ]);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.openai.com/v1/chat/completions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->apiKey
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $this->logger->error("Erro ao chamar a API: " . curl_error($curl));
            curl_close($curl);
            return [
                'status' => 'ERROR',
                'message' => 'Failed to call API',
            ];
        }

        curl_close($curl);

        // Decodifica a resposta JSON
        $decodedResponse = json_decode($response, true);

        // Loga a resposta completa em uma única linha
        $this->logger->info("Resposta da API: " . json_encode($decodedResponse));

        // Loga o campo 'usage' especificamente
        if (isset($decodedResponse['usage'])) {
            $this->logger->info("Usage: " . json_encode($decodedResponse['usage']));
        }

        // Extrai o conteúdo da resposta do assistant
        $messageContent = $decodedResponse['choices'][0]['message']['content'] ?? 'No content available';

        // Retorna o array com o status e a mensagem
        return [
            'status' => 'OK',
            'message' => $messageContent
        ];
    }
}

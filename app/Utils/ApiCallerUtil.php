<?php

namespace App\Utils;

use Config\Services; // Importa o serviço de logging
use InvalidArgumentException;

class ApiCallerUtil
{
  protected $chatGPTApiKey;
  protected $geminiApiKey; // GEMINI_API_KEY
  protected $maritalkApiKey; // MARITALK_API_KEY
  protected $logger;

  public function __construct()
  {
    $this->chatGPTApiKey = getenv('OPENAI_API_KEY'); // Carregar a chave de API de uma variável de ambiente
    $this->geminiApiKey = getenv('GEMINI_API_KEY'); // Carregar a chave de API de uma variável de ambiente
    $this->maritalkApiKey = getenv('MARITALK_API_KEY'); // Carregar a chave de API de uma variável de ambiente

    $this->logger = Services::logger(); // Inicializa o logger
  }

  public function callGeminiApi($dadosPaciente)
  {
      // Nome da classe e método para log
      $className = get_class($this) . '#callGeminiApi';
      $this->logger->debug($className);

      $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $this->geminiApiKey;
      $this->logger->info("PUT $url");

      $roleSystem = $this->getRoleSystem();

      $prompt = $roleSystem['content'] .  $this->getPrePrompt() . json_encode($dadosPaciente, JSON_PRETTY_PRINT);

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
                      'message' => "NÃO FOI POSSÍVEL GERAR A AVALIAÇÃO PARA O PACIENTE (" . $dadosPaciente['nome'] . ")",
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


  public function callChatGPTApi($data)
  {
    $this->logger->info("Chamando a API do ChatGPT com o conteúdo: " . $data);

    $curl = curl_init();

    $postData = json_encode([
      "model" => "gpt-4o-mini-2024-07-18",
      "messages" => [
        $this->getRoleSystem(),
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
        'Authorization: Bearer ' . $this->chatGPTApiKey
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

  /**
   * Chama a API da Maritaca com os dados fornecidos.
   *
   * @param mixed $data Conteúdo a ser enviado para a API (array ou string).
   * @return array Resposta da API com status e mensagem.
   * @throws InvalidArgumentException Se os dados fornecidos forem inválidos.
   */
  public function callMaritacaApi($data)
  {
      // Validação de dados de entrada
      if ((!is_array($data) && !is_string($data)) || empty($data)) {
          throw new InvalidArgumentException("Dados inválidos fornecidos.");
      }

      $this->logger->info("Chamando a API da Maritaca.");

      // Se $data for um array, converte para string JSON
      if (is_array($data)) {
          $data = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
      }

      $roleSystem = $this->getRoleSystem();
      $content = $roleSystem['content'] . "\n Identifique o paciente na avaliação e antes de demonstrar sua avaliação completa mostre os dados recebidos\n\n";
      $roleSystem['content'] = $content;

      $postData = [
          "model" => "sabia-3",
          "do_sample" => true,
          "max_tokens" => 3000,
          "temperature" => 0.4,
          "top_p" => 0.95,
          "messages" => [
              $roleSystem,
              [
                  "role" => "user",
                  "content" => $this->getPrePrompt() . $data
              ]
          ]
      ];

      $this->logger->debug("DADOS: " . json_encode($postData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

      $curl = curl_init();

      curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://chat.maritaca.ai/api/chat/inference',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 60, // Timeout ajustado
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => json_encode($postData),
          CURLOPT_HTTPHEADER => array(
              'Authorization: Key ' . $this->maritalkApiKey,
              'Content-Type: application/json'
          ),
      ));

      $response = curl_exec($curl);
      $httpStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

      if (curl_errno($curl)) {
          $error_msg = curl_error($curl);
          $this->logger->error("Erro na chamada da API da Maritaca: " . $error_msg);
          curl_close($curl);
          return [
              "status" => "ERROR",
              "message" => "Erro na chamada da API: " . $error_msg
          ];
      }

      curl_close($curl);

      $decodedResponse = json_decode($response, true);

      if (json_last_error() !== JSON_ERROR_NONE) {
          $this->logger->error("Erro ao decodificar a resposta JSON: " . json_last_error_msg());
          return [
              "status" => "ERROR",
              "message" => "Erro ao decodificar a resposta JSON: " . json_last_error_msg()
          ];
      }

      $this->logger->info("Status code da resposta: " . $httpStatusCode);

      if ($httpStatusCode === 200) {
          $this->logger->info("Uso da API: " . json_encode($decodedResponse['usage']));
          return [
              "status" => "OK",
              "message" => $decodedResponse['answer']
          ];
      } elseif ($httpStatusCode === 422) {
          $this->logger->error("Erro 422: " . json_encode($decodedResponse['detail']));
          return [
              "status" => "ERROR",
              "message" => "Erro 422: " . json_encode($decodedResponse['detail'])
          ];
      } else {
          return [
              "status" => "ERROR",
              "message" => "Erro na chamada da API"
          ];
      }
  }
  
  public function getRoleSystem()
  {
    return [
      "role" => "system",
      "content" => "Você é um médico clínico geral compassivo e conhecedor.\n
                    Você fornece conselhos claros, precisos e empáticos sobre questões relacionadas à saúde,\n
                    sempre priorizando o bem-estar e a compreensão do paciente.\n
                    Quando estiver em dúvida, você recomenda consultar um profissional de saúde pessoalmente. \n\n"
    ];
  }

  public function getPrePrompt() {
    return "Avalie as informações do paciente abaixo e forneça uma avaliação médica completa, 
                  incluindo possíveis diagnósticos, tratamentos e exames complementares:\n\n";
  }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class PacienteModel extends Model
{
    protected $table = 'pacientes';
    protected $allowedFields = [
        'nome', 
        'data_nascimento', 
        'condicoes', 
        'alergias', 
        'medicacoes', 
        'cirurgias', 
        'historico_familiar', 
        'sintomas', 
        'duracao_sintomas', 
        'intensidade_sintomas', 
        'fatores', 
        'exames', 
        'resultados', 
        'diagnosticos', 
        'habitos_alimentares', 
        'atividade_fisica', 
        'alcool', 
        'tabaco', 
        'notas', 
        'plano_tratamento', 
        'proximas_consultas', 
        'consentimento',
        'sexo'
    ];

    public function getPacienteData($id)
    {
        $paciente = $this->find($id);

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

    public function getPacienteTexto($id)
    {
        $paciente = $this->find($id);
    
        if (!$paciente) {
            throw new \Exception('Paciente não encontrado');
        }
    
        $dadosPaciente = "Dados do Paciente\n";
        $dadosPaciente .= "Nome: " . $paciente['nome'] . "\n";
        $dadosPaciente .= "Data de Nascimento: " . $paciente['data_nascimento'] . "\n";
        $dadosPaciente .= "Sexo: " . $paciente['sexo'] . "\n\n";
    
        $dadosPaciente .= "Histórico Médico:\n";
        $dadosPaciente .= "  Condições: " . $paciente['condicoes'] . "\n";
        $dadosPaciente .= "  Alergias: " . $paciente['alergias'] . "\n";
        $dadosPaciente .= "  Medicações: " . $paciente['medicacoes'] . "\n";
        $dadosPaciente .= "  Cirurgias: " . $paciente['cirurgias'] . "\n";
        $dadosPaciente .= "  Histórico Familiar: " . $paciente['historico_familiar'] . "\n\n";
    
        $dadosPaciente .= "Sintomas Atuais:\n";
        $dadosPaciente .= "  Sintomas: " . $paciente['sintomas'] . "\n";
        $dadosPaciente .= "  Duração dos Sintomas: " . $paciente['duracao_sintomas'] . "\n";
        $dadosPaciente .= "  Intensidade dos Sintomas: " . $paciente['intensidade_sintomas'] . "\n";
        $dadosPaciente .= "  Fatores: " . $paciente['fatores'] . "\n\n";
    
        $dadosPaciente .= "Exames Diagnósticos:\n";
        $dadosPaciente .= "  Exames: " . $paciente['exames'] . "\n";
        $dadosPaciente .= "  Resultados: " . $paciente['resultados'] . "\n";
        $dadosPaciente .= "  Diagnósticos: " . $paciente['diagnosticos'] . "\n\n";
    
        $dadosPaciente .= "Estilo de Vida:\n";
        $dadosPaciente .= "  Hábitos Alimentares: " . $paciente['habitos_alimentares'] . "\n";
        $dadosPaciente .= "  Atividade Física: " . $paciente['atividade_fisica'] . "\n";
        $dadosPaciente .= "  Consumo de Álcool: " . $paciente['alcool'] . "\n";
        $dadosPaciente .= "  Tabagismo: " . $paciente['tabaco'] . "\n\n";
    
        $dadosPaciente .= "Notas e Plano de Tratamento:\n";
        $dadosPaciente .= "  Notas: " . $paciente['notas'] . "\n";
        $dadosPaciente .= "  Plano de Tratamento: " . $paciente['plano_tratamento'] . "\n";
        $dadosPaciente .= "  Próximas Consultas: " . $paciente['proximas_consultas'] . "\n";
        $dadosPaciente .= "  Consentimento: " . $paciente['consentimento'] . "\n";
    
        return $dadosPaciente;
    }
    
}

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
		'alergias'		, 
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
}

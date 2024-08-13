<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePacientesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nome' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'data_nascimento' => [
                'type' => 'DATE',
            ],
            'condicoes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'alergias' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'medicacoes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'cirurgias' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'historico_familiar' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'sintomas' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'duracao_sintomas' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'intensidade_sintomas' => [
                'type' => 'INT',
                'null' => true,
            ],
            'fatores' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'exames' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'resultados' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'diagnosticos' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'habitos_alimentares' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'atividade_fisica' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'alcool' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tabaco' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'notas' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'plano_tratamento' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'proximas_consultas' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'consentimento' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pacientes');
    }

    public function down()
    {
        $this->forge->dropTable('pacientes');
    }
}

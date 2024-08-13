<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSexoToPacientes extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pacientes', [
            'sexo' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true, // Permitir valores nulos, ajuste conforme necessário
                'after' => 'data_nascimento' // Adiciona a coluna após 'data_nascimento'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pacientes', 'sexo');
    }
}

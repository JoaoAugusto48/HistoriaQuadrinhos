<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert(
            array (
                [
                    'id' => '1',
                    'descricao' => 'Acre',
                    'uf' => 'AC',
                ],
                [
                    'id' => '2',
                    'descricao' => 'Alagoas',
                    'uf' => 'AL',
                ],
                [
                    'id' => '3',
                    'descricao' => 'Amazonas',
                    'uf' => 'AM',
                ],
                [
                    'id' => '4',
                    'descricao' => 'Amapá',
                    'uf' => 'AP',
                ],
                [
                    'id' => '5',
                    'descricao' => 'Bahia',
                    'uf' => 'BA',
                ],
                [
                    'id' => '6',
                    'descricao' => 'Ceará',
                    'uf' => 'CE',
                ],
                [
                    'id' => '7',
                    'descricao' => 'Distrito Federal',
                    'uf' => 'DF',
                ],
                [
                    'id' => '8',
                    'descricao' => 'Espírito Santo',
                    'uf' => 'ES',
                ],
                [
                    'id' => '9',
                    'descricao' => 'Goiás',
                    'uf' => 'GO',
                ],
                [
                    'id' => '10',
                    'descricao' => 'Maranhão',
                    'uf' => 'MA',
                ],
                [
                    'id' => '11',
                    'descricao' => 'Minas Gerais',
                    'uf' => 'MG',
                ],
                [
                    'id' => '12',
                    'descricao' => 'Mato Grosso do Sul',
                    'uf' => 'MS',
                ],
                [
                    'id' => '13',
                    'descricao' => 'Mato Grosso',
                    'uf' => 'MT',
                ],
                [
                    'id' => '14',
                    'descricao' => 'Pará',
                    'uf' => 'PA',
                ],
                [
                    'id' => '15',
                    'descricao' => 'Paraiba',
                    'uf' => 'PB',
                ],
                [
                    'id' => '16',
                    'descricao' => 'Pernambuco',
                    'uf' => 'PE',
                ],
                [
                    'id' => '17',
                    'descricao' => 'Piauí',
                    'uf' => 'PI',
                ],
                [
                    'id' => '18',
                    'descricao' => 'Paraná',
                    'uf' => 'PR',
                ],
                [
                    'id' => '19',
                    'descricao' => 'Rio de Janeiro',
                    'uf' => 'RJ',
                ],
                [
                    'id' => '20',
                    'descricao' => 'Rio Grande do Norte',
                    'uf' => 'RN',
                ],
                [
                    'id' => '21',
                    'descricao' => 'Rondônia',
                    'uf' => 'RO',
                ],
                [
                    'id' => '22',
                    'descricao' => 'Roraima',
                    'uf' => 'RR',
                ],
                [
                    'id' => '23',
                    'descricao' => 'Rio Grande do Sul',
                    'uf' => 'RS',
                ],
                [
                    'id' => '24',
                    'descricao' => 'Santa Catarina',
                    'uf' => 'SC',
                ],
                [
                    'id' => '25',
                    'descricao' => 'Sergipe',
                    'uf' => 'SE',
                ],
                [
                    'id' => '26',
                    'descricao' => 'São Paulo',
                    'uf' => 'SP',
                ],
                [
                    'id' => '27',
                    'descricao' => 'Tocantins',
                    'uf' => 'TO',
                ],
            )
        );
    }
}

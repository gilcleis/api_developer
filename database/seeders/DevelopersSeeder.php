<?php
namespace Database\Seeders;

use App\Models\Developer;
use Illuminate\Database\Seeder;

class DevelopersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        //\App\Models\Category::factory()->count(10)->create(); 
        $developers = [
            ['id' => 1, 'nome' => 'Joao Silva','sexo' => 'M','hobby' => 'Futebol','datanascimento' => '1990-01-01','created_at' => '2021-09-28 20:00:1'],
            ['id' => 2, 'nome' => 'Maria Joana','sexo' => 'F','hobby' => 'Dancar','datanascimento' => '1992-11-11','created_at' => '2021-09-28 20:01:00'],
            ['id' => 3, 'nome' => 'Ana Maria','sexo' => 'F','hobby' => 'Cinema','datanascimento' => '1988-03-07','created_at' => '2021-09-28 21:00:00'],
            ['id' => 4, 'nome' => 'Antonio Santos','sexo' => 'M','hobby' => 'Futebol','datanascimento' => '1992-11-01','created_at' => '2021-09-28 21:10:00'],
            ['id' => 5, 'nome' => 'Clark Kent','sexo' => 'M','hobby' => 'Correr','datanascimento' => '1979-10-01','created_at' => '2021-09-28 21:20:30'],        
        ];
        Developer::insert($developers);
    
    }
}

<?php

namespace Tests\Feature;

use App\Models\Developer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeveloperTest extends TestCase
{

    public function testListDevelopers()
    {
       $this->json('get', 'api/developers')->assertStatus(200);
       
    }

    public function testGetByIdDevelopersSuccess()
    {
        $response = $this->json('get', 'api/developers/1');
        $response->assertStatus(200);
    }

    public function testGetByIdDevelopersNotFound()
    {
        $response = $this->json('get', 'api/developers/100');
        $response->assertStatus(404);
    }

    public function testCreateDeveloperSuccess()
    {
        $data = [
            'nome' => "unit test_" . date('his'),
            'hobby' => "soccer",
            'sexo' => 'M',
            'datanascimento' => '2020-01-01'
        ];

        $this->json('POST', 'api/developers', $data, ['Accept' => 'application/json'])->assertStatus(201);
    }

    public function testCreateDeveloperFail()
    {
        $data = [
            'nome' => "unit test_" . date('his'),
            'hobby' => "soccer",
            'sexo' => 'M'
        ];

        $this->json('POST', 'api/developers', $data, ['Accept' => 'application/json'])->assertStatus(422);
    }


    public function testDeleteDeveloperSucess()
    {
        $developer = Developer::create([
            'nome' => "unit test_2_" . date('his'),
            'hobby' => "soccer",
            'sexo' => 'M',
            'datanascimento' => '2020-01-01'
        ]);


        $delete = $this->json('DELETE', 'api/developers/' . $developer->id);
        $delete->assertStatus(200);
    }

    public function testDeleteDeveloperfail()
    {
        $this->json('DELETE', 'api/developers/' . 1000)->assertStatus(400);
    }

    public function testUpdateDeveloperSucess()
    {
        $developer = Developer::create([
            'nome' => "unit test_3_" . date('his'),
            'hobby' => "soccer",
            'sexo' => 'M',
            'datanascimento' => '2020-01-01'
        ]);

        $updateDate = [
            'nome' => "unit upadate test_5_" . date('his'),
            'hobby' => "soccer",
            'sexo' => 'M',
            'datanascimento' => '2020-01-01'
        ];
        $this->json('PATCH', 'api/developers/' . $developer->id, $updateDate, ['Accept' => 'application/json'])->assertStatus(200);
    }
}

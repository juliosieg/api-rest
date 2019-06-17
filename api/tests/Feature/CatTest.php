<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * @test
     * Test example for no param.
     */
    public function noParamTest()
    {
        $response = $this->get('/');

        $response->assertStatus(404);
    }

    /**
     * @test
     * Test example for invalid query param.
     */
    public function queryParamInvalid()
    {
        $response = $this->get('/breeds?barbecue=true');

        $response->assertStatus(404);
    }

    /**
     * @test
     * Test example for search by id
     */
    public function searchById()
    {
        $response = $this->get('/breeds/sibe');

        $response->assertStatus(200);
    }

    /**
     * @test
     * Test example for search by invalid id
     */
    public function searchByInvalidId()
    {
        $response = $this->get('/breeds/t1');

        $response->assertStatus(404);
    }

}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WeatherLookUpControllerTest extends TestCase
{

    public function test_can_call_index_endpoint_without_error()
    {
        $response = $this->get('/api/');

        $response->assertStatus(200);
    }
}

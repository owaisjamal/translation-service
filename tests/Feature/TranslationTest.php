<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{

public function test_can_create_translation()
{
    $response = $this->postJson('/api/translations', [
        'locale' => 'en',
        'key' => 'welcome_message',
        'content' => 'Welcome!',
        'tags' => ['web']
    ]);

    $response->assertStatus(201);
}
}

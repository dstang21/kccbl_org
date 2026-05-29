<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A framework-level smoke test that does not depend on the legacy schema
     * being imported into the local test database.
     */
    public function test_the_health_endpoint_is_available(): void
    {
        $response = $this->get('/up');

        $response->assertStatus(200);
    }
}

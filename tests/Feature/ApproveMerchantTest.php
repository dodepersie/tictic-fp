<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApproveMerchantTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test approving a merchant with a null merchant object.
     *
     * @return void
     */
    public function testApproveMerchantWithNullMerchant()
    {
        // Simulate a null merchant object by not providing any merchant data
        $response = $this->post(route('approve_merchant'), []);

        // Assertions
        $response->assertRedirect();
        $response->assertSessionHas('error', 'Invalid merchant data provided.');
    }
}

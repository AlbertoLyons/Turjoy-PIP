<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class FailedLoginTest extends TestCase
{

    use DatabaseTransactions;
    use WithoutMiddleware;

    public function testFailedLogin(): void
    {
        $response = $this->post('/login', [
            'email' => 'italo.donoso@ucn.cl',
            'password' => 'Turjoy',
        ]);

        $response->assertStatus(302);
        $this->assertFalse(Auth::check());
    }
}


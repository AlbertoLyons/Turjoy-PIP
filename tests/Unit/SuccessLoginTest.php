<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class SuccessLoginTest extends TestCase
{

    use DatabaseTransactions;
    use WithoutMiddleware;

    public function testSuccessLogin(): void
    {

        $response = $this->post('/login',[
            'email' => 'italo.donoso@ucn.cl',
            'password' => 'Turjoy91'
        ]);

        $response->assertStatus(302);
        $response->assertSessionMissing('message');
    }
}

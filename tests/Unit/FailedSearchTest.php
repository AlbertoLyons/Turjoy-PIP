<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FailedSearchTest extends TestCase
{

    use DatabaseTransactions;

    public function testFailedSearch(): void
    {

        $response = $this->post('/search',[
            'code' => 'XXXX9'
        ]);

        $response->assertSessionHas(['msg2']);
    }
}

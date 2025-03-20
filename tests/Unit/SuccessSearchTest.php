<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

class SuccessSearchTest extends TestCase
{

    use DatabaseTransactions;

    public function testSuccessSearch(): void
    {

        DB::beginTransaction();
        $ticket = Ticket::create([
            'code'=>'1L1G39',
            'seat'=>'1',
            'total'=>'100',
            'date'=>'2021-10-10',
            'travel_id'=> 1
        ]);

        DB::commit();

        $response = $this->post('/search',[
            'code' => '1L1G39'
        ]);

        $response->assertSessionMissing('msg2');

        DB::rollback();
    }
}

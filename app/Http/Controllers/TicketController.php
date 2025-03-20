<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Travel;
use App\Http\Controllers\TravelController;
use Illuminate\Http\Request;

class TicketController extends Controller
{


    public function store(Request $request)
    {
        try{
            // Generar el numero de reserva
            $code = generateReservationNumber();

            //Obtener el total base-rate del request
            $baseRateTotal = $request->input('base-rate');
            // Modificar request
            $request->request->add(['code' => $code]);
            $travel = Travel::where('origin', $request->origins)->where('destination', $request->destinations)->first();

            $tickets = Ticket::where('travel_id', $travel->id)->where('date', $request->date)->sum('seat');
            $seatNow = $travel->seat_quantity - $tickets;

            if(!$travel || 0 > $request->seat || $request->seat > $seatNow){
                return redirect()->back()->with('error', 'Ha ocurrido un error al generar la reserva, intente nuevamente.');
            }


            $ticket = Ticket::create([
            'code' => $request->code,
            'seat' => $request->seat,
            'date' => $request->date,
            'total' => $request->base_rate * $request->seat ,
            'travel_id' => $travel->id,
            ]);

            return redirect()->route('generate.pdf', [
                'id' => $ticket->id,
            ]);

        }
        catch(\Exception $e){
            dd($e);
            return redirect()->back()->with('error', 'Ha ocurrido un error al generar la reserva, intente nuevamente.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Travel;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all()->sortBy('date');
        $i = 1;
        return view('reportReserve', [
            'tickets' => $tickets,
            'numero' => $i,
        ]);
    }
    private function makeMessages()
    {
        return [
            'date1.required' => 'La fecha de inicio es obligatoria.',
            'date1.date' => 'La fecha de inicio debe ser una fecha válida.',
            'date2.required' => 'La fecha de término es obligatoria.',
            'date2.date' => 'La fecha de término debe ser una fecha válida.',
        ];
    }

    public function searchToDate(Request $request)
    {
        $messages = $this->makeMessages();
        $this->validate($request, [
            'date1' => ['required','date'],
            'date2' => ['required','date'],
        ], $messages);


        $startDate = $request->date1;
        $endDate = $request->date2;

        if ($startDate > $endDate) {
            return back()->with('message', 'La fecha de inicio a consultar no puede ser mayor que la fecha de término de la consulta.');
        }

        $tickets = Ticket::whereBetween('date', [$startDate, $endDate])->get()->sortBy('date');

        if ($tickets->isEmpty()) {
            return back()->with('message', 'No se encontraron reservas dentro del rango seleccionado.');
        }
        $i = 1;
        return view('reportReserve', [
            'tickets' => $tickets,
            'numero' => $i,
        ]);
    }

}

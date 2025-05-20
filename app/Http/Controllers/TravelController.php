<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use App\Models\Travel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\TravelsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;


class TravelController extends Controller
{
    private function initializeSessionVariables()
    {
        session(['validRows' => []]);
        session(['invalidRows' => []]);
        session(['duplicatedRows' => []]);
    }

    public function indexAddTravels()
    {
        // Inicializar o reiniciar las variables de sesión
        $this->initializeSessionVariables();

        return view('index', [
            'validRows' => session('validRows'),
            'invalidRows' => session('invalidRows'),
            'duplicatedRows' => session('duplicatedRows')
        ]);
    }

    public function indexTravels()
    {
        return view('index', [
            'validRows' => session('validRows'),
            'invalidRows' => session('invalidRows'),
            'duplicatedRows' => session('duplicatedRows')
        ]);
    }

    public function travelCheck(Request $request)
    {
        $messages = makeMessages();

        $this->validate($request, ['document' => ['required', 'mimes:xlsx', 'max:5120']], $messages);

        if ($request->hasFile('document')) {
            $file = $request->file('document');

            $import = new TravelsImport();
            Excel::import($import, $file);

            $validRows = $import->getValidRows();
            $invalidRows = $import->getInvalidRows();
            $duplicatedRows = $import->getDuplicatedRows();

            // Usar transacción para optimizar operaciones de base de datos
            DB::beginTransaction();
            try {
                foreach ($validRows as $row) {
                    $origin = $row['origen'];
                    $destination = $row['destino'];

                    // Crear índice compuesto en la migración para esta consulta
                    $travel = Travel::where('origin', $origin)
                                    ->where('destination', $destination)
                                    ->lockForUpdate() // Evitar condiciones de carrera
                                    ->first();

                    if ($travel) {
                        $travel->update([
                            'seat_quantity' => $row['cantidad_de_asientos'],
                            'base_rate' => $row['tarifa_base']
                        ]);
                    } else {
                        Travel::create([
                            'origin' => $origin,
                            'destination' => $destination,
                            'seat_quantity' => $row['cantidad_de_asientos'],
                            'base_rate' => $row['tarifa_base']
                        ]);
                    }
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Error procesando datos: ' . $e->getMessage());
            }

            $invalidRows = array_filter($invalidRows, function ($invalidrow) {
                return $invalidrow['origen'] !== null || 
                       $invalidrow['destino'] !== null || 
                       $invalidrow['cantidad_de_asientos'] !== null || 
                       $invalidrow['tarifa_base'] !== null;
            });

            session()->put('validRows', $validRows);
            session()->put('invalidRows', $invalidRows);
            session()->put('duplicatedRows', $duplicatedRows);

            return redirect()->route('travelsAdd.index');
        }
    }

    public function obtainOrigins()
    {
        // Usar caché para consultas frecuentes
        $origins = cache()->remember('travel_origins', 60, function () {
            return Travel::distinct()->orderBy('origin', 'asc')->pluck('origin');
        });
        
        return response()->json([
            'origins' => $origins,
        ]);
    }

    public function obtainDestinations()
    {
        // Usar caché para consultas frecuentes
        $destinations = cache()->remember('travel_destinations', 60, function () {
            return Travel::distinct()->orderBy('destination', 'asc')->pluck('destination');
        });

        return response()->json([
            'destinations' => $destinations,
        ]);
    }

    public function searchDestinations($origin)
    {
        // Añadir índice a la columna origin en la migración
        $destinations = Travel::where('origin', $origin)
                              ->orderBy('destination', 'asc')
                              ->pluck('destination');

        return response()->json([
            'destination' => $destinations,
        ]);
    }

    public function seatings($origin, $destination, $date)
    {
        // Agregar índice compuesto (origin, destination) en la migración
        $travel = Travel::where('origin', $origin)
                        ->where('destination', $destination)
                        ->first();

        if ($travel) {
            // Mejorar rendimiento usando el id (clave primaria)
            $tickets = Ticket::where('travel_id', $travel->id)
                             ->where('date', $date)
                             ->sum('seat');

            $seatNow = $travel->seat_quantity - $tickets;

            return response()->json(['seat' => $seatNow, 'travel' => $travel]);
        }
        
        return response()->json(['error' => 'Viaje no encontrado'], 404);
    }

    public function checkTravel(Request $request)
    {
        dd($request);
    }

    public function homeIndex()
    {
        // Caching para optimizar conteos repetidos
        $travels = cache()->remember('travels_count', 60, function () {
            return Travel::count();
        });

        return view('reserveTickets', [
            'countTravels' => $travels,
        ]);
    }
}
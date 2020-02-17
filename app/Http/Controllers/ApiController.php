<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Airport;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ApiController extends Controller
{
    private $INCREMENT_FIRST_CLASS = 0.6;

    public function listFlights( Request $request )
    {
        $airports = Airport::orderBy('location')->get();
        $arWhere = [];
        $idDeparture = $request->departure_airport_id ?? 0;
        $idArrival = $request->arriva_airport_id ?? 0;

        if( $idDeparture )
            $arWhere[] = ['flights.departure_airport_id', '=', $idDeparture];
        
        if( $idArrival )
            $arWhere[] = ['flights.arrival_airport_id', '=', $idArrival];

        $objFlights = DB::table('flights')
                        ->join('airplanes', 'flights.airplane_id', '=', 'airplanes.id')
                        ->join('airlines', 'airplanes.airline_id', '=', 'airlines.id')
                        ->where( $arWhere )
                        ->where( 'flights.status', 'scheduled')
                        ->select('flights.*', 'airplanes.economy_class_seats', 
                        'airplanes.first_class_seats', 'airlines.name as aeropuerto')
                        ->orderBy('flights.base_price', 'DESC')
                        ->get();
        
        foreach ($objFlights as $i => $item) {
            // Obtengo la cantidad de asientos disponibles tanto para la clase enconomica como 
            // para la primera clase. Si tengo disponibilidad de asiento obtengo el precio y la
            // cantidad disponible para que el usuario lo puedo reservar. En todo caso siempre muestro
            // la opción con asientos disponibles.

            $objReservation = $this->obtenerReservasVuelo( $item->id );
            $item->disponibleEconomy = $item->economy_class_seats - $objReservation['economy'];
            $item->disponibleFirst = $item->first_class_seats - $objReservation['first'];
            
            // Si no tengo asientos disponibles en ninguna clase no muestro el vuelo.
            if($item->disponibleEconomy <= 0 && $item->disponibleFirst <= 0) {
                unset($objFlights[$i]);
            } else {
                $aDearture  = Airport::where('id', $item->departure_airport_id)->first();
                $item->depAirport_name      = $aDearture->name;
                $item->depAirport_location  = $aDearture->location;
                $item->depAirport_province  = $aDearture->province;
                $item->depAirport_iata_code = $aDearture->iata_code;

                $aArrival   = Airport::where('id', $item->arrival_airport_id)->first();
                $item->arriAirport_name         = $aArrival->name;
                $item->arriAirport_location     = $aArrival->location;
                $item->arriAirport_province     = $aArrival->province;
                $item->arriAirport_iata_code    = $aArrival->iata_code;
                
                $item->priceEconomy = number_format($item->base_price + 
                                            $item->base_price * 
                                            ( $objReservation['economy'] / $item->economy_class_seats ), 2, '.', '' );
                $item->priceFirst   =   number_format($item->priceEconomy + 
                                        $item->priceEconomy * $this->INCREMENT_FIRST_CLASS,2, '.', '');
            }
        }

        $isAllFlights = true;
        $titulo = 'Lista de vuelos disponibles';
        return view('flights', compact('objFlights', 'airports', 'idDeparture', 'idArrival', 'isAllFlights', 'titulo'));
    }

    public function search( Request $request )
    {
        $airports = Airport::orderBy('location')->get();
        $fecha = explode('/', $request->departure_date);
        //$aDearture = Airport::find($request->departure_airport_id)->first();
        //$aArrival = Airport::find($request->arriva_airport_id)->first();
                
        $objFlights = DB::table('flights')
                            ->join('airplanes', 'flights.airplane_id', '=', 'airplanes.id')
                            ->join('airlines', 'airplanes.airline_id', '=', 'airlines.id')
                            ->where('departure_airport_id', $request->departure_airport_id)
                            ->whereDate('departure_date', $fecha)
                            ->where('arrival_airport_id', $request->arriva_airport_id)
                            ->select('flights.*', 'airplanes.economy_class_seats', 
                            'airplanes.first_class_seats', 'airlines.name as aeropuerto')
                            ->orderBy('flights.base_price', 'DESC')
                            ->get();

        foreach ($objFlights as $i => $item) {
            // Obtengo la cantidad de asientos disponibles tanto para la clase enconomica como 
            // para la primera clase. Si tengo disponibilidad de asiento obtengo el precio y la
            // cantidad disponible para que el usuario lo puedo reservar. En todo caso siempre muestro
            // la opción con asientos disponibles.

            $objReservation = $this->obtenerReservasVuelo( $item->id );
            $item->disponibleEconomy = $item->economy_class_seats - $objReservation['economy'];
            $item->disponibleFirst = $item->first_class_seats - $objReservation['first'];

            if( $item->disponibleEconomy > 0 ) {
                $item->priceEconomy = number_format($item->base_price + 
                                         $item->base_price * 
                                         ( $objReservation['economy'] / $item->economy_class_seats ), 2, '.', '' );
                $item->priceFirst   =   number_format($item->priceEconomy + 
                                        $item->priceEconomy * $this->INCREMENT_FIRST_CLASS,2, '.', '');
            }
            
            $aDearture  = Airport::find($request->departure_airport_id)->first();
            $item->depAirport_name      = $aDearture->name;
            $item->depAirport_location  = $aDearture->location;
            $item->depAirport_province  = $aDearture->province;
            $item->depAirport_iata_code = $aDearture->iata_code;

            $aArrival   = Airport::find($request->arriva_airport_id)->first();
            $item->arriAirport_name         = $aArrival->name;
            $item->arriAirport_location     = $aArrival->location;
            $item->arriAirport_province     = $aArrival->province;
            $item->arriAirport_iata_code    = $aArrival->iata_code;
        }
        $titulo = 'Resultados de tu búsqueda';
        return view('flights', compact('objFlights', 'airports', 'titulo'));
    }

    // public function calcularPrecioEconomyVuelo( $idFlight, $basePrice, $seatsEconomy, $cantReservation )
    // {
    //     // Obtengo las reservas para el vuelvo en cuestión
        
    // }

    /**
     * Función que devuelve un array con la cantidad de asientos disponibles para las categorías
     * que ofrece el avión del vuelvo en cuestión
     */
    public function obtenerReservasVuelo( $idFlight ) 
    {
        $objReservation['economy'] = Reservation::where('idFlight', $idFlight)
                                                    ->where('class_seats', 'economy')
                                                    ->groupBy('idFlight')
                                                    ->count();
        $objReservation['first'] = Reservation::where('idFlight', $idFlight)
                                                ->where('class_seats', 'first')
                                                ->groupBy('idFlight')
                                                ->count();

        return $objReservation;
    }

    public function detailFlight( Request $request)
    {
        // Obtengo los datos del vuelo
        $idFlight = $request->idFlight;
        $radio = $request->{'class_seat_'.$idFlight};
        list($tipoClass, $basePrice ) = explode('_', $radio);
        
        // Obtengo la clase seleccionada y el importe. Debo verificar que el importe sea el mismo,
        // el importe puede cambiar ya que en el tiempo se pudieron realizar nuevas reservar, y esto
        // genera incrementos en el precio o que no hayan asientos disponibles para la clase seleccionada
        
        $flight = DB::table('flights')
                        ->join('airplanes', 'flights.airplane_id', '=', 'airplanes.id')
                        ->where('flights.id', $idFlight)
                        ->select('flights.*', 'airplanes.economy_class_seats', 'airplanes.first_class_seats')
                        ->first();
        
        $aDearture = Airport::find($flight->departure_airport_id)->first();
        $aArrival = Airport::find($flight->arrival_airport_id)->first();

        $precioVuelo   = 0;
        $precioEconomy  = 0;

        $objReservation = $this->obtenerReservasVuelo( $idFlight );
        $flight->disponibleEconomy = $flight->economy_class_seats - $objReservation['economy'];
        $flight->disponibleFirst = $flight->first_class_seats - $objReservation['first'];
        $precioEconomy = $flight->base_price + 
                                $flight->base_price * 
                                ( $objReservation['economy'] / $flight->economy_class_seats );
        
        if( $tipoClass == 'first' ) {
            $precioVuelo   =   $precioEconomy + 
                                $precioEconomy * $this->INCREMENT_FIRST_CLASS;
        } else 
            $precioVuelo = $precioEconomy;

        $flight->price = $precioVuelo;
        $flight->class = $tipoClass;

        return view('detailFlight', compact('idFlight', 'flight', 'aDearture', 'aArrival'));
    }

    public function verificarAsientosDisponibles( $idFlight, $class=null, $withReturn=false )
    {
        // Obtengo la cantidad de asientos que dispone el avión para el vuelo en cuestión
        $objFlight = DB::table('flights')
                    ->join('airplanes', 'flights.airplane_id', '=', 'airplanes.id')
                    ->where('flights.id', $idFlight)
                    ->select('flights.*', 'airplanes.economy_class_seats', 'airplanes.first_class_seats')
                    ->first();
        
        $objReservation = $this->obtenerReservasVuelo( $idFlight );
        $arDisponibilidad = (object) [];
        $arDisponibilidad->disponibleEconomy = $objFlight->economy_class_seats - $objReservation['economy'];
        $arDisponibilidad->disponibleFirst = $objFlight->first_class_seats - $objReservation['first'];

        if( $withReturn)
            return $class === null ? $arDisponibilidad:$arDisponibilidad->{'disponible'.ucfirst($class)};
        else {
            if($class === null) return  ($arDisponibilidad->disponibleEconomy +
                                        $arDisponibilidad->disponibleFirst) > 0?true: false;
            else  return  $arDisponibilidad->{'disponible'.ucfirst($class)} > 0?true: false;
        }
    }

    public function saveReservation( Request $request )
    {
        // Verifico que haya asientos disponibles para la clase seleccionada
        if( $this->verificarAsientosDisponibles($request->idFlight , $request->class) > 0 ) {
            $objReservation = new reservation();
            $objReservation->idFlight = $request->idFlight;        
            $objReservation->name = $request->name_user;
            $objReservation->surname = $request->surname_user;
            $objReservation->email = $request->email_user;
            $objReservation->price = $request->price;
            $objReservation->class_seats = $request->class;
            $objReservation->fechaReserva = now();
            $isSaveSuccess = $objReservation->save();
            $msgReservation = $isSaveSuccess;
        } else {
            $msgReservation = false;
        }

        return view('detailFlight', compact('msgReservation'));
    }

    public function reservation( )
    {       
        $objReservations = DB::table('reservation')
                                ->join('flights', 'flights.id', '=', 'reservation.idFlight')
                                ->join('airplanes', 'flights.airplane_id', '=', 'airplanes.id')
                                ->join('airlines', 'airplanes.airline_id', '=', 'airlines.id')
                                ->where('flights.departure_date', '>', now())
                                ->select('reservation.*', 'flights.departure_airport_id', 
                                'flights.departure_date', 'flights.arrival_airport_id', 
                                'flights.arrival_date', 'flights.status as statusFlight', 'airlines.name as aeropuerto')
                                ->orderBy('flights.departure_date', 'ASC')
                                ->get();

        foreach ($objReservations as $i => $item) {
            $aDearture  = Airport::find($item->departure_airport_id)->first();
            $item->depAirport_name      = $aDearture->name;
            $item->depAirport_location  = $aDearture->location;
            $item->depAirport_province  = $aDearture->province;
            $item->depAirport_iata_code = $aDearture->iata_code;

            $aArrival   = Airport::find($item->arrival_airport_id)->first();
            $item->arriAirport_name         = $aArrival->name;
            $item->arriAirport_location     = $aArrival->location;
            $item->arriAirport_province     = $aArrival->province;
            $item->arriAirport_iata_code    = $aArrival->iata_code;
        }

        return view('reservation', compact('objReservations'));
    }

    public function showCancellation ( $idReserva)
    {
        $objReservation = DB::table('reservation')
                                ->join('flights', 'flights.id', '=', 'reservation.idFlight')
                                ->join('airplanes', 'flights.airplane_id', '=', 'airplanes.id')
                                ->join('airlines', 'airplanes.airline_id', '=', 'airlines.id')
                                ->where('reservation.id', $idReserva)
                                ->select('reservation.*', 'flights.departure_airport_id', 
                                'flights.departure_date', 'flights.arrival_airport_id', 
                                'flights.arrival_date', 'flights.status as statusFlight', 'airlines.name as aeropuerto')
                                ->orderBy('flights.departure_date', 'ASC')
                                ->first();
        $montoDevolucion = 0;

        if( $objReservation ){
            $departureDate = $objReservation->departure_date;
            $precio = $objReservation->price;

            $to = Carbon::createFromFormat('Y-m-d H:i:s', $departureDate);
            $from = Carbon::now();
            $diffDays = $to->diffInDays($from);
            
            // Verifico si el vuelo ya fue realizado, en dicho caso muestro un mensaje de error
            if( Carbon::parse($to)->lt(Carbon::now() )){
                $msgError = 'La reserva no puede ser cancelada ya que el vuelo fue despachado.';
                return view('cancellation', compact('msgError'));
            }

            // Para reservar de clase economy se obtiene el importe a devolver en base a los días
            // de anticipación con la que se cancela dicha reserva y teniendo como base el importe abonado.
            // Las reservas de primera clase no tiene devolución
            if( $objReservation->class_seats == 'economy' ) {
                if( $diffDays >= 7) $montoDevolucion = $precio;
                if( $diffDays >= 3) $montoDevolucion = $precio*0.6;
                if( $diffDays >= 0) $montoDevolucion = $precio*0.4;
            }
        }

        $objReservation->montoDevolucion = $montoDevolucion;

        if ($objReservation) {
            $aDearture  = Airport::find($objReservation->departure_airport_id)->first();
            $objReservation->depAirport_name      = $aDearture->name;
            $objReservation->depAirport_location  = $aDearture->location;
            $objReservation->depAirport_province  = $aDearture->province;
            $objReservation->depAirport_iata_code = $aDearture->iata_code;

            $aArrival   = Airport::find($objReservation->arrival_airport_id)->first();
            $objReservation->arriAirport_name         = $aArrival->name;
            $objReservation->arriAirport_location     = $aArrival->location;
            $objReservation->arriAirport_province     = $aArrival->province;
            $objReservation->arriAirport_iata_code    = $aArrival->iata_code;
        }
        
        return view('cancellation', compact('objReservation'));
    }

    public function cancelReservation( Request $request)
    {
        $idReserva = $request->idReservation ?? 0;
        $error = 0;
        
        if( $idReserva) {
            $objReservation = Reservation::where('id', $idReserva)->delete();
        } else {
            $error = 'Se produjo un error al cancelar la reserva. Inténtelo nuevamente más tarde.';
        }

        return view('cancellation', compact('error'));
    }
}
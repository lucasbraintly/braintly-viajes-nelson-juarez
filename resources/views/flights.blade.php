@extends('layouts.master')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <h2> {{ $titulo }}</h2>
                <div class="mt-4">
                    @if( count($objFlights) > 0 )
                        @foreach($objFlights as $flight)
                        <form action="detailFlight" method="POST">
                            <input type="hidden" name="idFlight" value="{{ $flight->id }}">
                            @csrf
                            @method("POST")
                            <div class="card mb-3 bg-light">                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2"> {{ $flight->aeropuerto }} </div>
                                        <div class="col-6">
                                            <div class="boxSalida float-left px-4 text-right">
                                                <span class="bold d-block font-weight-bold"> SALIDA </span>
                                                <span class="bold d-block"> {{ date('d/m/Y H:i', strtotime($flight->departure_date)) }} </span>
                                                <span class="bold d-block"> {{ $flight->depAirport_iata_code }} </span>
                                                <span class="bold d-block"> {{ $flight->depAirport_province }} </span>
                                            </div>
                                            <div class="boxDuracion float-left tect-center" style=" width: 100px; text-align: center;">
                                                {{ date('H:i', mktime( 0,$flight->duration )) }}
                                                <hr style="background: red;">
                                            </div>
                                            <div class="boxLlegada float-left px-4">
                                                <span class="bold d-block font-weight-bold"> LLEGADA </span>
                                                <span class="bold d-block"> {{ date('d/m/Y H:i', strtotime($flight->arrival_date)) }} </span>
                                                <span class="bold d-block"> {{ $flight->arriAirport_iata_code }} </span>
                                                <span class="bold d-block"> {{ $flight->arriAirport_province }} </span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-block">
                                                @if( $flight->disponibleEconomy > 0)
                                                    <div>
                                                        <div> 
                                                            <input required type="radio" checked name="class_seat_{{ $flight->id }}" 
                                                                value="economy_{{ $flight->priceEconomy }}"
                                                            > 
                                                        </div>
                                                        <div class="pl-4 pm-4">
                                                            <span class="d-block">$ {{ $flight->priceEconomy }} </span>
                                                            <span class="d-block">Economy ( Disponibles: {{ $flight->disponibleEconomy }} )</span>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if( $flight->disponibleFirst > 0)
                                                    <div>
                                                        <div>
                                                            <input required type="radio" name="class_seat_{{ $flight->id }}" 
                                                                value="first_{{ $flight->priceFirst }}"
                                                            > 
                                                        </div>
                                                        <div>
                                                            <span class="d-block">Primera clase </span>                                           
                                                            <span class="d-block">$ {{ $flight->priceFirst }} </span>
                                                            <span class="d-block">( Disponibles: {{ $flight->disponibleFirst }} )</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="d-block mt-4">
                                                <button type="submit" class="btn btn-success"> Reservar </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                        @endforeach
                    @else
                        <div class="alert alert-danger" role="alert">
                            No existe vuelos para los datos ingresados.
                        </div>
                    @endif


                </div>
        </div>
    </div>
@endsection
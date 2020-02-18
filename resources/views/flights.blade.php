@extends('layouts.master')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12 my-4">
                <h2> {{ $titulo }}</h2>
                <div class="mt-4">
                    @if( count($objFlights) > 0 )
                        @foreach($objFlights as $flight)
                        <form action="detailFlight" method="POST">
                            <input type="hidden" name="idFlight" value="{{ $flight->id }}">
                            @csrf
                            @method("POST")
                            <div class="mb-3 itemFlight">                                
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="h-100 col-12 col-md-8 col-lg-9" style="overflow:hidden">
                                            <div style="border-bottom: solid 1px #ccc;padding-bottom: 0.5rem; font-weight: bold;">
                                                {{ $flight->departure_date_format }}
                                            </div>
                                            <div class="row d-flex flex-row justify-content-around align-items-md-stretch align-items-lg-center h-100">
                                                <div class="pt-2 pt-lg-0 col-12 col-md-12 col-lg-3" > {{ $flight->aeropuerto }} </div>
                                                <div class="py-4 col-12 col-md-12 col-lg-9 d-flex justify-content-center">
                                                    <div class="boxSalida px-4 text-right">
                                                        <span class="bold d-block font-weight-bold" style="font-size: 1.75rem;"> {{ date('H:i', strtotime($flight->departure_date)) }} </span>
                                                        <span style="font-size: 0.6875rem; color: #636680;" class="bold d-block"> {{ $flight->depAirport_iata_code }} </span>
                                                        <span style="font-size: 0.6875rem; color: #636680;" class="bold d-block"> {{ $flight->depAirport_province }} </span>
                                                    </div>
                                                    <div class="boxDuracion text-center" style=" width: 150px; text-align: center;">
                                                        {{ date('H:i', mktime( 0,$flight->duration )) }}
                                                        <hr style="background: red;">
                                                    </div>
                                                    <div class="boxLlegada px-4">
                                                        <span class="bold d-block font-weight-bold" style="font-size: 1.75rem;"> {{ date('H:i', strtotime($flight->arrival_date)) }} </span>
                                                        <span style="font-size: 0.6875rem; color: #636680;" class="bold d-block"> {{ $flight->arriAirport_iata_code }} </span>
                                                        <span style="font-size: 0.6875rem; color: #636680;" class="bold d-block"> {{ $flight->arriAirport_province }} </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="padding: 0 1.25rem" class="w-100 d-display d-md-none"> <hr /> </div>
                                        <div class="align-items-center col-12 col-md-4 col-lg-3 justify-content-end">
                                            <div class="d-block">
                                                @if( $flight->disponibleEconomy > 0)
                                                    <div class="d-flex flex-row justify-content-between">
                                                        <div class="mr-4 d-flex align-items-center"> 
                                                            <input required type="radio" checked name="class_seat_{{ $flight->id }}" 
                                                                value="economy_{{ $flight->priceEconomy }}"
                                                            > 
                                                        </div>
                                                        <div class="d-flex flex-column text-right">
                                                            <span class="d-block lblPriceFlight">$ {{ $flight->priceEconomy }} </span>
                                                            <span style="font-size: 12px" class="d-block">Economy ( {{ $flight->disponibleEconomy }} disponibles)</span>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if( $flight->disponibleFirst > 0)
                                                    <div> <hr style="margin: 0.5rem 0;"/> </div>
                                                    <div class="d-flex flex-row justify-content-between">
                                                        <div class="mr-4 d-flex align-items-center">
                                                            <input required type="radio" {{ $flight->disponibleEconomy == 0? "checked":"" }} name="class_seat_{{ $flight->id }}" 
                                                                value="first_{{ $flight->priceFirst }}"
                                                            > 
                                                        </div>
                                                        <div class="d-flex flex-column text-right">
                                                            <span class="d-block lblPriceFlight">$ {{ $flight->priceFirst }} </span>
                                                            <span style="font-size: 12px"class="d-block">Primera clase  ( {{ $flight->disponibleFirst }} disponibles )</span>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div> <hr style="margin: 0.5rem 0;"> </div>
                                                <div class="mt-4 text-center">
                                                    <button type="submit" class="btn btn-success btn-block"> Reservar </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                        @endforeach

                        <div class="mt-5 d-flex justify-content-center">
                            {!! $objFlights->links() !!}
                        </div>                         
                    @else
                        <div class="alert alert-danger text-center" role="alert">
                            No existen vuelos programados para los datos ingresados.
                        </div>
                    @endif


                </div>
        </div>
    </div>
@endsection
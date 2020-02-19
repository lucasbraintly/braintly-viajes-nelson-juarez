@extends('layouts.plantilla')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                @if( isset($error) )
                    @switch( $error )
                        @case(0)
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Proceso exitoso!</h4>
                                <p>
                                    La reserva fue realizada correctamente, 
                                    gracias por confiar en nosotros.
                                </p>
                                <hr>
                                <p class="mb-0">
                                    Puede hacer un seguimiento de su reserva ingresando en 
                                    <a href="{{ url('/reservation') }}"> 
                                        Vuelos reservados 
                                    </a>
                                </p>
                            </div>
                            @break

                        @case(1)
                            <div class="alert alert-danger text-center" role="alert">
                                <h4 class="alert-heading">ERROR AL GUARDAR LA RESERVA!</h4>
                                <p>
                                    La reserva no se pudo completarte correctamente, 
                                    inténtelo nuevamente más tarde
                                </p>
                                <hr>
                                <p class="mb-0">
                                    Si el problema persisten contáctese con el administrador del sistema.
                                </p>
                            </div>
                            @break
                        @case(2)
                            <div class="alert alert-danger text-center" role="alert">
                                <h4 class="alert-heading">ERROR DE DISPONIBIILIDAD!</h4>
                                <p>El vuelo que desea reservar no cuenta con disponibilidad 
                                para el tipo de asiento que a seleccionado.</p>
                                <hr>
                                <p class="mb-0">
                                    Por favor vuelva a consultar el vuelo para actualizar 
                                    la disponibilidad de asientos
                                </p>
                            </div>
                            @break
                        @case(3)
                            <div class="alert alert-danger text-center" role="alert">
                                <h4 class="alert-heading">ERROR: EL VUELO NO ESTÁ EN ESTADO DE PROGRAMADO!</h4>
                                <p>El vuelo que desea reservar no se encuentra programado.</p>
                            </div>
                            @break
                    @endswitch

                    <div class="mt-4 text-center">
                        <a href="{{ url('/') }}"> 
                            Realizar otra búsqueda
                        </a>
                    </div>
                @else
                    <div class="boxMainDetailFlight my-4">
                        <h2 class="titleDetailFlight">Detalle de tu reserva</h2>
                        <div class="boxContentDetailFlight">
                            <div class="boxDetailFlight">
                                <div class="boxProvince w-100" > 
                                    <div class="p-3">
                                        <b>{{ $aDearture->province }}</b> 
                                        a 
                                        <b>{{ $aArrival->province }}</b>
                                    </div>
                                </div>
                                <div class="boxContentDetail row px-4">
                                    <div class="col-12 col-lg-9 align-self-center">
                                        <div class="row pt-4 pt-lg-0">
                                            <div class="col-12 col-md-6 align-self-center"> 
                                                <span class="font-weight-bold d-block"> {{ ucfirst($flight->departure_date_format) }} </span>
                                                <span class="d-block"> {{ $flight->aeropuerto }}</span>
                                            </div>
                                            <div class="col-12 col-md-6 align-self-center pt-4 pt-lg-0">
                                                <div class="row">
                                                    <div class="col-4 text-right">
                                                        <b>{{ date('H:i', strtotime($flight->departure_date)) }}</b><br>
                                                        {{ $aDearture->iata_code }}
                                                    </div>
                                                    <div class="col-4">
                                                        <hr>
                                                    </div>
                                                    <div class="col-4">
                                                        <b>{{ date('H:i', strtotime($flight->arrival_date)) }}</b><br>
                                                        {{ $aArrival->iata_code }}
                                                    </div>
                                                </div>
                                                <div class="row"> 
                                                    <div class="col-12 text-center fontSmall"> Duración {{ date('g\h\r i\m\i\n\s ', mktime( 0,$flight->duration )) }} </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-block d-lg-none w-100"> <hr> </div>
                                    <div class="boxPriceDetailFlight col-12 col-lg-3 mb-4 mb-lg-0 align-self-center">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-4 text-left">Clase:</div> <div class="col-8 text-right mb-4">{{ $flight->class }} </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4 text-left align-self-center">Precio:</div> 
                                                <div class="col-8 text-right font-weight-bold boxPriceDetail">
                                                    $ {{ number_format($flight->price,2,'.','') }} 
                                                </div>
                                            </div>
                                        </div>              
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="my-5 py-4 boxMainDetailFlight">
                            <form action="saveReservation" method="POST" id="confirm_form">
                                <input type="hidden" name="idFlight" value="{{ $flight->id }}">
                                <input type="hidden" name="price" value="{{ $flight->price }}">
                                <input type="hidden" name="class" value="{{ $flight->class }}">
                                @csrf
                                @method("POST")
                                <div class="container">
                                    <h2 class="w-100">Confirmá tu reserva</h2>
                                    <h5 class="w-100">Completá el formulario para asegurar tu reserva. </h5>
                                    <div class="row mt-4">
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <input id="name_user" name="name_user" maxlength="20" type="text" class="form-control" placeholder="Nombre de contacto">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <input id="surname_user" name="surname_user" maxlength="20" type="text" class="form-control" placeholder="Apellido de contacto">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <input id="email_user" name="email_user" id="email_user" maxlength=50" type="email" class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success btn-block"> Confirmar </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                @endif
            </div>
        </div>
    </div>
@endsection
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
                    @endswitch

                    <div class="mt-4 text-center">
                        <a href="{{ url('/') }}"> 
                            Realizar otra búsqueda
                        </a>
                    </div>
                @else
                    <h2>Detalle de reserva</h2>
                    <div class="card mb-3 bg-light">                                
                        <div class="card-body">
                            <h5 class="card-title">Fecha de salida: {{ date('d-m-Y', strtotime($flight->departure_date)) }} </h5>
                            <div class="row no-gutters">
                                <div class="col-8">
                                    <div>
                                        Tiempo de viaje: {{ date('H:i', mktime( 0,$flight->duration ))}}
                                        <p class="card-text">
                                            Hora salida {{ date('H:i', strtotime($flight->departure_date)) }}<br>
                                            {{ $aDearture->name }}, 
                                            {{ $aDearture->location }},
                                            {{ $aDearture->province }} <br>
                                            {{ $aDearture->iata_code }}
                                        </p>
                                        <p class="card-text">
                                            Hora llegada {{ date('H:i', strtotime($flight->arrival_date)) }}<br>
                                            {{ $aArrival->name }}, 
                                            {{ $aArrival->location }},
                                            {{ $aArrival->province }} <br>
                                            {{ $aArrival->iata_code }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-block">
                                        Clase: {{ $flight->class }} <br>
                                        Precio: $ {{ number_format($flight->price,2,'.','') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="my-4">
                        <form action="saveReservation" method="POST">
                            <input type="hidden" name="idFlight" value="{{ $flight->id }}">
                            <input type="hidden" name="price" value="{{ $flight->price }}">
                            <input type="hidden" name="class" value="{{ $flight->class }}">
                            @csrf
                            @method("POST")
                            <h2>Confirmá tu reserva</h2>
                            <h5>Completá el formulario para asegurar con tu reserva. </h5>
                            <div class="row mt-4">
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input name="name_user" maxlength="20" type="text" class="form-control" placeholder="Nombre de contacto">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input name="surname_user" maxlength="20" type="text" class="form-control" placeholder="Apellido de contacto">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input name="email_user" id="email_user" maxlength=50" type="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success" value="Confirmar">
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
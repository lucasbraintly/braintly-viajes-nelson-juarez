@extends('layouts.plantilla')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                @if( isset( $error ) )
                    @if( $error === 0)
                        <div class="alert alert-success text-center">
                            La cancelación se realizó correctamente.
                        </div>

                        <div class="text-center"> <a href="/">Inicio</a> </div>
                    @else
                        <div class="alert alert-danger text-center">
                            {{ $error }}
                        </div>
                    @endif
                @else
                    <h2>Cancelación de reserva</h2>
                    <div class="boxTableReservations">
                        <p>¿Estás seguro en cancelar la siguiente reserva? </p>                    
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th> Fecha de Reserva </th>
                                    <th> Salida </th>
                                    <th> Llegada </th>
                                    <th> Estado de vuelo </th>
                                    <th> Monto abonado </th>
                                    @if( $objReservation->montoDevolucion > 0 )
                                        <th>Monto a devolver</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> {{ date( 'd/m/Y H:i', strtotime($objReservation->fechaReserva)) }} </td>
                                    <td> 
                                        {{ date( 'd/m/Y H:i', strtotime($objReservation->departure_date)) }} <br>
                                        {{ $objReservation->depAirport_name }}<br> 
                                        {{ $objReservation->depAirport_location }}<br>
                                        {{ $objReservation->depAirport_province }} <br>
                                        {{ $objReservation->depAirport_iata_code }}

                                    </td>
                                    <td>
                                        {{ date( 'd/m/Y H:i', strtotime($objReservation->arrival_date)) }} <br>
                                        {{ $objReservation->arriAirport_name }}<br>
                                        {{ $objReservation->arriAirport_location }}<br>
                                        {{ $objReservation->arriAirport_province }} <br>
                                        {{ $objReservation->arriAirport_iata_code }}
                                    </td>
                                    <td> {{ $objReservation->statusFlight }} </td>
                                    <td>  $ {{ number_format( $objReservation->price , 2,'.','' ) }} </td>
                                    @if( $objReservation->montoDevolucion > 0 )
                                        <td>  $ {{ number_format( $objReservation->montoDevolucion , 2,'.','' ) }} </td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                        <div class="alert alert-danger text-center" role="alert">
                            @if( $objReservation->montoDevolucion > 0 )
                                Si confirma la cancelación se le hará un reintegro por 
                                <span class="lblMontoDevolucion"> 
                                $ {{ number_format( $objReservation->montoDevolucion , 2,'.','' ) }}</span>
                            @else
                                Al confirmar la cancelación <b>NO</b> se realizará ninguna devolución monetaria.</b>
                            @endif
                        </div>
                        <form action="/cancelReservation" method="POST">
                            <input type="hidden" name="idReservation" value="{{ $objReservation->id }}">
                            @csrf
                            @method("POST")
                            <div class="mt-5 text-center">
                                <button type="submit" class="mx-4 px-4 btn btn-success">Confirmar</button>
                                <button type="button" class="mx-4 px-4 btn btn-danger">Cancelar</button>
                            </div>
                        </form>
                    </div>
                    
                @endif
            </div>
        </div>
    </div>
@endsection
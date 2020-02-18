@extends('layouts.plantilla')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <h2 class="my-4">Listado de reserva</h2>
                <div class="boxTableReservations">
                    @if( count($objReservations) > 0 )
                        <table class="table table-bordered">
                            <thead>
                                <th>Acciones</th>
                                <th>Fecha de Reserva</th>
                                <th>Salida</th>
                                <th>Llegada</th>
                                <th>Estado de Vuelo</th>
                                <th>Precio abonado</th>
                                <th>Clase</th>
                            </thead>
                            <tbody>
                                @foreach( $objReservations as $item)
                                <tr>
                                    <td> 
                                        @if( $item->status === 'reserved' && $item->statusFlight === 'scheduled')
                                            <a type="button" class="btn btn-danger"
                                                href="/cancellation/{{ $item->id }}"
                                            > 
                                                Cancelar 
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-right"> {{ date( 'd/m/Y H:i', strtotime($item->fechaReserva)) }} </td>
                                    <td> 
                                        {{ date( 'd/m/Y H:i', strtotime($item->departure_date)) }} <br>
                                        {{ $item->depAirport_name }}<br> 
                                        {{ $item->depAirport_location }}<br>
                                        {{ $item->depAirport_province }} <br>
                                        {{ $item->depAirport_iata_code }}

                                    </td>
                                    <td>
                                        {{ date( 'd/m/Y H:i', strtotime($item->arrival_date)) }} <br>
                                        {{ $item->arriAirport_name }}<br>
                                        {{ $item->arriAirport_location }}<br>
                                        {{ $item->arriAirport_province }} <br>
                                        {{ $item->arriAirport_iata_code }}
                                    </td>
                                    <td> {{ $item->statusFlight }} </td>
                                    <td class="text-right">  $ {{ number_format( $item->price , 2,'.','' ) }} </td>
                                    <td> {{ $item->class_seats }} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-5 d-flex justify-content-center">
                            {!! $objReservations->links() !!}
                        </div>
                    @else
                        <div class="mt-4 text-center alert alert-danger">
                            No hay reservas realizadas.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.plantilla')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <h2>Lista de reserva</h2>
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
                    @else
                        <div class="mt-4 text-center alert alert-danger">
                            No hay reservas realizadas.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalConfirmCancel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cancelación de reserva</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Desea cancelar la reserva seleccionada?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Confirmar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>
@endsection
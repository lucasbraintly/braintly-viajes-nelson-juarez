<div class="boxSearchAirport">    
    <div class="search-box container">
        <form action="listFlights" method="POST">
            @csrf
            @method("POST")
            <h2>Filtrar por aeropuerto</h2>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <select name="departure_airport_id" id="" class="form-control search-input">
                            <option value="" selected disabled>Aeropuerto de salida</option>
                            <option value="0">TODOS</option>
                            @foreach($airports as $airport)
                                <option value="{{ $airport->id }}">({{ $airport->iata_code }}) {{ $airport->location }} - {{ $airport->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <select name="arriva_airport_id" id="" class="form-control search-input">
                            <option value="" selected disabled>Aeropuerto de llegada</option>
                            <option value="0">TODOS</option>
                            @foreach($airports as $airport)
                                <option value="{{ $airport->id }}">({{ $airport->iata_code }}) {{ $airport->location }} - {{ $airport->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Buscar">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
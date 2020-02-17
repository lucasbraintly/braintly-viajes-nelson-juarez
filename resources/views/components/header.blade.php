<header>
    <div class="container my-3">
        <a href="{{ url('/') }}">
            <img class="logo" src="{{ asset('images/logo.png') }}" alt="">
        </a>
        <a class="float-right" href="{{ url('/reservation') }}">
            Vuelos reservados
        </a>
        <div class="clearfix"></div>
    </div>
    @if( isset($isAllFlights) ) 
        @include('components.airportSearch')
    @else
        <div class="header-search">
            <div class="search-box container">
                <form action="flights" method="POST">
                    @csrf
                    @method("POST")
                    <h2>Encontrá tu viaje ideal</h2>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <select required name="departure_airport_id" id="" class="form-control search-input">
                                    <option value="" selected disabled>Salgo de...</option>
                                    @foreach($airports as $airport)
                                        <option value="{{ $airport->id }}">({{ $airport->iata_code }}) {{ $airport->location }} - {{ $airport->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <select required name="arriva_airport_id" id="" class="form-control search-input">
                                    <option value="" selected disabled>Voy a...</option>
                                    @foreach($airports as $airport)
                                        <option value="{{ $airport->id }}">({{ $airport->iata_code }}) {{ $airport->location }} - {{ $airport->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <input required name="departure_date" type="date" class="form-control search-input" placeholder="Salida...">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Buscar">
                            </div>
                        </div>
                    </div>
                </form>

                <div class="text-center">
                    <a href="/listFlights">Ver todos los vuelos disponibles</a>
                </div>
            </div>
        </div>
    @endif
</header>

@extends('layouts.app')
@section('scripts')
    <script src="{{ asset('js/stats.js') }}" defer></script>
@endsection
@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div>
                        <canvas id="myChart"></canvas>
                        <form class="mt-3" action="">
                            <select  name="interval" id="interval">
                                <option value="1" >Ultima settimana</option>
                                <option value="2" @if ($select_id == 2) selected @endif>Ultime due settimane</option>
                                <option value="3" @if ($select_id == 3) selected @endif>Ultime tre settimane</option>
                            </select>
                            <input type="hidden" name="house_id" value="{{$house_id}}">
                            <button type="submit">Invia</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


<script>
    const labels = {!! json_encode($dateLabels) !!};
    const views = {!! json_encode($views) !!};
</script>
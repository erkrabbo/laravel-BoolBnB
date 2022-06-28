@extends('layouts.app')
@section('scripts')
    <script src="{{ asset('js/stats.js') }}" defer></script>
@endsection
@section('content')
    <main>
        <div class="container chart">
            <div class="row">
                <div class="col-12 col-md-10 offset-md-1">
                    <div>
                        <canvas id="myChart"></canvas>
                        <form class="mt-3" action="">
                            <select  name="interval" id="interval">
                                <option class="option" value="1" >Ultima settimana</option>
                                <option class="option" value="2" @if ($select_id == 2) selected @endif>Ultimo mese</option>
                                <option class="option" value="3" @if ($select_id == 3) selected @endif>Ultimi tre mesi</option>
                                <option class="option" value="4" @if ($select_id == 4) selected @endif>Ultimi sei mesi</option>
                                <option class="option" value="5" @if ($select_id == 5) selected @endif>Ultimo anno</option>
                            </select>
                            <input type="hidden" name="house_id" value="{{$house_id}}">
                            <button class="mod_btn btn_pink_border" type="submit">Mostra</button>
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

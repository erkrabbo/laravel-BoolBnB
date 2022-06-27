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
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


<script>
    // DATA FROM PHP TO JAVASCRIPT
    const labels = {!! json_encode($dateLabels) !!};
    const views = {!! json_encode($views) !!};
</script>
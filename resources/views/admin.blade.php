@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="app">
            <dashboard />
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                @component('components.card')
                    @slot('title')
                        Voter Map
                    @endslot

                    <voter-map></voter-map>
                @endcomponent

            </div>
        </div>
    </div>
@endsection

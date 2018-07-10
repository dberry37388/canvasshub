@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @component('components.card')

                    @slot('title')
                        Voters
                    @endslot

                <div class="mb-3">
                    <a href="{{ route('voters.search') }}" class="btn btn-light">Back to Search</a>
                    <a href="{{ route('voters.map', request()->input()) }}" class="btn btn-light">Map Voters</a>
                </div>

                    <div>

                    </div>

                    <voter-list></voter-list>

                @endcomponent
            </div>
        </div>
    </div>
@endsection

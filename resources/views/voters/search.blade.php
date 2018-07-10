@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4">
                @component('components.card')

                    <form action="{{ route('voters.index') }}">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Precinct</label>
                            <div class="col-lg-8">
                                <select name="precinct" id="precinct" class="form-control" required>
                                    <option value="">All Precincts</option>
                                    @for ($i = 1; $i <= 21; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Propensity</label>
                            <div class="col-lg-8">
                                <select name="propensity" id="propensity" class="form-control">
                                    <option value="">Any</option>
                                    @foreach(config('voters.propensities') as $propensity)
                                        <option value="{{ $propensity }}">{{ $propensity }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Voted Recently (5/18)</label>
                            <div class="col-lg-8">
                                <select name="mostRecent" id="mostRecent" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Gender</label>
                            <div class="col-lg-8">
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">Any</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>

                    @slot('title')
                        Search Voters
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection

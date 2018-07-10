@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @component('components.card')

                    @slot('title')
                        Voters
                    @endslot

                    <div id="voterTable"></div>

                    <div class="mb-3">
                        {{ $voters->links() }}
                    </div>

                   <table class="table table-bordered table-hover">
                       <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Precinct</th>
                                <th>Propensity</th>

                                @foreach(config('voters.current_elections') as $electionYear)
                                    <th>{{ getElectionYearFromCode($electionYear) }}</th>
                                @endforeach
                            </tr>
                       </thead>

                       <tbody>
                            @foreach($voters as $voter)
                                <tr>
                                    <td>{{ $voter->first_name }}</td>
                                    <td>{{ $voter->last_name }}</td>
                                    <td>{{ $voter->age }}</td>
                                    <td>{{ $voter->gender }}</td>
                                    <td>{{ $voter->registered_address }}, {{ $voter->registered_city }}</td>
                                    <td>{{ $voter->phone }}</td>
                                    <td>{{ $voter->pct_nbr }}</td>
                                    <td>{{ $voter->propensity }}</td>

                                    @foreach(config('voters.current_elections') as $electionYear)
                                        <td>{{ $voter->{$electionYear} ?: '-' }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                       </tbody>
                   </table>

                    <div class="mt-3">
                        {{ $voters->links() }}
                    </div>

                @endcomponent
            </div>
        </div>
    </div>
@endsection

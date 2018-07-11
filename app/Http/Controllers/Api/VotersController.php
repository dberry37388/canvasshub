<?php

namespace App\Http\Controllers\Api;

use App\Filters\VoterFilters;
use App\Http\Resources\VoterResource;
use App\Voter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VotersController extends Controller
{
    /**
     * Return a filtered list of voters.
     *
     * @param \App\Filters\VoterFilters $filters
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(VoterFilters $filters)
    {
        $voters = $this->getVoters($filters);
        
        return VoterResource::collection($voters);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Voter  $voter
     * @return \App\Http\Resources\VoterResource
     */
    public function show(Voter $voter)
    {
        return new VoterResource($voter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    /**
     * Fetch all relevant threads.
     *
     * @param \App\Filters\VoterFilters $filters
     * @return mixed
     */
    protected function getVoters(VoterFilters $filters)
    {
        $voters = Voter::filter($filters);
        
        return $voters
            ->orderBy('precinct', 'asc')
            ->orderBy('registered_street_address', 'asc')
            ->orderBy('last_name', 'asc')
            ->paginate(request()->get('perPage', 25));
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Filters\VoterFilters;
use App\Http\Resources\VoterResource;
use App\Voter;
use App\Http\Controllers\Controller;

class VoterMapController extends Controller
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
     * Fetch all relevant threads.
     *
     * @param \App\Filters\VoterFilters $filters
     * @return mixed
     */
    protected function getVoters(VoterFilters $filters)
    {
        $voters = Voter::filter($filters);
        
        if ($voters->count() > 200) {
            $voters->take(200);
        }
        
        return $voters
            ->orderBy('precinct', 'asc')
            ->orderBy('registered_street_address', 'asc')
            ->orderBy('last_name', 'asc')
            ->get();
    }
}

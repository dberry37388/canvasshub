<?php

namespace App\Http\Controllers;

use App\Filters\VoterFilters;
use App\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class VoterController extends Controller
{
    /**
     * Display listing of all voters that meet the filters.
     *
     * @param \App\Filters\VoterFilters $filters
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(VoterFilters $filters)
    {
        $voters = $this->getVoters($filters);
        
        return view('voters.index', [
            'voters' => $voters->appends(Input::except('page'))
        ]);
    }
    
    /**
     * Displays the form to search for voters.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        return view('voters.search');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Voter  $voter
     * @return \Illuminate\Http\Response
     */
    public function show(Voter $voter)
    {
        return view('voter.show', compact('voter'));
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

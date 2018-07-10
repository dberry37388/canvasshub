<?php

namespace App;

use App\Filters\VoterFilters;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Malhal\Geographical\Geographical;

class Voter extends Model
{
    use Geographical;
    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'dob'
    ];
    
    /**
     * Apply all relevant thread filters.
     *
     * @param  Builder       $query
     * @param  \App\Filters\VoterFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, VoterFilters $filters)
    {
        return $filters->apply($query);
    }
    
    /**
     * Accessor for the Voter's age.
     *
     * @return int
     */
    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['dob'])->age;
    }
}

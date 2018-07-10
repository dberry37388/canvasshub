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
    
    /**
     * Query builder scope to list neighboring locations
     * within a given distance from a given location
     *
     * @param  \Illuminate\Database\Query\Builder  $query  Query builder instance
     * @param  mixed                              $lat    Lattitude of given location
     * @param  mixed                              $lng    Longitude of given location
     * @param  integer                            $radius Optional distance
     * @param  string                             $unit   Optional unit
     *
     * @return \Illuminate\Database\Query\Builder          Modified query builder
     */
    public function scopeDistance($query, $lat, $lng, $radius = 3, $unit = "mi")
    {
        $unit = ($unit === "km") ? 6378.10 : 3963.17;
        $lat = (float) $lat;
        $lng = (float) $lng;
        $radius = (double) $radius;
        
        return $query->having('distance','<=',$radius)
            ->select(DB::raw("*,
                            ($unit * ACOS(COS(RADIANS($lat))
                                * COS(RADIANS(latitude))
                                * COS(RADIANS($lng) - RADIANS(longitude))
                                + SIN(RADIANS($lat))
                                * SIN(RADIANS(latitude)))) AS distance")
            )->orderBy('distance','asc');
    }
}

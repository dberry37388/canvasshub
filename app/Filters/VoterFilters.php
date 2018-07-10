<?php

namespace App\Filters;

class VoterFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['hasVoted', 'precinct', 'propensity', 'mostRecent', 'gender'];
    
    /**
     * Filter the query where total votes is greater than 0.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function hasVoted()
    {
        return $this->builder->where('total_votes', '>', 0);
    }
    
    /**
     * Filter the query by a given username.
     *
     * @param  int $precinct
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function precinct($precinct)
    {
        if (empty($precinct)) {
            return $this->builder;
        }
        
        return $this->builder->where('precinct', $precinct);
    }
    
    /**
     * Filter the query by the given propensity.
     *
     * @param $propensity
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function propensity($propensity)
    {
        if (empty($propensity)) {
            return $this->builder;
        }
        
        return $this->builder->where('propensity', $propensity);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function mostRecent()
    {
        return $this->builder->whereNotNull('e_1');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function gender($gender)
    {
        if (empty($gender)) {
            return $this->builder;
        }
        return $this->builder->where('gender', $gender);
    }
}

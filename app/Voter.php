<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
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
     * Elections this voter has participated in.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function elections()
    {
        return $this->hasMany(Election::class);
    }
}

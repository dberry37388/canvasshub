<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VoterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'age' => $this->age,
            'gender' => $this->gender,
            'registered_address' => $this->registered_address,
            'registered_city' => $this->registered_city,
            'pct_nbr' => $this->pct_nbr,
            'propensity' => $this->propensity,
            'phone' => $this->phone,
            'e_1' => mapElectionCode($this->e_1),
            'e_4' => mapElectionCode($this->e_4),
            'e_5' => mapElectionCode($this->e_5),
            'e_8' => mapElectionCode($this->e_8),
            'e_9' => mapElectionCode($this->e_9),
            'e_13' => mapElectionCode($this->e_13),
            'e_14' => mapElectionCode($this->e_14),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
        ];
    }
}

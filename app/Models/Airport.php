<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Airport extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'airport_list';

    /**
     * Function for accessing the city from an Airport model.
     *
     * @return HasOne City that related to Airport
     */
    public function getCity(): HasOne
    {
        return $this->hasOne(City::class, 'id', 'city');
    }
}

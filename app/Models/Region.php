<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Region extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'region_list';

    /**
     * Function for accessing the city from an Region model.
     *
     * @return HasOne City that related to Region
     */
    public function getCity(): HasOne
    {
        return $this->hasOne(City::class, 'id', 'city');
    }
}

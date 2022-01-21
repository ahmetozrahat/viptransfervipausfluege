<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transfer extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transfer_list';

    /**
     * Function for accessing the Airport from a Transfer model.
     *
     * @return HasOne Airport that related to Transfer.
     */
    public function getAirport(): HasOne
    {
        return $this->hasOne(Airport::class, 'id', 'airport');
    }

    /**
     * Function for accessing the Region from a Transfer model.
     *
     * @return HasOne Region that related to Transfer.
     */
    public function getRegion(): HasOne
    {
        return $this->hasOne(Region::class, 'id', 'region');
    }
}

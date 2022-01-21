<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TransferPoint extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transfer_point';

    /**
     * Function for accessing the region from a TransferPoint model.
     *
     * @return HasOne Region that related to TransferPoint
     */
    public function getRegion(): HasOne
    {
        return $this->hasOne(Region::class, 'id', 'region');
    }
}

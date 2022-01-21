<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TransferPrice extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transfer_prices';

    /**
     * Function for accessing the Transfer from a TransferPrice model.
     *
     * @return HasOne Transfer that related to TransferPrice
     */
    public function getTransfer(): HasOne
    {
        return $this->hasOne(Transfer::class, 'id', 'transfer');
    }
}

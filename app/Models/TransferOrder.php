<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TransferOrder extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_list';

    /**
     * Function for accessing the terminal from a TransferOrder model.
     *
     * @return HasOne Terminal that related to TransferOrder
     */
    public function getTerminal(): HasOne
    {
        return $this->hasOne(Terminal::class, 'id', 'terminal');
    }

    /**
     * Function for accessing the return terminal from a TransferOrder model.
     *
     * @return HasOne Return terminal that related to TransferOrder
     */
    public function getReturnTerminal(): HasOne
    {
        return $this->hasOne(Terminal::class, 'id', 'return_terminal');
    }

    public function getVehicle(): HasOne
    {
        return $this->hasOne(Vehicle::class, 'id', 'vehicle');
    }

    public function getTransferPoint(): HasOne
    {
        return $this->hasOne(TransferPoint::class, 'id', 'destination');
    }
}

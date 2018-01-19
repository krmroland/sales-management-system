<?php

namespace App;

use App\Filters\IsFilterable;
use Illuminate\Database\Eloquent\Model;

class RoomPayment extends Model
{
    use HasDates,IsFilterable;

    protected $dates = ['date'];
    /**
     * the mass assignable fields.
     *
     * @var array
     */
    protected $fillable = ['date', 'rate', 'units', 'rateName'];

    /**
     * make a room payment.
     *
     * @param Room  $room
     * @param array $details
     */
    public function make($room, $details)
    {
        $this->room_id = $room->id;

        $this->fill($details);

        $this->rateName = $details['rate'];

        $this->rate = $room->rates()->get($this->rateName);

        $this->ammount = $this->rate * $this->units;

        $this->save();

        saveLog($this, 'room_payment');

        return $this;
    }

    /**
     * A room payment belngs to  a  specific room
     *
     * @return HasMany
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}

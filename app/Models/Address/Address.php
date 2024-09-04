<?php

namespace App\Models\Address;

use App\Models\Order\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Модель адреса
 *
 * @package App\Models\Address\Address
 * @property string $id
 * @property string $title
 * @property string $city
 * @property string $street
 * @property string $building
 * @property string $floor
 * @property string $room
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'city',
        'street',
        'building',
        'floor',
        'room',
    ];

    /**
     * Полный адрес
     *
     * @return string
     */
    public function fullAddress(): String
    {
        $address = $this->city . ", "
            . $this->street . ", "
            . $this->building;
        $address .= $this->floor ? ", эт. " . $this->floor : "";
        $address .= $this->room ? ", пом. " . $this->room : "";

        return $address;
    }

    /**
     * Полный адрес (атрибут)
     *
     * @return string
     */
    public function getFullAddressAttribute(): String
    {
        $address = $this->city . ", "
            . $this->street . ", "
            . $this->building;
        $address .= $this->floor ? ", эт. " . $this->floor : "";
        $address .= $this->room ? ", пом. " . $this->room : "";

        return $address;
    }


    /**
     * Связанные адреса доставки заказа
     *
     * @return HasOne
     */
    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}

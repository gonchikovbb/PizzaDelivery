<?php

namespace App\Models\User;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Cart\Cart;
use App\Models\Order\Order;
use App\Models\Role\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Модель пользователя
 *
 * @package App\Models\User\User
 * @property string $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $email
 * @property string $phone_number
 * @property string $password
 * @property string $birthdate
 * @property integer $role_id
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'email',
        'phone_number',
        'password',
        'birthdate',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birthdate'=> 'date',
        'password' => 'hashed',
    ];

    /**
     * Роль пользователя
     *
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Связанные заказы
     *
     * @return HasMany
     */
    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Связанные корзины
     *
     * @return HasMany
     */
    public function cart(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}

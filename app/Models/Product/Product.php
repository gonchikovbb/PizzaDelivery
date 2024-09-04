<?php

namespace App\Models\Product;

use App\Models\Cart\CartItem;
use App\Models\Category\Category;
use App\Models\Order\OrderItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Модель продукта
 *
 * @package App\Models\Product\Product
 * @property string $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property integer $category_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
    ];

    /**
     * Заказы
     *
     * @return HasMany
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Корзина с товарами
     *
     * @return HasMany
     */
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Категории
     *
     * @return belongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

<?php declare(strict_types=1);

namespace App\Enums\Order;

use BenSampo\Enum\Enum;

/**
 * Статусы трансфера
 *
 * @method static static OrderСonfirmation()
 * @method static static InProgress()
 * @method static static OutForDelivery()
 * @method static static Delivered()
 */
final class Status extends Enum
{
    const OrderСonfirmation = 0; // Подтверждение заказа
    const InProgress = 1; // В работе
    const OutForDelivery = 2; // Доставка
    const WaitingForDelivery = 3; // Доставка завершена
}

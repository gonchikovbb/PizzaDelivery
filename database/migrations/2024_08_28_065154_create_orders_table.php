<?php

use App\Enums\Order\Status as OrderStatus;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->on('users')->onDelete('cascade');
            $table->char('phone_number', 11)->nullable()->comment('Номер телефона');
            $table->string('email')->comment('Email');
            $table->foreignId('address_id')->constrained()->on('addresses')->onDelete('cascade');
            $table->time('delivery_time')->comment('Время доставки');
            $table->enum('status', OrderStatus::getValues())->default(0)->comment('Статус');
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->on('orders')->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->on('products')->onDelete('cascade');
            $table->integer('quantity')->comment('Количество');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('access_keys', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('description',255)->nullable();
            $table->bigInteger('used_traffic')->default(0);
            $table->bigInteger('limit_traffic')->nullable();
            $table->dateTime('expire_at')->nullable();
            $table->enum('status', ['active', 'expired', 'limited','deleted']);
            $table->bigInteger('key_id')->nullable();
            $table->text('key_secret')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_keys');
    }
};

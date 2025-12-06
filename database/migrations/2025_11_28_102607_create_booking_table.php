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
        Schema::create('booking', function (Blueprint $table) {
            $table->id('id_booking');
            
            $table->foreignId('profile_id')->constrained('profile', 'id_profile')->onDelete('cascade');
            $table->foreignId('kamar_id')->constrained('kamar', 'id_kamar')->onDelete('set null');
            
            $table->string('status_booking')->default('pending');
            $table->unsignedBigInteger('total_harga');
            
            $table->dateTime('tanggal_booking')->useCurrent();
            $table->dateTime('batas_booking')->nullable();
            
            $table->date('tanggal_check_in');
            $table->date('tanggal_check_out');
            
            $table->string('tipe_pembayaran')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};

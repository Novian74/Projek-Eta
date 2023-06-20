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
    // Menambahkan kolom pada tabel admin
    // String untuk tipe data varchar / stirng
    Schema::create('admins', function (Blueprint $table) {
      $table->id();
      $table->string('username');
      $table->string('password');
      $table->string('tgl_kirim_email');
      $table->string('waktu_kirim_email');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('admins');
  }
};

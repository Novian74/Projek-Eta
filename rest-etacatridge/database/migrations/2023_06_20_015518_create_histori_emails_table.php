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
    // Menambahkan kolom pada tabel histori_emails
    // String untuk tipe data varchar / stirng
    // Binary untuk tipe data seperti file pdf
    Schema::create('histori_emails', function (Blueprint $table) {
      $table->id();
      $table->string('tgl_kirim');
      $table->binary('pdf');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('histori_emails');
  }
};

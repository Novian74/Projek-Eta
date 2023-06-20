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
    // Menambahkan kolom pada tabel printer
    // String untuk tipe data varchar / stirng
    // Integer untuk tipe data angka
    Schema::create('printers', function (Blueprint $table) {
      $table->string('idprint')->primary();
      $table->string('printer_name');
      $table->integer('model_tinta');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('printers');
  }
};

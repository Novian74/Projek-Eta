
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
    // Menambahkan kolom pada tabel tinta
    // String untuk tipe data varchar / stirng
    // Integer untuk tipe data angka
    Schema::create('tintas', function (Blueprint $table) {
      $table->string('idcatridge')->primary();
      $table->string('catridge_name');
      $table->string('warna');
      $table->integer('qty');
      $table->integer('stok');
      $table->integer('TC');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('tintas');
  }
};

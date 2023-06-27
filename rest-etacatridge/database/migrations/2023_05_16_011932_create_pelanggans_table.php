
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
    // Menambahkan kolom pada tabel pelanggan
    // String untuk tipe data varchar / stirng
    Schema::create('pelanggans', function (Blueprint $table) {
      $table->string('iduser')->primary();
      $table->string('nama');
      $table->string('gedung');
      $table->string('area');
      $table->string('departemen');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('pelanggans');
  }
};

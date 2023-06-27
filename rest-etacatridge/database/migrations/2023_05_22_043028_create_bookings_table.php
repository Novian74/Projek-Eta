
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
    // Menambahkan kolom pada tabel booking
    // String untuk tipe data varchar / stirng
    Schema::create('bookings', function (Blueprint $table) {
      $table->string('nomornota')->primary();
      $table->string('iduser');
      $table->string('idprint');
      $table->string('idcatridge');
      $table->string('status');
      $table->string('batasW');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('bookings');
  }
};

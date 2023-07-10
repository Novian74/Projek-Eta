
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
    // Menambahkan kolom pada tabel print_catridges
    // String untuk tipe data varchar / stirng
    // Increments untuk membuat angka unik secara otomatis
    Schema::create('print_catridges', function (Blueprint $table) {
      $table->increments('PrCt');
      $table->string('idprint');
      $table->string('idcatridge');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('print_catridges');
  }
};

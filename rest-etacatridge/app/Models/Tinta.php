<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tinta extends Model
{
  // Agar bisa mengisi pada kolom tersebut
  protected $fillable = ['idcatridge', 'catridge_name', 'warna', 'qty', 'stok'];
}

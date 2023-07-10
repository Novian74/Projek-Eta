<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
  // Agar bisa mengisi pada kolom tersebut
  protected $fillable = ['iduser', 'nama', 'gedung', 'area', 'departemen'];
}

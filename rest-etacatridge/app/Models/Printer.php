<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Printer extends Model
{
  // Agar bisa mengisi pada kolom tersebut
  protected $fillable = ['idprint', 'printer_name', 'model_tinta'];
}

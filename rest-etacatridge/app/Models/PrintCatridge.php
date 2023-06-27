<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrintCatridge extends Model
{
  // Agar bisa mengisi pada kolom tersebut
  protected $fillable = ['idprint', 'idcatridge'];
}

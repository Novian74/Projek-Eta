<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
  // Agar bisa mengisi pada kolom tersebut
  protected $fillable = ['nomornota', 'iduser', 'idprint', 'idcatridge', 'status', 'batasW'];
}

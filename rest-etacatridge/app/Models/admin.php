<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
  // Agar bisa mengisi pada kolom tersebut
  protected $fillable = ['username', 'password', 'tgl_kirim_email', 'waktu_kirim_email'];
}

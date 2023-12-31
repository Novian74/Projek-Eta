<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriEmail extends Model
{
    use HasFactory;

    protected $fillable = ['email_penerima', 'tgl_kirim', 'pdf'];
}

<?php

namespace App\Http\Controllers;

use App\Models\HistoriEmail;
use Illuminate\Routing\Controller;

class HistoriEmailController extends Controller
{
  // Function untuk menampilkan data histori pengiriman email tiap bulan
  public function index()
  {
    $hE = HistoriEmail::select('id', 'tgl_kirim')->get();
    return response()->json($hE);
  }
}

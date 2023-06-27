<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrinterRequest;
use App\Models\Printer;

class PrinterController extends Controller
{
  // Function untuk menampilkan seluruh data printer
  public function index()
  {
    return Printer::orderBy("idprint", 'asc')->get();
  }

  // Function untuk menambah data printer
  public function store(StorePrinterRequest $request)
  {
    Printer::create($request->validated());
  }

  // Function untuk mengubah data printer
  public function update(StorePrinterRequest $request, Printer $printer)
  {
    $printer->update($request->validated());
  }

  // Function untuk mengapus data printer sesuai id
  public function destroy($id)
  {
    Printer::where("idprint", $id)->delete();
  }
}

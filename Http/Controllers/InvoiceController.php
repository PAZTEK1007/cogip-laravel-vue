<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index() {
        $invoices = Invoice::all();
        return response()->json($invoices, 200);

    }
    public function show($id) {
        $invoice = Invoice::find($id);
        if($invoice) {
            return response()->json($invoice, 200);
        } else {
            return response()->json(["message" => "Invoice not found"], 404);
        }
    }
    public function getFiveLast()
    {
        $invoices = Invoice::orderBy('created_at', 'desc')->limit(5)->get();
        return response()->json($invoices, 200);
    }

    public function getFiveLastByCompany($id)
    {
        $invoices = Invoice::where('company_id', $id)->orderBy('created_at', 'desc')->limit(5)->get();
        return response()->json($invoices, 200);
    }
}

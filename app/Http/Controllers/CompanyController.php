<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Company;

class CompanyController extends Controller
{
    public function index() {
        $companies = Company::all();
        return response()->json($companies, 200);

    }
    public function show($id) {
        $company = Company::find($id);
        if($company) {
            return response()->json($company, 200);
        } else {
            return response()->json(["message" => "Company not found"], 404);
        }
    }
    public function getFiveLast()
    {
        $companies = Company::orderBy('created_at', 'desc')->limit(5)->get();
        return response()->json($companies, 200);
    }
}


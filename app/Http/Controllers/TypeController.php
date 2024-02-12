<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    public function index() {
        $types = Type::all();
        return response()->json($types, 200);

    }

    public function show($id) {
        $type = Type::find($id);
        if($type) {
            return response()->json($type, 200);
        } else {
            return response()->json(["message" => "Type not found"], 404);
        }
    }

    public function store(Request $request) {
        $type = new Type();
        $type->name = $request->name;
        $type->save();
        return response()->json($type, 201);
    }
}

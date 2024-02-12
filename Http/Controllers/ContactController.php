<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index() {
        $contacts = Contact::all();
        return response()->json($contacts, 200);

    }
    public function show($id) {
        $contact = Contact::find($id);
        if($contact) {
            return response()->json($contact, 200);
        } else {
            return response()->json(["message" => "Contact not found"], 404);
        }
    }

    public function getFiveLast()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->limit(5)->get();
        return response()->json($contacts, 200);
    }
    public function getContactByCompanyId($id)
    {
        $contacts = Contact::where('company_id', $id)->get();
        return response()->json($contacts, 200);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Invoice;
use App\Models\Contact;

class Company extends Model
{
    use HasFactory;

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}

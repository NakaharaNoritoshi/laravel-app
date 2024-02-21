<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ContactRepository
{
    public function getContactList()
    {
        return Contact::select('id', 'name', 'mail', 'title', 'content')
            ->get();
    }

    public function getContactDetail($id)
    {
        return Contact::select('id', 'name', 'mail', 'title', 'content')
            ->where('id', $id)
            ->first();
    }
}

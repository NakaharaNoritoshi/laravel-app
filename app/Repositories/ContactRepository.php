<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ContactRepository
{
    public function getContactList($limit, $keyword)
    {
        $query = Contact::select('id', 'name', 'mail', 'title', 'content', 'reply', 'category');
        if (!empty($keyword)) {
            $query->where("reply", "LIKE", "%{$keyword}%")
                ->orWhere("category", "LIKE", "%{$keyword}%");
        }
        return $query->paginate($limit);
    }

    public function getContactDetail($id)
    {
        return Contact::select('id', 'name', 'mail', 'title', 'content', 'reply', 'category')
            ->where('id', $id)
            ->first();
    }
}

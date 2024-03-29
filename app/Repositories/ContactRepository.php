<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Auth;

class ContactRepository
{
    public function getContactList($limit, $keyword, $from, $until, $display_list)
    {
        $query = Contact::select('id', 'name', 'mail', 'title', 'content', 'reply', 'category', 'created_at');
        if (!empty($keyword)) {
            $query->where(function ($query) use ($keyword) {
                $query->where("name", "Like", "%{$keyword}%")
                    ->orWhere("title", "Like", "%{$keyword}%")
                    ->orWhere("reply", "=", "$keyword")
                    ->orWhere("category", "LIKE", "%{$keyword}%")
                    ->orWhere("content", "Like", "%{$keyword}%");
            });
        }
        if (!empty($from) && !empty($until)) {
            $query->whereBetween("created_at", [$from, $until])
                ->orderBy("created_at", "asc");
        }
        if (empty($display_list)) {
            $display_list = 5;
        }

        return $query->paginate($limit);
    }

    public function getContactDetail($id)
    {
        return Contact::select('id', 'name', 'mail', 'title', 'content', 'reply', 'category', 'created_at')
            ->where('id', $id)
            ->first();
    }
}

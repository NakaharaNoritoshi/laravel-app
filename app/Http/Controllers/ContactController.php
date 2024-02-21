<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Contact;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ContactController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // protected $contact_repository;

    // public function __construct(ContactRepository $contact_repository)
    // {
    //     $this->contact_repository = $contact_repository;
    // }

    public function index()
    {
        return view('contact.index');
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mail' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);
        $data = $request->only(['name', 'mail', 'mail_confirmation', 'title', 'content']);

        return view('contact.confirm', $data);
    }

    public function send(Request $request)
    {
        $data = $request->only(['name']);
        $attributes = $request->only(['name', 'mail', 'mail_confirmation', 'title', 'content']);
        Contact::create($attributes);

        return view('contact.send', $data);
    }
}

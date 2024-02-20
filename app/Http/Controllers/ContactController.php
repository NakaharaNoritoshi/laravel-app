<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Contact;

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

    public function confirm()
    {
        return view('contact.confirm');
    }

    public function send()
    {
        return view('contact.send');
    }
}

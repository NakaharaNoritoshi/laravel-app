<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Repositories\ContactRepository;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\DB;

class ContactController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $contact_repository;

    public function __construct(ContactRepository $contact_repository)
    {
        $this->contact_repository = $contact_repository;
    }

    public function index()
    {
        return view('contact_front.index');
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mail' => 'required|email',
            'mail_confirmation' => 'required|email|same:mail',
            'title' => 'required',
            'content' => 'required',
            'checkbox' => 'required',
            'category' => 'required|numeric|between:1,5',
        ]);
        $data = $request->only(['name', 'mail', 'mail_confirmation', 'title', 'content', 'category', 'reply']);
        // dump($data);
        $checkbox_array = [];
        foreach($request->input('checkbox') as $values) {
            $checkbox_array[] = $values;
        }

        return view('contact_front.confirm', $data, ['values' => $values]);
    }

    public function send(Request $request)
    {
        $data = $request->only(['name']);
        $attributes = $request->only(['name', 'mail', 'mail_confirmation', 'title', 'content', 'category', 'reply']);
        $attributes['reply'] = $request->input('checkbox');
        Contact::create($attributes);

        return view('contact_front.send', $data);
    }

    public function list(Request $request)
    {
        $keyword = $request->input('keyword');
        $contact_list = $this->contact_repository->getContactList(5, $keyword);

        return view('contact_back.list', [
            'contact_list' => $contact_list,
            'keyword' => $keyword,
        ]);
    }

    public function detail($id)
    {
        $contact = $this->contact_repository->getContactDetail($id);
        return view('contact_back.detail', ['contact' => $contact]);
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->route('contact_back.list');
    }
}

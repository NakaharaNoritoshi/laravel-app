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
use Auth;
use Illuminate\Support\Facades\Config;

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
        $validate_rule = Config::get('validate.validates');
        $request->validate($validate_rule);
        $data = $request->only(['name', 'mail', 'mail_confirmation', 'title', 'content', 'category', 'reply']);
        $checkbox_array = $request->input('reply', []);

        return view('contact_front.confirm', $data, ['checkbox_array' => $checkbox_array]);
    }

    public function send(Request $request)
    {
        $data = $request->only(['name']);
        $attributes = $request->only(['name', 'mail', 'mail_confirmation', 'title', 'content', 'category', 'reply']);
        $attributes['reply'] = implode(', ', $request->input('reply', []));
        Contact::create($attributes);

        return view('contact_front.send', $data);
    }

    public function list(Request $request)
    {
        $keyword = $request->input('keyword');
        $from = $request->input('from');
        $until = $request->input('until');
        $display_list = $request->input('display_list');
        $limit = $display_list ?? 5;
        $contact_list = $this->contact_repository->getContactList($limit, $keyword, $from, $until, $display_list);

        return view('contact_back.list', [
            'contact_list' => $contact_list,
            'keyword' => $keyword,
            'from' => $from,
            'until' => $until,
            'display_list' => $display_list,
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

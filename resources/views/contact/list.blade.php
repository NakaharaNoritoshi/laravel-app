@extends('layouts.main')

@section('content')

<div class="contact_form_title">
    <h2>お問い合わせ管理</h2>
</div>

<table class="contact_list_table">
    <tr>
        <th>お名前</th>
        <th>メールアドレス</th>
        <th>詳細&nbsp;/&nbsp;削除</th>
    </tr>
    @foreach ($contact_list as $contact)
        <tr>
            <td>{{ $contact->name }}</td>
            <td>{{ $contact->mail }}</td>
            <td>
                <a href="{{ route('contact.detail', $contact->id) }}">詳細</a>
                    <span>&nbsp;/&nbsp;</span>
                    <form action="{{ route('destroy', ['id' => $contact->id]) }}" method="post">
                        @csrf
                        <div class="contact_detail_destroy" onClick="return confirm('本当に削除しますか？')">削除</div>
                    </form>
            </td>
        </tr>
    @endforeach
</table>

@endsection

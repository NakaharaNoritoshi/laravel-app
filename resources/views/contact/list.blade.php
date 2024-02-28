@extends('layouts.main')

@section('content')

<div class="back_to_top_link_list">
    <a href="{{ route('contact.index') }}">TOPへ戻る</a>
</div>

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
            <td class="contact_detail">
                <a href="{{ route('contact.detail', $contact->id) }}">
                    <button class="contact_detail_detail">詳細</button>
                </a>
                <form action="{{ route('destroy', ['id'=>$contact->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="contact_detail_destroy" onClick="return confirm('本当に削除しますか？')">削除</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

@endsection

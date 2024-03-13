@extends('layouts.main')

@section('title', 'お問い合わせ')

@section('content')

<div class="contact_form_title">
    <h2>お問い合わせ詳細</h2>
</div>

<table class="contact_detail_table">
    <tr>
        <th class="contact_detail_table_name">お名前</th>
        <td>{{ $contact->name }}</td>
    </tr>
    <tr>
        <th class="contact_detail_table_mail">メールアドレス</th>
        <td>{{ $contact->mail }}</td>
    </tr>
    <tr>
        <th class="contact_detail_table_reply">返答</th>
        <td>{{ $contact->reply }}</td>
    </tr>
    <tr>
        <th class="contact_detail_table_category">カテゴリー</th>
        <td>{{ $contact->category }}</td>
    </tr>
    <tr>
        <th class="contact_detail_table_create">投稿日</th>
        <td>{{ $contact->created_at }}</td>
    </tr>
    <tr>
        <th class="contact_detail_table_title">お問い合わせタイトル</th>
        <td class="contact_detail_table_left">{{ $contact->title }}</td>
    </tr>
    <tr>
        <th class="contact_detail_table_content">お問い合わせ内容</th>
        <td class="contact_detail_table_right">{{ $contact->content }}</td>
    </tr>
</table>

<div class="contact_form_link">
    <div class="back_to_management_link">
        <a href="{{ route('contact_back.list') }}">お問い合わせ管理へ戻る</a>
    </div>

    <div class="back_to_top_link">
        <a href="{{ route('contact_front.index') }}">TOPへ戻る</a>
    </div>
</div>

@endsection

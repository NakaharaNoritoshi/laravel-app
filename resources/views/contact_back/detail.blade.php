@extends('layouts.main')

@section('content')

<div class="contact_form_title">
    <h2>お問い合わせ詳細</h2>
</div>

<table class="contact_detail_table">
    <tr>
        <th class="contact_detail_table_left">お問い合わせタイトル</th>
        <th class="contact_detail_table_right">お問い合わせ内容</th>
    </tr>
    <tr>
        <td class="contact_detail_table_left">{{ $contact->title }}</td>
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

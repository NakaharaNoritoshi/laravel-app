@extends('layouts.main')

@section('content')

<div class="contact_form_title">
    <h2>お問い合わせフォーム</h2>
</div>

<div class="contact_form_list">
    <div class="contact_form_list_seventh">お問い合わせ<br>内容の入力</div>
    <div class="contact_form_list_eighth">お問い合わせ<br>内容の確認</div>
    <div class="contact_form_list_ninth">送信完了</div>
</div>

<div class="contact_form_complete">
    <p>お問い合わせを受付しました。</p>
    <br><span class="after_sending_name">{{ $name }}</span>様
    ありがとうございました。
</div>

<div class="contact_form_link">
    <div class="back_to_top_link">
        <a href="{{ route('contact.index') }}">TOPへ戻る</a>
    </div>
</div>

@endsection

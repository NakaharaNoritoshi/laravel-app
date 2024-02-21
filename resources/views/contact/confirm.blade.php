@extends('layouts.main')

@section('content')

<div class="contact_form_title">
    <h2>お問い合わせフォーム</h2>
</div>

<div class="contact_form_list">
    <div class="contact_form_list_fourth">お問い合わせ<br>内容の入力</div>
    <div class="contact_form_list_fifth">お問い合わせ<br>内容の確認</div>
    <div class="contact_form_list_sixth">送信完了</div>
</div>

<div class="contact_form_mini_title">
    <h3>お客様の情報を入力してください</h3>
</div>

<form method="post" action="{{ route('contact.send') }}">@csrf
    <table class="contact_form_table">
        <tr>
            <td class="contact_form_table_left">お名前
                <span class="required_item_mark">*</span>
            </td>
            <td class="contact_form_table_right">
                <input type="hidden" name="name" value="{{ $name }}">{{ $name }}
            </td>
        </tr>
        <tr>
            <td class="contact_form_table_left">メールアドレス
                <span class="required_item_mark">*</span>
            </td>
            <td class="contact_form_table_right">
                <input type="hidden" name="mail" value="{{ $mail }}">{{ $mail }}
            </td>
        </tr>
        <tr>
            <td class="contact_form_table_left"></td>
            <td class="contact_form_table_right">
                <input type="hidden" name="mail_confimation" value="{{ $mail }}">{{ $mail }}
            </td>
        </tr>
    </table>

    <div class="contact_form_mini_title">
        <h3>お問い合わせ内容を入力してください</h3>
    </div>
    <table class="contact_form_table">
        <tr>
            <td class="contact_form_table_left">タイトル
                <span class="required_item_mark">*</span>
            </td>
            <td class="contact_form_table_right">
                <input type="hidden" name="title" value="{{ $title }}">{{ $title }}
            </td>
        </tr>
        <tr>
            <td class="contact_form_table_left">内容
                <span class="required_item_mark">*</span>
            </td>
            <td class="contact_form_table_right">
                <input type="hidden" name="content" value="{{ $content }}">{{ $content }}
            </td>
        </tr>
    </table>
    <span class="required_item_sentence">*は必須項目です</span>

    <div class="contact_form_button">
        <div class="contact_form_button_set">
            <input type="submit">
        </div>
    </div>
</form>

@endsection

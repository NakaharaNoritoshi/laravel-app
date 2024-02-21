@extends('layouts.main')

@section('content')

<div class="contact_form_title">
    <h2>お問い合わせフォーム</h2>
</div>

<div class="contact_form_list">
    <div class="contact_form_list_forth">お問い合わせ<br>内容の入力</div>
    <div class="contact_form_list_fifth">お問い合わせ<br>内容の確認</div>
    <div class="contact_form_list_sixth">送信完了</div>
</div>

<div class="contact_form_mini_title">
    <h3>お客様の情報を入力してください</h3>
</div>

<form method="post" action="">@csrf
    <table class="contact_form_table">
        <tr>
            <td class="contact_form_table_left">お名前
                <span class="required_item_mark">*</span>
            </td>
            <td class="contact_form_table_right">
                <input type="text" name="name" placeholder="お名前を入力してください">
            </td>
        </tr>
        <tr>
            <td class="contact_form_table_left">メールアドレス
                <span class="required_item_mark">*</span>
            </td>
            <td class="contact_form_table_right"><input type="text" name="mail" placeholder="メールアドレスを入力してください"></td>
        </tr>
        <tr>
            <td class="contact_form_table_left"></td>
            <td class="contact_form_table_right"><input type="text" name="mail_confimation" placeholder="確認のためもう1度入力してください"></td>
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
            <td class="contact_form_table_right"><input type="text" name="title" placeholder="タイトルを入力してください"></td>
        </tr>
        <tr>
            <td class="contact_form_table_left">内容
                <span class="required_item_mark">*</span>
            </td>
            <td class="contact_form_table_right"><textarea name="text" name="content" placeholder="内容を入力してください"></textarea></td>
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

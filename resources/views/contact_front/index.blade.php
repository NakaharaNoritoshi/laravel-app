@extends('layouts.main')

@section('content')

@if(Auth::check())
    <div class="go_to_management_link">
        <a href="{{ route('contact_back.list') }}">お問い合わせ管理<br>へ移動する</a>
    </div>
@else
    <a href="{{ route('login')}}">お問い合わせ管理へ移動する</a>
@endif

<div class="contact_form_title">
    <h2>お問い合わせフォーム</h2>
</div>

<div class="contact_form_list">
    <div class="contact_form_list_first">お問い合わせ<br>内容の入力</div>
    <div class="contact_form_list_second">お問い合わせ<br>内容の確認</div>
    <div class="contact_form_list_third">送信完了</div>
</div>

<div class="contact_form_mini_title">
    <h3>お客様の情報を入力してください</h3>
</div>

<form method="post" action="{{ route('contact_front.confirm') }}">@csrf
    <table class="contact_form_table">
        <tr>
            <td class="contact_form_table_left">お名前
                <span class="required_item_mark">*</span>

                <br>@if ($errors->has('name'))
                    <span class="validation_error_statement">{{$errors->first('name')}}</span>
                @endif

            </td>
            <td class="contact_form_table_right">
                <input type="text" name="name" placeholder="お名前を入力してください" required value="{{ old('name') }}">
            </td>
        </tr>
        <tr>
            <td class="contact_form_table_left">メールアドレス
                <span class="required_item_mark">*</span>

                <br>@if ($errors->has('mail'))
                    <span class="validation_error_statement">{{$errors->first('mail')}}</span>
                @endif

            </td>
            <td class="contact_form_table_right">
                <input type="text" name="mail" placeholder="メールアドレスを入力してください" required value="{{ old('mail') }}">
            </td>
        </tr>
        <tr>
            <td class="contact_form_table_left">
                @if ($errors->has('mail_confirmation'))
                    <span class="validation_error_statement">{{$errors->first('mail_confirmation')}}</span>
                @endif
            </td>
            <td class="contact_form_table_right">
                <input type="text" name="mail_confirmation" placeholder="確認のためもう1度入力してください" required value="{{ old('mail') }}">
            </td>
        </tr>
    </table>

    <div class="contact_form_mini_title">
        <h3>お問い合わせ内容を入力してください</h3>
    </div>
    <table class="contact_form_table">
        <!-- replyのチェックボックス -->
        <tr>
            <td class="contact_form_table_left">返答
                <span class="required_item_mark">*</span>

                <br>@if ($errors->has('reply'))
                    <span class="validation_error_statement">{{$errors->first('reply')}}</span>
                @endif

            </td>
            <td class="contact_form_table_right">
                <div class="contact_form_checkbox">
                    @foreach(Config::get('reply.reply_speed') as $value)
                        <input type="checkbox" name="reply[]" value="{{ $value[0] }}" @if(is_array(old('reply')) && in_array($value[0], old('reply'))) checked @endif>
                        <div class="contact_form_checkbox_reply">{{ $value[0] }}</div>
                    @endforeach
                </div>
            </td>
        </tr>
         <!-- categoryのプルダウン -->
         <tr>
            <td class="contact_form_table_left">カテゴリー
                <span class="required_item_mark">*</span>

                <br>@if ($errors->has('category'))
                    <span class="validation_error_statement">{{$errors->first('category')}}</span>
                @endif

            </td>
            <td class="contact_form_table_right">
                <label class="contact_form_category"></label>
                    <select class="contact_form_reply_control" name="category">
                        @foreach(Config::get('pulldown.pull_down') as $key)
                            <option type="pulldown" required value="{{ $key }}"  @if(old('category') == $key) selected @endif>{{ $key }}</option>
                        @endforeach
                    </select>
            </td>
        </tr>
        <tr>
            <td class="contact_form_table_left">タイトル
                <span class="required_item_mark">*</span>

                <br>@if ($errors->has('title'))
                    <span class="validation_error_statement">{{$errors->first('title')}}</span>
                @endif

            </td>
            <td class="contact_form_table_right">
                <input type="text" name="title" placeholder="タイトルを入力してください" required value="{{ old('title') }}">
            </td>
        </tr>
        <tr>
            <td class="contact_form_table_left">内容
                <span class="required_item_mark">*</span>

                <br>@if ($errors->has('content'))
                    <span class="validation_error_statement">{{$errors->first('content')}}</span>
                @endif

            </td>
            <td class="contact_form_table_right">
                <textarea name="content" placeholder="内容を入力してください" required>{{ old('content') }}</textarea>
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

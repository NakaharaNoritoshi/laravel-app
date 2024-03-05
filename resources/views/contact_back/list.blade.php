@extends('layouts.main')

@section('content')

<div class="back_to_top_link_list">
    <a href="{{ route('contact_front.index') }}">TOPへ戻る</a>
</div>

<div class="contact_form_title">
    <h2>お問い合わせ管理</h2>
</div>

<!-- 検索機能の追加 -->
<div class="contact_list_search">
    <form action="{{ route('contact_back.list') }}" method="get">
        @csrf
        <div class="contact_list_search_box">
            <input class="contact_list_search_column" type="text" name="keyword" value="{{ $keyword }}" placeholder="キーワード検索" />
            <input class="contact_list_search_button"  type="submit" value="検索">
        </div>
    </form>
</div>

    <table class="contact_list_table">
        <tr>
            <th class="contact_list_table_name">お名前</th>
            <th class="contact_list_table_mail">メールアドレス</th>
            <th class="contact_list_table_reply">返答</th>
            <th class="contact_list_table_category">カテゴリー</th>
            <th class="contact_list_table_detail">詳細&nbsp;/&nbsp;削除</th>
        </tr>
        @foreach ($contact_list as $contact)
            <tr class="contact_list_table_datacolumn">
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->mail }}</td>
                <td class="@if($contact->reply == $keyword) highlighted @endif">{{ $contact->reply }}</td>
                <td class="@if($contact->category == $keyword) highlighted @endif">{{ $contact->category }}</td>
                <td class="contact_detail">
                    <a href="{{ route('contact_back.detail', $contact->id) }}">
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

{{ $contact_list->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
    <div class="contact_list_table_display">
        {{ $contact_list->firstItem() }}〜{{ $contact_list->lastItem() }}件を表示 / {{ $contact_list->total() }}件中
    </div>

@endsection

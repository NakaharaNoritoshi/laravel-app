@extends('layouts.main')

@section('content')

<div class="back_to_top_link_list">
    <a href="{{ route('contact_front.index') }}">TOPへ戻る</a>
</div>

<div class="contact_form_title">
    <h2>お問い合わせ管理</h2>
</div>

    <button id="start-btn">start</button>
    <button id="stop-btn">stop</button>
    <div id="result-div"></div>

<!-- 検索機能の追加 -->
<div class="contact_list_search">
    <form action="{{ route('contact_back.list') }}" method="get">
        @csrf
            <div class="contact_list_search_box">
                <input class="contact_list_search_column" type="text" name="keyword" value="{{ $keyword }}" placeholder="キーワード検索" />
                    @livewire('modal')
                <input class="contact_list_search_button"  type="submit" value="検索">
            </div>
    </form>
</div>

    <table class="contact_list_table">
        <tr>
            <th class="contact_list_table_name">お名前</th>
            <th class="contact_list_table_title">タイトル</th>
            <th class="contact_list_table_reply">返答</th>
            <th class="contact_list_table_category">カテゴリー</th>
            <th class="contact_list_table_update">投稿日</th>
            <th class="contact_list_table_detail">詳細&nbsp;/&nbsp;削除</th>
        </tr>
        @foreach ($contact_list as $contact)
            <tr class="contact_list_table_datacolumn">
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->title }}</td>
                <td class="@if($keyword && str_contains($contact->reply, $keyword)) highlighted @endif">{{ $contact->reply }}</td>
                <td class="@if($contact->category == $keyword) highlighted @endif">{{ $contact->category }}</td>
                <td>{{ $contact->updated_at }}</td>
                <td class="contact_detail">
                    <!-- 詳細/削除カラムにcontent(本文)を最初の10文字取得する設定 -->
                    <div class="contact_detail_content">
                        {{ Illuminate\Support\Str::limit($contact->content, 15) }}
                    </div>
                    <div class="contact_detail_deteil_destroy">
                        <a href="{{ route('contact_back.detail', $contact->id) }}">
                            <button class="contact_detail_detail">詳細</button>
                        </a>
                        <form action="{{ route('destroy', ['id'=>$contact->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="contact_detail_destroy" onClick="return confirm('本当に削除しますか？')">削除</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>

{{ $contact_list->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
    <div class="contact_list_table_display">
        {{ $contact_list->firstItem() }}〜{{ $contact_list->lastItem() }}件を表示 / {{ $contact_list->total() }}件中
    </div>

@endsection

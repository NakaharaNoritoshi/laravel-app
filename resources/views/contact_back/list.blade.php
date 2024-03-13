@extends('layouts.main')

@section('content')

<div class="back_to_top_link_list">
    <a href="{{ route('contact_front.index') }}">TOPへ戻る</a>
</div>

<div class="contact_form_title">
    <h2>お問い合わせ管理</h2>
</div>

<!-- 音声認識の追加。表示先は検索機能の記入欄 -->
<div class="contact_list_voice_search">
    <button id="contact_list_voice_search_start">start</button>
    <button id="contact_list_voice_search_stop">stop</button>
</div>

<!-- 検索機能の追加 -->
<div class="contact_list_search">
    <form action="{{ route('contact_back.list') }}" method="get">
        @csrf
            <div class="contact_list_search_box">
                <input class="contact_list_search_column" type="text" id="contact_list_voice_search_result" name="keyword" value="{{ $keyword }}" placeholder="キーワード検索" />
                    @livewire('modal')
                <input class="contact_list_search_button"  type="submit" value="検索">
                <button class="contact_list_search_reload" id="contact_list_search_reload_clear" type="button">更新</button>
            </div>

            <!-- 日付検索機能の追加 -->
            <div class="contact_list_search_date">
                <div class="contact_list_search_date_search">
                    <label for="search_date" class="contact_list_search_date_top">日付検索</label>
                        <input type="date" name="from" id="search_date" placeholder="from_date" value="{{ $from }}">
                            <span class="contact_list_search_date_from">〜</span>
                        <input type="date" name="until" id="search_date" placeholder="until_date" value="{{ $until }}">
                    <button type="submit" class="contact_list_search_date_button">検索</button>
                </div>
            </div>

            <!-- 表示件数機能の追加 -->
            <div class="contact_list_search_result">
                <p class="contact_list_search_total_result">総件数: {{ $contact_list->total() }}件</p>
                    <label for="display_result" class="contact_list_search_display_result">表示件数</label>
                    <select name="display_list" id="display_result" class="contact_list_search_number" onchange="submit();">
                        @foreach(Config::get('result.results') as $key)
                            @if($key === $display_list)
                                <option value="{{ $key }}" selected>{{ $key }}</option>
                            @else
                                <option value="{{ $key }}">{{ $key }}</option>
                            @endif
                        @endforeach
                    </select>
            </div>
    </form>
</div>

    <table class="contact_list_table">
        <tr>
            <th class="contact_list_table_name">お名前</th>
            <th class="contact_list_table_title">タイトル</th>
            <th class="contact_list_table_reply">返答</th>
            <th class="contact_list_table_category">カテゴリー</th>
            <th class="contact_list_table_create">投稿日</th>
            <th class="contact_list_table_detail">詳細&nbsp;/&nbsp;削除</th>
        </tr>
        @foreach ($contact_list as $contact)
            <tr class="contact_list_table_datacolumn">
                <td class="@if($keyword && str_contains($contact->name, $keyword)) highlighted @endif">{{ $contact->name }}</td>
                <td class="@if($keyword && str_contains($contact->title, $keyword)) highlighted @endif">{{ $contact->title }}</td>
                <td class="@if($keyword && str_contains($contact->reply, $keyword)) highlighted @endif">{{ $contact->reply }}</td>
                <td class="@if($keyword && str_contains($contact->category, $keyword)) highlighted @endif">{{ $contact->category }}</td>
                <td class="@if($from && $until && str_contains($contact->created_at, $from && $until)) highlighted @endif">{{ $contact->created_at }}</td>
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

{{ $contact_list->withQueryString()->onEachSide(2)->links('vendor.pagination.bootstrap-4') }}
    <div class="contact_list_table_display">
        {{ $contact_list->firstItem() }}〜{{ $contact_list->lastItem() }}件を表示 / {{ $contact_list->total() }}件中
    </div>

@endsection

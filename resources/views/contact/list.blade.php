@extends('layouts.main')

@section('content')

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
            <td>ダミー&nbsp;/&nbsp;ダミー</td>
            {{-- <td><a href="{{ route('contact/detail')}}">ダミー</a></td> --}}
        </tr>
    @endforeach
</table>

@endsection

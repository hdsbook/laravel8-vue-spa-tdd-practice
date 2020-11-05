@extends('layouts.basic')

@section('title', '最新消息')

@section('content')
<div id="newsApp"></div>
@endsection

@section('scripts')
<script src="{{ asset('js/components/news.js') }}"></script>
@endsection

@extends('layouts.basic')

@section('title', '最新消息')

@section('content')
<div id="newsApp"></div>

@routes(['news'])
@endsection

@section('scripts')
<script src="{{ mix('js/pages/news.js') }}"></script>
@endsection

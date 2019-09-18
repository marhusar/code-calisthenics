@extends('layout')

@section('content_title', 'Show language')

@section('content')
    <p>This is Language detail.</p>
    @if ($language !== null)
        @include('language.detail', ['language' => $language])
    @endif
@endsection

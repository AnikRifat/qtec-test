@extends('layouts.app')
@section('content')
<form action="/search" method="POST">
    @csrf
    <input type="text" name="q" placeholder="Search keywords...">
    <button type="submit">Search</button>
</form>
@endsection

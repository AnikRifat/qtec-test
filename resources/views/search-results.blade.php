@extends('layouts.app')
@section('content')
<h2>Search Results</h2>

@if (is_array($results))

<p>Showing {{ count($results) }} results:</p>
<ul>
    @foreach ($results as $result)
    {{-- {{ dd($result) }} --}}
    <li>{{ $result->title }}</li>
    @endforeach
</ul>


@else
<p>No results found.</p>
@endif
@endsection
@extends('layouts.app')
@section('content')
    @if($forms->isEmpty())
        <p>No Forms Available</p>
    @endif
@endsection

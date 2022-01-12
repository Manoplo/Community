@extends('layouts.app')
@section('content')
<div class="container">

    <h1>Community</h1>

    @foreach($links as $link)

    <li>{{$link->title}}</li>
    <small>Contributed by: {{$link->creator->name}} {{$link->updated_at->diffForHumans()}}</small>

    @endforeach

    {{$links->links()}}
</div>

@stop
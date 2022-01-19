@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Community</h1>
            @foreach ($links as $link)
            <li>
                <a href="{{$link->link}}" target="_blank">
                    {{$link->title}}
                </a>
                <small>Contributed by: {{$link->creator->name}} {{$link->updated_at->diffForHumans()}}</small>
                <span class="label label-default" style="background: {{ $link->channel->color }};  color: {{ $link->channel->color === 'yellow' ? 'black' : 'white' }}; padding: 4px; border-radius: 7px;">
                    {{$link->channel->title}}
                </span>
            </li>
            @endforeach

        </div>
        <div class="col-md-4">

            @include('partials.add-link')

        </div>
    </div>
    {{$links->links()}}

</div>


@stop
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Community</h1>

            @include('partials.link-list')

        </div>
        <div class="col-md-4">

            @include('partials.add-link')

            <div>
                @include('flash-messages')
            </div>
        </div>
    </div>
    {{$links->links()}}

</div>


@stop
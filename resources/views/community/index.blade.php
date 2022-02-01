@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">




            @include('partials.link-list')

        </div>
        <div class="col-md-4">

            @include('partials.add-link')

            <div>
                @include('flash-messages')
            </div>
        </div>
    </div>
    {{$links->appends($_GET)->links()}}

</div>


@stop
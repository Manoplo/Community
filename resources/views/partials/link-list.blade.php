@if(!$channel)
<h1>Community</h1>
@else
<h1>Community - {{$channel->title}} - <a href="/community">All Links</a></h1>
@endif

@if( count($links) === 0 )
<h3>No contributions yet...</h3>
@endif

@foreach ($links as $link)
<li class="mb-3">


    <a class="label label-default" style="text-decoration: none; background: {{ $link->channel->color }};  color: {{ $link->channel->color === 'yellow' ? 'black' : 'white' }}; padding: 4px; border-radius: 7px; margin-right: 1em" href="/community/{{$link->channel->slug}}">
        {{$link->channel->title}}
    </a>
    <a href="{{$link->link}}" target="_blank">
        {{$link->title}}
    </a>
    <small>Contributed by: {{$link->creator->name}} {{$link->updated_at->diffForHumans()}}</small>

</li>
@endforeach
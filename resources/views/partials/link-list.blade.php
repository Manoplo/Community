@if( count($links) === 0 )
    <h3>No contributions yet...</h3>
    @endif

    @foreach ($links as $link)
    <li class="mb-3">
        <span class="label label-default" style="background: {{ $link->channel->color }};  color: {{ $link->channel->color === 'yellow' ? 'black' : 'white' }}; padding: 4px; border-radius: 7px; margin-right: 1em">
            {{$link->channel->title}}
        </span>
        <a href="{{$link->link}}" target="_blank">
            {{$link->title}}
        </a>
        <small>Contributed by: {{$link->creator->name}} {{$link->updated_at->diffForHumans()}}</small>

    </li>
@endforeach
<div class="card">
    <div class="card-header">
        <h3>Contribute a link</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="/community">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title:</label>

                <input type="text" value="{{old('title')}}" class="form-control" id="title" name="title" placeholder="What is the title of your article?">


            </div>
            @error('title')
            <p class="text-sm text-danger">{{$message}}</p>
            @enderror

            <div class=" form-group">
                <label for="link">Link:</label>
                <input type="text" value="{{old('link')}}" class="form-control" id="link" name="link" placeholder="What is the URL?">

            </div>

            @error('link')
            <p class="text-sm text-danger">{{$message}}</p>
            @enderror


            <div class="form-group">
                <label for="Channel">Channel</label>
                <select class="form-control @error('channel_id') is-invalid @enderror" name="channel_id" id="">
                    <option selected disabled>Pick a channel...</option>
                    @foreach($channels as $channel)
                    <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                        {{$channel->title}}
                    </option>
                    @endforeach
                </select>
                @error('channel_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group card-footer">
                <button class="btn btn-primary">Contribute Link</button>
            </div>
        </form>
    </div>
</div>
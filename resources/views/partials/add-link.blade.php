<div class="card">
    <div class="card-header">
        <h3>Contribute a link</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="/community">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title:</label>

                <input type="text" class="form-control" id="title" name="title" placeholder="What is the title of your article?">


            </div>
            @error('title')
            <p class="text-sm text-red-700">{{$message}}</p>
            @enderror

            <div class="form-group">
                <label for="link">Link:</label>
                <input type="text" class="form-control" id="link" name="link" placeholder="What is the URL?">

            </div>

            @error('link')
            <p class="text-sm text-red-700">{{$message}}</p>
            @enderror

            <div class="form-group card-footer">
                <button class="btn btn-primary">Contribute Link</button>
            </div>
        </form>
    </div>
</div>
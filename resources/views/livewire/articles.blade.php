<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
  
    @if($updateMode)
        @include('livewire.article.update')
    @else
        @include('livewire.article.create')
    @endif

    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Image</th>
                <th width="150px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td>{{ $article->name }}</td>
                <td><img src="{{ asset('storage/' . $article->image) }}" style="width: 100px;" /></td>
                <td>
                <button wire:click="edit({{ $article->id }})" class="btn btn-primary btn-sm">Edit</button>
                    <button wire:click="delete({{ $article->id }})" class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

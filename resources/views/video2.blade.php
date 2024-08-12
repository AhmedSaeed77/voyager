@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

@if(isset($video))
    <video width="320" height="240" controls>
        <source src="{{ asset('storage/' . $video->video) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
@endif

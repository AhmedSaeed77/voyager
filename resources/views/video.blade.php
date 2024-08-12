<form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="video">Upload Video:</label>
        <input type="file" name="video" accept="video/*" required>
    </div>
    <button type="submit">Upload</button>
</form>

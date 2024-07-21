<!-- resources/views/dropzone/form.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropzone File Upload</title>
    <!-- Include Dropzone CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
</head>
<body>

    <h1>Dropzone File Upload</h1>

    <form action="{{ route('dropzone.upload') }}" method="post" class="dropzone" id="my-dropzone">
        @csrf
    </form>

    <script>
        // Dropzone configuration
        Dropzone.options.myDropzone = {
            maxFilesize: 2, // MB
            acceptedFiles: 'image/*', // Accept only images
            dictDefaultMessage: 'Drop your images here or click to upload',
            init: function() {
                this.on('success', function(file, response) {
                    console.log(response);
                });
            }
        };
    </script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <!-- Include any necessary CSS styles or frameworks -->
</head>
<body>

    <div class="container">
        <h2>Create a New Product</h2>

        <!-- Display validation errors -->
        <?php
            // Assuming you have validation errors stored in a variable $errors
            if (!empty($errors)) {
                echo '<div class="alert alert-danger"><ul>';
                foreach ($errors as $error) {
                    echo '<li>' . $error . '</li>';
                }
                echo '</ul></div>';
            }
        ?>

        <!-- Product creation form -->
        <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo old('name'); ?>" required>
            </div>

            <div class="form-group">
                <label for="price">Product Price</label>
                <input type="file" name="images[]" id="price" class="form-control" value="<?php echo old('price'); ?>" required multiple>
            </div>

            <button type="submit" class="btn btn-primary">Create Product</button>
        </form>
    </div>

    <!-- Include any necessary JavaScript scripts or frameworks -->

</body>
</html>
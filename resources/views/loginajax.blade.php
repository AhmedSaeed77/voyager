<!-- resources/views/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login without Refresh</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div id="login-form">
        <label for="email">Email:</label>
        <input class="form-control" type="email" id="email" name="email">
        
        <label for="password">Password:</label>
        <input class="form-control" type="password" id="password" name="password">
        
        <button onclick="login()">Login</button>
    </div>

    <div id="result"></div>

    <script>
        // public/js/script.js
        function login() {
            var email = $('#email').val();
            var password = $('#password').val();

            // Make an AJAX request
            $.ajax({
                type: 'POST',
                url: '/loginajax',
                data: {
                    email: email,
                    password: password,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    // Add any additional data you need for authentication
                },
                success: function(response) {
                    // Handle the response from the server
                    $('#result').html(response.message);
                    if (response.success) {
                        // Redirect the user after a successful login
                        window.location.href = '/article';
                    }
                },
                error: function(error) {
                    // Handle errors, e.g., display an error message
                    console.error('Error:', error);
                }
            });
        }
    </script>
</body>
</html>
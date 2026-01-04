<!DOCTYPE html>
<html>

<head>
    <title>Good People Hotel</title>
    <link rel="stylesheet" href="../assets/css/bootstrap 5.1.0.css">
</head>

<body>
    <div>
    <form name="frmlogin" method="POST" action="../../backend/login/login.php">
        <input type="email" name="email" required  placeholder="Email">
        <input type="password" name="password" required placeholder="password">
        <span>
            <input type="checkbox" onclick="togglePassword()"> show password
        </span>
        <button type="submit">Login</button>
        <p>Do you have an account?<a href="../register/register.php">Sign Up</a></p>
        <p>Do you have an account?<a href="../login/admin.php">admin</a></p>
    </form>
    </div>
</body>
<script>
    function togglePassword() {
        const pass = document.querySelector('input[name="password"]')

        if (pass.type === "password") {
            pass.type = "text";
        } else {
            pass.type = "password";
        }
    }
</script>

</html>
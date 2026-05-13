<?php
session_start();
include 'db.php';

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn,

    "SELECT * FROM users
    WHERE username='$username'
    AND password='$password'");

    if(mysqli_num_rows($query) > 0){

        $_SESSION['username'] = $username;

        header("Location:index.php");
    }
    else{

        echo "<script>
                alert('Invalid Username or Password');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background: linear-gradient(135deg, #eaf0ff, #ffffff);
            font-family: Arial, sans-serif;
        }

        .login-card{
            border: none;
            border-radius: 18px;
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(10px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.10);
            padding: 30px;
        }

        h2{
            font-weight: 700;
            color: #1f2a44;
        }

        .form-control{
            border-radius: 10px;
            padding: 10px;
        }

        .form-control:focus{
            box-shadow: 0 0 0 3px rgba(79,124,255,0.2);
            border-color: #4f7cff;
        }

        .btn-primary{
            background: #4f7cff;
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-weight: 600;
        }

        .btn-primary:hover{
            background: #3a66e6;
        }

    </style>

</head>

<body>

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">

    <div class="col-md-4">

        <div class="login-card">

            <h2 class="text-center mb-4">
                Login
            </h2>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" name="login" class="btn btn-primary w-100">
                    Login
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>
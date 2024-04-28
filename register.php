<?php
require 'function.php';

if (isset($_POST['Register'])) {
    $user = $_POST['user'];
    $pass = $_POST['password'];
    $pass2 = $_POST['password2'];

    $sql = mysqli_query($link, "SELECT username FROM user WHERE username = '$user'");


    while ($res = mysqli_fetch_assoc($sql)) {
        echo "<script>alert('Username sudah terdaftar')</script>";
        return false;
    }

    if ($pass !== $pass2) {
        echo "<script>alert('password tidak sama');</script>";
        return false;
    } else {
        register($user, $pass);
    };
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            content: ['./src/**/*.{html,js,php}'],
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    }
                }
            }
        }
    </script>
    <title>SimplyCRUD</title>
</head>

<body>
    <div class="justify-center flex items-center min-h-screen p-4">

        <form action="" method="post" class="container mx-auto w-10/12 border-2 p-2 lg:w-5/12 md:w-8/12 sm:m-8 rounded-lg">
        <p class="font-bold mt-10 mb-5 text-center text-3xl rounded">REGISTER</p>
            <p class="font-bold mt-2 mb-5 text-grey-500 text-center text-xl italic font-light rounded">SimplyCRUD</p>
            <div class="ml-10 p-2">
                <label for="user" class="font-semibold">Username</label>
                <br />
                <input placeholder="Username here !!!" id="user" type="text" name="user" class="border p-2 w-11/12 rounded-lg" required/>
            </div>
            <div class="ml-10 p-2">
                <label for="password" class="font-semibold">Password</label>
                <br />
                <input placeholder="Password here !!!" id="password" type="password" name="password" class="border p-2 w-11/12 rounded-lg" required/>
            </div>
            <div class="ml-10 p-2">
                <label for="password2" class="font-semibold">Retype Password</label>
                <br />
                <input placeholder="Confirm Password here !!!" id="password2" type="password" name="password2" class="border p-2 w-11/12 rounded-lg" required />
            </div>
            <div class="flex justify-center">
                <input name="Register" type="submit" value="Register" class="m-2 p-2 bg-blue-500 text-white rounded-lg w-10/12 lg:w-8/12 md:w-8/12 sm:w" />
            </div>
            <div class="flex justify-center">
                <label>Sudah terdaftar ?</label>
                <a href="./index.php" class="text-orange-500">Login</a>
            </div>
        </form>
    </div>
</body>

</html>
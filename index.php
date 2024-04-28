<?php
session_start();
require 'function.php';


if (isset($_POST['Login'])) {
    login($_POST['user'], $_POST['password']);
    $_SESSION['isLoggin'] = true;
};
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
    <title>Login Page</title>
</head>

<body>
    <?php if (isset($error)) :  ?>
        <p class="text-red-500 text-2xl">password yang anda masukkan salah</p>
    <?php endif ?>
    <div class="justify-center flex items-center min-h-screen p-4">

        <form action="" method="post" class="container mx-auto w-10/12 border-2 p-2 lg:w-5/12 md:w-8/12 sm:m-8 rounded-lg">
            <p class="font-bold mt-10 mb-5 text-center text-3xl rounded">LOGIN</p>
            <p class="font-bold mt-2 mb-5 text-grey-500 text-center text-xl italic font-light rounded">SimplyCRUD</p>
            <div class="ml-10 p-2">
                <label for="user" class="font-semibold">Username</label>
                <br />
                <input placeholder="Username here !!!" id="user" type="text" name="user" class="border p-2 w-11/12 rounded-lg" required/>
            </div>
            <div class="ml-10 p-2">
                <label for="password" class="font-semibold">Password</label>
                <br />
                <input placeholder="Password here !!!" id="password" type="password" name="password" class="border p-2 w-11/12 rounded-lg" required />
            </div>
            <div class="flex justify-center">
                <input name="Login" type="submit" value="Login" class="m-2 p-2 bg-blue-500 text-white rounded-lg w-10/12 lg:w-8/12 md:w-8/12 sm:w" />
            </div>
            <div class="flex justify-center">
                <label>Belum terdaftar ?</label>
                <a href="./register.php" class="text-orange-500">Register</a>
            </div>
        </form>
    </div>
</body>

</html>
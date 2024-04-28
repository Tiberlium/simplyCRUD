<?php
require 'function.php';
session_start();
if (!isset($_SESSION['isLoggin'])) {
    header("location:index.php");
    return false;
}

$prod = get("SELECT * FROM product LIMIT $awalData,$jumlahDataPerHalaman");

if (isset($_POST['logout'])) {
    header("location:index.php");
    session_destroy();
    session_unset();
    $_SESSION = [];
    setcookie('login', 'true', time() - 3600);
}

if (isset($_POST['tambah'])) {
    header("Location:insert.php");
    exit;
}

if (isset($_POST['searchbtn'])) {
    $key = $_POST['search'];
    $prod = search($key);
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

    <form action="" method="post">
        <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600 sticky">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <p class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">SimplyCRUD</p>
                <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                    <input name="logout" value="logout" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800  sm:flex sm:justify-end"><a href="./logout.php"></a>Logout</input>
                </div>
            </div>
        </nav>

        <!-- bar pencarian-->

        <div class=" lg:w-1/3 md:w-3/5 sm:w-2/5 mx-auto mt-10">
            <label for="default-search" class="text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColo
                        r" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" name="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Product Name......" />
                <button type="submit" name="searchbtn" value="searchbtn" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </div>

        <!--Tombol penambahan data-->
        <div class="xl:ml-48 lg:ml-32 md:ml-24 sm:ml-16">
            <button type="submit" name="tambah" value="tambah" class="text-white mt-10 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Add data</button>
        </div>

        <!-- Table data-->
        <div class="flex justify-center">


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg  lg:w-9/12 md:w-9/12 sm:w-10/12">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Product name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Color
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Category
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3 text-right">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($prod as $res) : ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?= $res['product_name'] ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?= $res['color'] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $res['category'] ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $res['price'] ?>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="./update.php?id=<?= $res['id'] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> | <a href="./delete.php?id=<?= $res['id'] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>

        <!--pagination-->
        <nav aria-label="Page navigation example" class="flex justify-center mt-2">

            <ul class="inline-flex -space-x-px text-base h-10">
                <li>
                    <a href="#" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                    <li>
                        <a href="./dashboard.php?page=<?= $i ?>" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"> <?= $i ?> </a>
                    </li>
                <?php endfor; ?>
                <li>
                    <a href="#" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                </li>
            </ul>
        </nav>

    </form>

</body>

</html>
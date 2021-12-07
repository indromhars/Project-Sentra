<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <nav style="padding: 15px;border-bottom: 2px solid #333;margin-bottom: 1rem;text-align:center;">
        <?php if(isUser()) { ?>
            <a href="index.php?page=home" class="text-blue-600 px-4 font-bold">Home</a>
            <a href="index.php?page=profile" class="text-blue-600 px-4 font-bold">Profile</a>
            <a href="index.php?page=blog-form" class="text-blue-600 px-4 font-bold">Make a Blog</a>
            <a href="index.php?page=blog-history" class="text-blue-600 px-4 font-bold">Your Blogs</a>
            <a href="index.php?page=logout" class="text-blue-600 px-4 font-bold">Logout</a>
        <?php } else {?>
            <a href="index.php?page=user-form" class="text-blue-600 px-4 font-bold">Sign Up</a>
            <a href="index.php?page=login" class="text-blue-600 px-4 font-bold">Login</a>
        <?php } ?>
    </nav>
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : null;
    $file = "pages/{$page}.php";

    if (!empty($page) && file_exists($file)) {
        require $file;
    } else {
        require 'home.php';
    }
    ?>
</body>
</html>

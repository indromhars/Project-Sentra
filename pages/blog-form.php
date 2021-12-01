<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $blogtitle = cleanInput($_POST['blogtitle']);
    $blog = cleanInput($_POST['blog']);

    $query = "insert into blogs (blogtitle, blog) values (?, ?)";
    $parameters = [$blogtitle, $blog];
    $ex = runQuery($query, $parameters);

    if ($ex) {
        $_SESSION['success_form'] = true;
    } else {
        $_SESSION['failed_form'] = true;
    }
}
?>

<form action="index.php?page=blog-form" method="POST" class="mx-auto shadow-md rounded mt-8 p-8 w-1/2">
    <div class="w-full">
        <label class="font-bold block">Title</label>
        <input type="text" name="blogtitle" placeholder="Content Title..." class="border p-2 mt-2 w-full" required>
    </div>

    <div class="w-full mt-2">
        <label class="font-bold block">Content</label>
        <textarea name="blog" placeholder="Content..." class="border rounded-md p-2 mt-2 w-full" cols="30" rows="10"></textarea>
    </div>

    <button type="submit" class="bg-blue-600 font-bold text-white p-4 rounded mt-8 w-full">Submit</button>

    <?php if (isset($_SESSION['success_form'])) { ?>
        <div class="w-full border text-white text-center p-8 rounded text-green-600">
            Success
        </div>
    <?php } ?>

    <?php if (isset($_SESSION['failed_form'])) { ?>
        <div class="w-full border text-white text-center p-8 rounded text-red-700">
            Failed
        </div>
    <?php } ?>
</form>

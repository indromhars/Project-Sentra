<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blogtitle = $_POST['blogtitle'];
    $blog = $_POST['blog'];
    $status = $_POST['status'];

    if (isset($_GET['id'])) {
        $query = "update blogs set blogtitle=:blogtitle, blog=:blog, status=:status where id=:id";
        $parameters = [
            ':blogtitle' => $blogtitle,
            ':blog' => $blog,
            ':status' => $status,
            ':id' => $_GET['id']
        ];
        $ex = runQuery($query, $parameters);
    }

    if ($ex) {
        $_SESSION['success_form'] = true;
    } else {
        $_SESSION['failed_form'] = true;
    }
}


if(isset($_GET['id'])) {
    $data = runQuery("select blogtitle, blog, status from blogs where id=:id", ['id' => $_GET['id']]);
    $data = $data->fetchObject();
    $edit = true;
}

$queryID = isset($_GET['id']) ? '&id=' . cleanInput($_GET['id']) : '';

?>
<form action="index.php?page=blog-update<?= $queryID ?>" method="POST" class="mx-auto shadow-md rounded mt-8 p-8 w-1/2">
    <div class="w-full">
        <label class="font-bold block">Blog Title</label>
        <input type="text" name="blogtitle" placeholder="Blog Title" class="border p-2 mt-2 w-full"
               value="<?= isset($data->blogtitle) ? $data->blogtitle : ''; ?>" required>
    </div>

    <div class="w-full mt-2">
        <label class="font-bold block">Content</label>
        <textarea name="blog" placeholder="Content..." class="border rounded-md p-2 mt-2 w-full" cols="30" rows="10"  required><?= $data->blog ?></textarea>
    </div>

    <div class="w-full mt-2">
        <input type="checkbox" name="status" value="1" <?= $data->status == 1 ? 'checked' : ''; ?>>
        <label class="font-bold" for="">Publish</label>
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

<?php

unset($_SESSION['success_form']);
unset($_SESSION['failed_form']);

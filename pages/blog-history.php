<?php

if (!isUser()) {
    header("Location: index.php?page=home.php");
}

$user_id = $_SESSION['id'];
$blog_id = $_GET['id'];
$blog = runQuery("select blogs.*, users.username from blogs inner join users on blogs.user_id=users.id where blogs.user_id=$user_id");
$blog = $blog->fetchAll(PDO::FETCH_CLASS);

?>

<div class="w-1/2 mx-auto mt-8">
    <div class="flex w-full">
        <div class="text-2xl font-bold mb-8">Edit Blog</div>
    </div>

    <table class="w-full border border-collapse">
        <tr>
            <th class="p-2">Blog Title</th>
            <th class="p-2">Blog Content</th>
            <th class="p-2">Username</th>
        </tr>
        <?php foreach ($blog as $b){?>
            <tr>
                <td class="border p-2"><?= $b->blogtitle; ?></td>
                <td class="border p-2"><?= $b->blog; ?></td>
                <td class="border p-2"><?= $b->username; ?></td>
                <td class="border p-2">
                    <a href="index.php?page=blog-update&id=<?= $b->id ?>" class="mt-5 p-2 bg-purple-600 font-bold text-white rounded">Update</a>
                    <button class="p-2 text-red-700 font-bold" onclick="deleteData(<?= $b->id; ?>)">Delete</button>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<script>
    function deleteData(blogid) {
        if (confirm("Are you sure you want to delete your blog data?")) {
            window.location.href = "index.php?page=blog-delete&id=" + blogid;
        }
    }
</script>
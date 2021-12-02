<?php

if (!isUser()) {
    header("Location: index.php?page=home.php");
}

$user_id = $_SESSION['id'];
$user = runQuery("select * from users where id=$user_id");
$user = $user->fetchAll(PDO::FETCH_CLASS);

?>

<div class="w-1/2 mx-auto mt-8">
    <div class="flex w-full">
        <div class="text-2xl font-bold mb-8">Edit Profile</div>
    </div>

    <table class="w-full border border-collapse">
        <tr>
            <th class="p-2">Username</th>
            <th class="p-2">Email</th>
<!--            <th class="p-2">Password</th>-->
        </tr>
        <?php foreach ($user as $u){?>
        <tr>
            <td class="border p-2"><?= $u->username; ?></td>
            <td class="border p-2"><?= $u->email; ?></td>
            <td class="border p-2">
                <a href="index.php?page=user-form&id=<?= $u->id; ?>" class="mt-5 p-2 bg-purple-600 font-bold text-white rounded">Update</a>
                <button class="p-2 text-red-700 font-bold" onclick="deleteData(<?= $u->id; ?>)">Delete</button>
            </td>
        </tr>
       <?php } ?>
    </table>
</div>

<script>
    function deleteData(id) {
        if (confirm("Are you sure you want to delete your data?")) {
            window.location.href = "index.php?page=user-delete&id=" + id;
        }
    }
</script>
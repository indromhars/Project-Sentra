<?php

$blog = runQuery("select blogs.*, users.username from blogs inner join users on blogs.user_id=users.id");
$blog = $blog->fetchAll(PDO::FETCH_CLASS);

?>

<div class="container mx-auto">
    <?php foreach ($blog as $b) { ?>
    <div class="shadow-md rounded-lg p-6 mb-4">
            <div class="mt-3 text-xl font-bold mb-2"><?= $b->blogtitle; ?></div>
            <div class="text-sm opacity-70"><?= $b->blog ?></div>
            <div class="mt-4">
                <span class="bg-gray-100 font-bold text-md p-2 rounded-md"><?= $b->username ?></span>
            </div>
    </div>
    <?php } ?>
</div>

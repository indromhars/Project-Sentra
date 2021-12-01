<?php
function cleanInput($input) {
    $input = htmlspecialchars($input);
    $input = strip_tags($input);
    $input = trim($input);

    return $input;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = cleanInput($_POST['username']);
    $email = cleanInput($_POST['email']);

    if (isset($_GET['id'])) {
        $query = "update users set username=:username, email=:email where id=:id";
        $parameters = [
            ':username' => $username,
            ':email' => $email,
            ':id' => $_GET['id']
        ];
        $ex = runQuery($query, $parameters);
    } else {
        $password = cleanInput($_POST['password']);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "insert into users (username, email, password) values (?, ?, ?)";
        $parameters = [$username, $email, $password];
        $ex = runQuery($query, $parameters);
    }

    if ($ex) {
        $_SESSION['success_form'] = true;
    } else {
        $_SESSION['failed_form'] = true;
    }
}

$edit = false;
if(isset($_GET['id'])) {
    $data = runQuery("select username, email from users where id=:id", ['id' => $_GET['id']]);
    $data = $data->fetchObject();
    $edit = true;
}

$queryID = isset($_GET['id']) ? '&id=' . $_GET['id'] : '';

?>

    <form action="index.php?page=user-form<?= $queryID ?>" method="POST" class="mx-auto shadow-md rounded mt-8 p-8 w-1/2">
        <div class="w-full">
            <label class="font-bold block">Username</label>
            <input type="text" name="username" placeholder="Username..." class="border p-2 mt-2 w-full"
                   value="<?= isset($data->username) ? $data->username : ''; ?>" required>
        </div>

        <div class="w-full mt-2">
            <label class="font-bold block">Email</label>
            <input type="text" name="email" placeholder="Email..." class="border p-2 mt-2 w-full"
                   value="<?=  isset($data->email) ? $data->email : ''; ?>" required>
        </div>

        <?php if (!$edit) { ?>
            <div class="w-full mt-2">
                <label class="font-bold block">Password</label>
                <input type="password" name="password" placeholder="Password..." class="border p-2 mt-2 w-full" required>
            </div>
        <?php } ?>

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
?>
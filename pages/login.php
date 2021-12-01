<?php
$passwordWrong = false;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "select * from users where username=:username";
    $user = runQuery($query, [':username' => $username]);
    $user = $user->fetchObject();

    if($user && password_verify($password, $user->password)){
        $_SESSION['id'] = $user->id;
        $_SESSION['username'] = $username->username;
        $_SESSION['email'] = $user->email;

        header("Location: index.php?page=home");
    } else{
        $passwordWrong = true;
    }
}
?>

<form action="index.php?page=login" method="POST" class="mx-auto shadow-md rounded mt-8 p-8 w-1/2">
    <div class="w-full">
        <label class="font-bold block">Username</label>
        <input type="text" name="username" placeholder="Username..." class="border p-2 mt-2 w-full"
               value="<?= isset($data->username) ? $data->username : ''; ?>">
    </div>

    <div class="w-full mt-2">
        <label class="font-bold block">Password</label>
        <input type="password" name="password" placeholder="Password..." class="border p-2 mt-2 w-full">
    </div>

    <button type="submit" class="bg-blue-600 font-bold text-white p-4 rounded mt-8 w-full">Submit</button>

    <?php if($passwordWrong) { ?>
        <div class="py-6 text-red-600">
            Username Or Password is wrong
        </div>
    <?php } ?>
</form>

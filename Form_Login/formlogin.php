<?php
session_start();
require "../Functions/functions.php";

// cek apakah user sudah login, jika ya kembalikan kehalamanan dashboard
if (isset($_SESSION["Login"])) {
  header("Location: dashboard.php");
  exit;
}



if (isset($_POST["login"])) {

  $username = $_POST["username"];
  $password = $_POST["password"];

  if (empty($username) || empty($password)) {
    $error = "Username / Password harus diisi!";
  } else {
    // cek apakah username ada didalam database dengan inputan
    $result = mysqli_query($conn, "SELECT * FROM db_registrasi WHERE username = '$username'");

    // cek username untuk menghitung ada berapa baris yang dikembalikan dari fungsi select
    if (mysqli_num_rows($result) === 1) {

      // cek password
      $row = mysqli_fetch_assoc($result);
      if (password_verify($password, $row["password"])) {
        // set session
        $_SESSION["id"] = $row["id"];
        $_SESSION["Login"] = true;
        $_SESSION["Level"] = $row["level"];

        header("Location: dashboard.php");
        exit;
      }
    } else {
      $error = "Username / Password salah!";
    }
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>INSTALASI GIZI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    body {
      background: #e9eef7;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      margin-top: 100px;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .container h2,
    .container h3 {
      text-align: center;
      margin-bottom: 5px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .btn-primary {
      width: 100%;
      border-radius: 4px;
      border: none;
      background-color: #ff425f;
      box-shadow: 0px 0px 0px 0px rgba(34, 36, 38, 0.15) inset, 0px -0.4em 0px 0px rgba(34, 36, 38, 0.15) inset;
    }

    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary:active {
      background-color: #de2c48 !important;
      box-shadow: none;
    }

    .btn-secondary {
      width: 100%;
    }
    .footer {
      position: fixed;
      left: 0;
      bottom: 0;
      width: 100%;
      background-color: lightblue;
      color: black;
      text-align: center;
    }
  </style>
</head>

<body>
  <form action="" method="post">

    <div class="container">
      <h3 class="text-center">APLIKASI</h2>
        <h4 class="text-center">INSTALASI GIZI
      </h3>
      <h4 class="text-center">RSUD H. BARADUDDIN KASIM</h3>
        <hr />

        <!-- Jika ada error, tampilkan pesan kesalahan -->
        <?php if (isset($error)) : ?>
          <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" class="form-control" />
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" class="form-control" />
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary" name="login">Login</button>
          <br>
          <a href="registrasi.php" class="btn btn-secondary mt-3">Buat Akun</a>
        </div>
    </div>
  </form>

  <div class="footer">
      <p><?= $Credit ?></p>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
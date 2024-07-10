<?php
session_start();
require "../Functions/functions.php";

if (isset($_POST["register"])) {

  if (registrasi($_POST) > 0) {
    echo "<script>
                alert('user baru berhasil ditambahkan!');
            </script>";
  } else {
    echo mysqli_error($conn);
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Registrasi</title>
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
  <!--Navbar bootstrap 5-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page">SISFO INSTALASI GIZI</a>
        </li>
      </ul>
  </nav>

  <form action="" method="post">

    <div class="container">
      <h3 class="text-center">Halaman Registrasi</h3>
      <p>Silahkan masukkan data sebagai berikut :</p>
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
        <label for="level">Level</label>
        <select name="level" id="level" class="form-select">
          <option selected>Klik Disini</option>
          <option value="1">Admin</option>
          <option value="2">Super_Admin</option>
        </select>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control" />
      </div>

      <div class="form-group">
        <label for="password1">Konfirmasi Password</label>
        <input type="password" id="password1" name="password1" class="form-control" />
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary" name="register">Register</button>
        <br>
        <a href="formlogin.php" class="btn btn-secondary mt-3">Login</a>
      </div>
    </div>
  </form>
  <div class="footer">
      <p><?= $Credit ?></p>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
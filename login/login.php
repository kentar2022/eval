<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
  <style>
    .container {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    .title {
      background-color: #434B4D;
      color: #fff;
      padding: 20px;
      margin: 0px;
      text-align: center;
    }
    .card {
      width: 300px;
    }
  </style>
</head>
<body>
  <div class="title">
    <h1>Admin</h1>
  </div>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Entrer</h5>
        <form method="post" action="login_handler.php">
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <button type="submit" class="btn btn-primary">Entrer</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
  <style>
    .container {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    .title {
      background-color: #434B4D;
      color: #fff;
      padding: 20px;
      margin: 0px;
      text-align: center;
    }
    .card {
      width: 300px;
    }
  </style>
</head>
<body>
  <div class="title">
    <h1>Admin</h1>
  </div>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Entrer</h5>
        <form method="post" action="login_handler.php">
          <?php
          session_start();
          if (empty($_SESSION['csrf_token'])) {
              $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
          }
          ?>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <button type="submit" class="btn btn-primary">Entrer</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Responsive Login Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #ffe4ec, #d4f0ff);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-card {
      background: #fffafc;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(255, 182, 193, 0.2);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .login-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 25px rgba(255, 182, 193, 0.4);
    }

    h3 {
      font-weight: bold;
      color: #ff6fa5;
    }

    .form-control {
      border-radius: 15px;
      border: 1px solid #ffc0cb;
    }

    .form-control:focus {
      border-color: #ff6fa5;
      box-shadow: 0 0 0 0.25rem rgba(255, 182, 193, 0.25);
    }

    .btn-primary {
      background-color: #ff9eb5;
      border: none;
      border-radius: 15px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #ff6fa5;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="row justify-content-center align-items-center vh-100">
      <div class="col-md-6 col-lg-5 col-xl-4">
        <div class="p-4 p-md-5 login-card">
          <h3 class="text-center mb-4">🎀 Login 🎀</h3>
          <form action="check_login.php" method="POST">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="username" placeholder="username" required>
              <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating mb-4">
              <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
              <label for="floatingPassword">Password</label>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-body">
      <h3 class="card-title">Welcome, <?= htmlspecialchars($name) ?> 🎉</h3>
      <p>You are logged in successfully.</p>
      <a href="<?= base_url('logout') ?>" class="btn btn-danger">Logout</a>
    </div>
  </div>
</div>
</body>
</html>

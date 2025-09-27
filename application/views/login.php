<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card { margin-top: 40px; }
  </style>
</head>
<body>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="card-title">Login</h4>

          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
          <?php endif; ?>
          <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
          <?php endif; ?>

          <?= form_open('login/submit'); ?>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" value="<?= set_value('email') ?>" class="form-control" id="email">
              <?= form_error('email','<small class="text-danger">','</small>') ?>
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" id="password">
              <?= form_error('password','<small class="text-danger">','</small>') ?>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
          <?= form_close(); ?>

          <p class="mt-3 mb-0">Don't have an account? <a href="<?= base_url('register') ?>">Register here</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>

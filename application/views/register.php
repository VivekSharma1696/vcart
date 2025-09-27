<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    .card { margin-top: 40px; }
  </style>
</head>
<body>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="card-title">Register</h4>

          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
          <?php endif; ?>
          <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
          <?php endif; ?>

          <?php echo form_open('register/submit'); ?>

            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" value="<?= set_value('name') ?>" class="form-control" id="name">
              <?= form_error('name','<small class="text-danger">','</small>') ?>
            </div>

            <div class="form-group">
              <label for="dob">Date of Birth</label>
              <input type="date" name="dob" value="<?= set_value('dob') ?>" class="form-control" id="dob">
              <?= form_error('dob','<small class="text-danger">','</small>') ?>
            </div>

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

            <div class="form-group">
              <label for="country">Country</label>
              <select name="country" id="country" class="form-control">
                <option value="">-- Select Country --</option>
                <?php foreach($countries as $c): ?>
                  <option value="<?= $c->id ?>" <?= set_select('country', $c->id) ?>><?= htmlspecialchars($c->name) ?></option>
                <?php endforeach; ?>
              </select>
              <?= form_error('country','<small class="text-danger">','</small>') ?>
            </div>

            <div class="form-group">
              <label for="state">State</label>
              <select name="state" id="state" class="form-control">
                <option value="">-- Select State --</option>
                
              </select>
              <?= form_error('state','<small class="text-danger">','</small>') ?>
            </div>

            <div class="form-group">
              <label for="city">City</label>
              <select name="city" id="city" class="form-control">
                <option value="">-- Select City --</option>
               
              </select>
              <?= form_error('city','<small class="text-danger">','</small>') ?>
            </div>

            <button class="btn btn-primary" type="submit">Register</button>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  $('#country').on('change', function(){
    var countryId = $(this).val();
    $('#state').html('<option>Loading...</option>');
    $('#city').html('<option value="">-- Select City --</option>');
    if (!countryId) {
      $('#state').html('<option value="">-- Select State --</option>');
      return;
    }
    $.getJSON('<?= base_url("register/states/") ?>' + countryId, function(data){
      var html = '<option value="">-- Select State --</option>';
      $.each(data, function(i, item){ 
        html += '<option value="'+item.id+'">'+item.name+'</option>';
      });
      $('#state').html(html);

      var oldState = '<?= set_value("state") ?>';
      if (oldState) $('#state').val(oldState).trigger('change');
    });
  });

  // on state change -> load cities
  $('#state').on('change', function(){
    var stateId = $(this).val();
    $('#city').html('<option>Loading...</option>');
    if (!stateId) {
      $('#city').html('<option value="">-- Select City --</option>');
      return;
    }
    $.getJSON('<?= base_url("register/cities/") ?>' + stateId, function(data){
      var html = '<option value="">-- Select City --</option>';
      $.each(data, function(i, item){
        html += '<option value="'+item.id+'">'+item.name+'</option>';
      });
      $('#city').html(html);
      var oldCity = '<?= set_value("city") ?>';
      if (oldCity) $('#city').val(oldCity);
    });
  });

  // If page loads with country pre-selected (validation error), trigger load
  var selectedCountry = $('#country').val();
  if (selectedCountry) {
    $('#country').trigger('change');
  }
});
</script>
</body>
</html>

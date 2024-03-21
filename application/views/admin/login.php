<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
      <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo" style="display: flex; justify-content:center">
              <img style="width:180px !important" src="<?= base_url('/assets/landing/img/logos/logo_26.png') ?>" alt="logo">
            </div>
            <form class="pt-3">
              <div class="form-group">
                <input type="email" class="form-control form-control-lg email" id="exampleInputEmail1" placeholder="Username">
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-lg password" id="exampleInputPassword1" placeholder="Password">
              </div>

              <div class="login_response"></div>
              <div class="mt-3">
                <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn w-100" href="#">SIGN IN</a>
              </div>
              <div class="my-2 d-flex justify-content-between align-items-center">
                <div class="form-check">
                  <label class="form-check-label text-muted">
                    <input type="checkbox" class="form-check-input remember_me">
                    Keep me signed in
                  </label>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>

<script>
  function _(el) {
    return document.querySelector(el);
  }

  _('.auth-form-btn').addEventListener("click", (event) => {
    submitForm();
  });


  function submitForm() {
    var formdata = new FormData();
    formdata.append("email", _(".email").value);
    formdata.append("password", _(".password").value);


    var ajax = new XMLHttpRequest();
    ajax.addEventListener("load", completeHandler, false);
    ajax.open("POST", "<?php echo base_url('/admin/ajax/login') ?>");
    ajax.send(formdata);
  }

  function completeHandler(event) {
    var reply = JSON.parse(event.target.responseText);


    if (reply.status) {
      _('.login_response').innerHTML = '<div class="alert alert-success" role="alert">' + reply.message + '</div>'
      if (_('.remember_me').checked) {
        localStorage.setItem("remember_me", true);
        localStorage.setItem("email", _(".email").value);
        localStorage.setItem("password", _(".password").value);
      }

      window.location.href = "<?php echo base_url('admin/page/ads') ?>";
    } else {
      _('.login_response').innerHTML = '<div class="alert alert-danger" role="alert">' + reply.message + '</div>'
    }
  }

  window.onload = (event) => {
    if (localStorage.getItem('remember_me')) {
      _(".email").value = localStorage.getItem('email')
      _(".password").value = localStorage.getItem('password')
      _(".password").value = localStorage.getItem('password')

      // var answer = confirm("Login Automatically?");

      // if (answer) {
      _('.auth-form-btn').click();
      // }
    }
  };
</script>
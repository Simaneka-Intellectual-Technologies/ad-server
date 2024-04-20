<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
      <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo" style="display: flex; justify-content:center">
              <img style="width:180px !important" src="<?= base_url('assets/admin/images/logos/logo_2.png') ?>" alt="logo">
            </div>
            <h4>Hello! we just need to make sure</h4>
            <h6 class="fw-light">Enter password to continue.</h6>
            <form class="pt-3">
              <div class="form-group">
                <input type="password" class="form-control form-control-lg password" id="exampleInputPassword1" placeholder="Password">
              </div>

              <div class="login_response"></div>
              <div class="mt-3">
                <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="#">VERIFY</a>
              </div>
              <input type="hidden" class="client_id" name="client_id" value="<?= $client_id ?>">
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
    formdata.append("password", _(".password").value);
    formdata.append("client_id", _(".client_id").value);


    var ajax = new XMLHttpRequest();
    ajax.addEventListener("load", completeHandler, false);
    ajax.open("POST", "<?php echo base_url('/admin/ajax/viewLogin') ?>");
    ajax.send(formdata);
  }

  function completeHandler(event) {
    var reply = JSON.parse(event.target.responseText);

    if (reply.status) {
      _('.login_response').innerHTML = '<div class="alert alert-success" role="alert">' + reply.message + '</div>'

      window.location.href = "<?php echo base_url('admin/page/recordView/client/') ?>" +  _(".client_id").value;
    } else {
      _('.login_response').innerHTML = '<div class="alert alert-danger" role="alert">' + reply.message + '</div>'
    }
  }
</script>
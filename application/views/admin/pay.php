<div class="content-wrapper">
  <div class="row">
    <div class="col-sm-12">
      <div class="home-tab">
        <div class="d-sm-flex align-items-center justify-content-between border-bottom">
          <div>
            <div class="btn-wrapper f-right">
              <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
              <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
              <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
            </div>
          </div>
        </div>
        <div class="tab-content tab-content-basic">
          <div class="row">
            <div class="card">
              <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <h1 class="card-title">Payment</h1>

                <?php if ($charge['charge_paid'] == 0) : ?>
                  <p class="card-description">
                    Charge payment for <?= $charge['charge_title'] ?> - <?= $charge['charge_client'] ?>
                  </p>
                  <div class="template-demo  d-flex flex-column align-items-center justify-content-center">
                    <h4>Buy clicking the button below you are confirming that a total of <span class="text-danger"> N$ <?= $charge['charge_cost'] ?></span> was <br><br> received from <span class="text-success"><?= $charge['charge_client'] ?></span> for the payment of <span class="text-info"><?= $charge['charge_title'] ?></span></h4>


                    <form action="<?= base_url('admin/action/charges/' . $charge['charge_id']) ?>" method="post">
                      <input type="number" class="form-control paymentAmount" name="amount" value="<?= $charge['charge_cost'] ?>">
                      <button type="submit" class="btn btn-primary btn-lg text-white p-3 mt-3 submitBtn w-100">
                        <i class="mdi mdi-currency-usd"></i>
                        Confirm
                      </button>
                    </form>
                  </div>

                <?php else : ?>
                  <p class="card-description">
                    Charge payment for <?= $charge['charge_title'] ?> - <?= $charge['charge_client'] ?> is already paid for
                  </p>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  window.addEventListener('load', () => {
    var paymentAmount = document.querySelector('.paymentAmount')
    var submitBtn = document.querySelector('.submitBtn')

    paymentAmount.addEventListener('blur', () => {
      if (paymentAmount.value != '') {
        submitBtn.classList.remove('d-none')
      }
      if (paymentAmount.value == '') {
        submitBtn.classList.add('d-none')
      }
    })

  })
</script>
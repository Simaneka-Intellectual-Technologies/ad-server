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
            <div class="col-lg-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Records for
                    <?= $client[0]['client_name'] ?>
                  </h4>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Client</th>
                          <th>Cost</th>
                          <th>Date</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($charges as $charge): ?>
                          <tr style="border-top-width: 2px; border-top-color: #03989E;">
                            <td>
                              <?= $charge['charge_title'] ?>
                            </td>
                            <td>
                              <?= $charge['charge_client'] ?>
                            </td>
                            <td class="text-danger">N$
                              <?= $charge['charge_cost'] ?> <i class="ti-arrow-up"></i>
                            </td>
                            <td>
                              <?= $charge['charged_on'] ?>
                            </td>
                            <td><label class="badge badge-danger">
                                <?= ($charge['charge_paid'] == 0) ? '<a class="text-decoration-none text-danger" href="' . base_url('admin/page/pay/charges/' . $charge['charge_id']) . '">Unpaid</a>' : 'Paid' ?>
                              </label></td>
                          </tr>
                          <?php foreach ($payments as $payment): ?>
                            <?php if ($charge['charge_reference'] == $payment['payment_reference']): ?>
                              <tr>
                                <td>
                                  <?= $payment['payment_for'] ?>
                                </td>
                                <td>
                                  <?= $payment['payment_client_id'] ?>
                                </td>
                                <td class="text-success">N$
                                  <?= $payment['payment_price'] ?> <i class="ti-arrow-down"></i>
                                </td>
                                <td>
                                  <?= $payment['payment_date'] ?>
                                </td>
                                <td><label class="badge badge-success">Paid</label></td>
                              </tr>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 d-flex flex-column">
              <div class="row flex-grow">
                <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                  <div class="card bg-primary card-rounded">
                    <div class="card-body pb-0">
                      <h4 class="card-title card-title-dash text-white mb-4">Account Summary</h4>
                      <div class="row">
                        <div class="col-sm-4">
                          <p class="status-summary-ight-white mb-1">Outstanding Balance</p>
                          <h2 class="text-info">N$
                            <?= $outstanding_amount ?>
                          </h2>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                  <div class="card card-rounded">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                            <div class="circle-progress-width">
                              <div id="totalVisitors" class="progressbar-js-circle pr-2">
                                <div class="progressbar-text"
                                  style="position: absolute; left: 50%; top: 50%; padding: 0px; margin: 0px; transform: translate(-50%, -50%); color: rgb(255, 255, 255); font-size: 0rem;">
                                  <?= $percentage_paid ?>
                                </div>
                              </div>
                            </div>
                            <div>
                              <p class="text-small mb-2">Percentage Paid</p>
                              <h4 class="mb-0 fw-bold">
                                <?= $percentage_paid ?>%
                              </h4>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="circle-progress-width">
                              <div id="visitperday" class="progressbar-js-circle pr-2">
                                <div class="progressbar-text"
                                  style="position: absolute; left: 50%; top: 50%; padding: 0px; margin: 0px; transform: translate(-50%, -50%); color: rgb(255, 255, 255); font-size: 0rem;">
                                  <?= $percentage_remaining ?>
                                </div>
                              </div>
                            </div>
                            <div>
                              <p class="text-small mb-2">Percentage Remaining</p>
                              <h4 class="mb-0 fw-bold">
                                <?= $percentage_remaining ?>%
                              </h4>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
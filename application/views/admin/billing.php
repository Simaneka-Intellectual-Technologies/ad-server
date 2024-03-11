<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <div>
                        <div class="btn-wrapper f-right">
                            <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i>
                                Share</a>
                            <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                            <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
                        </div>
                    </div>
                </div>
                <div class="tab-content tab-content-basic">

                    <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                        <div>
                                            <h4 class="card-title card-title-dash">Billing</h4>
                                            <p class="card-subtitle card-subtitle-dash">Here is a list of the recurring
                                                payments</p>
                                        </div>
                                        <div>
                                            <a href="<?= base_url('admin/page/create/billing/create') ?>"
                                                class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i
                                                    class="mdi mdi-account-plus"></i>Add Recurring Payment</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="bullet-line-list">
                                        <?php foreach ($billing as $bill): ?>
                                            <li>
                                                <div class="d-flex justify-content-between">
                                                    <div><span
                                                            class="text-light-<?= $bill['status'] ? 'green' : 'yellow' ?>"><a
                                                                href="<?= base_url('admin/page/create/billing/' . $bill['billing_id']) ?>"
                                                                class="text-decoration-none">
                                                                <?= ucfirst($bill['billing_frequency']) . ' ' . $bill['billing_title'] ?>
                                                            </a></span> bill for
                                                        <?= $bill['billing_client_company'] ?>
                                                    </div>
                                                    <p>N$
                                                        <?= $bill['billing_cost'] ?>
                                                    </p>
                                                </div>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                    <div class="list align-items-center pt-3">

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
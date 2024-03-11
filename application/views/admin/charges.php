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
                                            <h4 class="card-title card-title-dash">Charges</h4>
                                            <p class="card-subtitle card-subtitle-dash">Here is a list of the charges
                                                made to charges</p>
                                        </div>
                                        <div>
                                            <a href="<?= base_url('admin/page/create/client/create') ?>"
                                                class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i
                                                    class="mdi mdi-account-plus"></i>Add Charge</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="table-responsive  mt-1">
                                        <table class="table select-table">
                                            <thead>
                                                <tr>
                                                    <th>Charge</th>
                                                    <th>Cost of</th>
                                                    <th>Charged On</th>
                                                    <th>Paid</th>
                                                    <th>Reference</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($charges as $charges): ?>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex ">
                                                                <div>
                                                                    <h6>
                                                                        <?= $charges['charge_title'] ?>
                                                                    </h6>
                                                                    <p>
                                                                        <?= $charges['charge_client'] ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="text-success">
                                                                <?= $charges['charge_cost'] ?>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p class="text-success">
                                                                <?= $charges['charged_on'] ?>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <?= ($charges['charge_paid'] == 1) ? '<p class="text-success">Paid</p>' : '<p class="text-danger">Unoaid</p>' ?>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                                                    <a class="text-decoration-none text-primary" href="#">
                                                                        <?= $charges['charge_reference'] ?>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a
                                                                href="<?= base_url('admin/page/create/charge/' . $charges['charge_id']) ?>">
                                                                <div class="badge badge-opacity-success">Edit</div>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a
                                                                href="<?= base_url('admin/action/delete/charge/' . $charges['charge_id']) ?>">
                                                                <div class="badge badge-opacity-danger">Delete</div>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
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
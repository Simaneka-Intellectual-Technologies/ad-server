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

                    <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                        <div>
                                            <h4 class="card-title card-title-dash">Advertisments</h4>
                                            <p class="card-subtitle card-subtitle-dash">Here is a list of the ads</p>
                                        </div>
                                        <div>
                                            <a href="<?= base_url('admin/page/create/ad/create') ?>" class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>Add Advertisment</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="table-responsive  mt-1">
                                        <table class="table select-table">
                                            <thead>
                                                <tr>
                                                    <th>Ad</th>
                                                    <th>Status</th>
                                                    <th>Start Date</th>
                                                    <th>Duration</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($ads as $ad) : ?>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex ">
                                                                <img src="<?= ($ad['file'] != '') ? base_url('assets/'. $ad['file']) : base_url('/assets/landing/img/logos/logo_23.png') ?>" alt="<?= $ad['title'] . 'Logo' ?>">
                                                                <div>
                                                                    <h6><?= $ad['title'] ?></h6>
                                                                    <p><?= $ad['alt'] ?></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <?= ($ad['status'] == 1) ? '<p class="text-success">Active</p>' : '<p class="text-danger">Inactive</p>' ?>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <h6><?= $ad['clicks'] . ' Clicks'?> </h6>
                                                                <p><?= $ad['impressions'] . ' Impressions'?></p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="#">
                                                                <div class="badge badge-opacity-success"><?= $ad['start_date'] ?></div>
                                                                <div class="badge badge-opacity-warning"><?= $ad['end_date'] ?></div>
                                                            </a>
                                                            
                                                        </td>
                                                        <td>
                                                            <a href="<?= base_url('admin/page/create/ad/' . $ad['ad_id']) ?>">
                                                                <div class="badge badge-opacity-success">Edit</div>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="<?= base_url('admin/action/delete/ad/' . $ad['ad_id']) ?>">
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
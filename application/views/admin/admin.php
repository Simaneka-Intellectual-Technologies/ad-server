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
                                            <h4 class="card-title card-title-dash">Users</h4>
                                            <p class="card-subtitle card-subtitle-dash">Here is a list of the users</p>
                                        </div>
                                        <div>
                                            <a href="<?= base_url('admin/page/create/user/create') ?>" class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>Add User</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive  mt-1">
                                        <table class="table select-table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Contact Details</th>
                                                    <th>Last Login</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($admin as $user) : ?>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex ">
                                                                <img src="<?= ($this->session->userdata('image') != '') ? $this->session->userdata('image') : base_url('/assets/admin/uploads/images/users/user.png') ?> ?>" alt="">
                                                                <div>
                                                                    <h6><a href="<?= base_url('admin/page/create/user/' . $user['user_id']) ?>"><?= $user['name'] . ' ' . $user['surname'] ?></a> </h6>
                                                                    <p><?= ($user['type'] == 1) ? 'Admin' : 'Viewer' ?></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h6><a class="text-decoration-none" href="mailto:<?= $user['email'] ?>"><?= $user['email'] ?></a></h6>
                                                            <p><a class="text-decoration-none" href="tel:<?= $user['cell'] ?>"><?= $user['cell'] ?></a></p>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                                                    <p class="text-success"><?= $user['last_login'] ?></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="badge badge-opacity-warning"><?= ($user['status'] == 1) ? 'Active' : 'Inactive' ?></div>
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
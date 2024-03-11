<form class="forms-sample p-3" action="<?= base_url('admin/action/create/user') ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?= isset($user['user_id']) ? $user['user_id'] : '' ?>">
    <div class="row">
        <?php if (isset($user['user_id'])) : ?>
            <div class="col-md-12">
                <div class="form-group row">
                    <div class="form-check col-md-2">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" value="1" <?= ($user['status'] == 1) ? 'checked' : '' ?>>
                            Active
                            <i class="input-helper"></i></label>
                    </div>
                    <div class="form-check col-md-6">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" value="0" <?= ($user['status'] == 0) ? 'checked' : '' ?>>
                            Inactive
                            <i class="input-helper"></i></label>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="text" name="name" class="form-control" placeholder="Name" required="required" value="<?= isset($user['name']) ? $user['name'] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="text" name="surname" class="form-control" placeholder="Surname" required="required" value="<?= isset($user['surname']) ? $user['surname'] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="email" name="email" class="form-control" placeholder="Email Address" required="required" value="<?= isset($user['email']) ? $user['email'] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="number" name="cell" pattern="[0-9.]+" inputmode="numeric" class="form-control" placeholder="Cell" required="required" value="<?= isset($user['cell']) ? $user['cell'] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="text" name="password" class="form-control" placeholder="Password" required="required" value="<?= isset($user['password']) ? 'Edit To Change' : '' ?>">
                </div>
            </div>
        </div>
        <?php if (!isset($user['user_id'])) : ?>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-sm-9">
                        <input type="text" name="cpassword" class="form-control" placeholder="Confirm Password" required="required">
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <select name="type" class="form-control" id="exampleFormControlSelect1">
                        <option value="0" disabled>Status</option>
                        <option value="1" <?= (isset($user) && $user['type'] == 1) ? 'selected' : '' ?>>Admin</option>
                        <option value="0" <?= (isset($user) && $user['type'] == 0) ? 'selected' : '' ?>>Viewer</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="mt-3">
                    <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                        <div class="d-flex">
                            <img class="img-sm rounded-10" src="<?= isset($user['image']) ? $user['image'] : base_url('/assets/admin/uploads/images/users/user.png') ?>" alt="profile">
                            <div class="wrapper ms-3">
                                <p class="ms-1 mb-1 fw-bold"><?= isset($user['name']) ? $user['name'] . ' ' . $user['surname'] : '' ?> Profile Photo</p>
                                <input type="file" name="user_image" class="file-upload-default">
                                <small class="text-muted mb-0"><?= isset($user['image']) ? $user['image'] : base_url('/assets/admin/uploads/images/users/user.png') ?></small>
                            </div>
                        </div>
                        <div class="text-muted text-small">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary me-2 text-white">Submit</button>
    <button class="btn btn-light">Cancel</button>
</form>
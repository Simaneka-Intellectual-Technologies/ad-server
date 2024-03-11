<form class="forms-sample p-3" action="<?= base_url('admin/action/create/client') ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="client_id" value="<?= isset($client['client_id']) ? $client['client_id'] : '' ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="text" name="client_name" class="form-control" placeholder="Client Name" required="required" value="<?= isset($client['client_name']) ? $client['client_name'] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="email" name="client_email" class="form-control" placeholder="Client Email Address" required="required" value="<?= isset($client['client_email']) ? $client['client_email'] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="number" name="client_cell" pattern="[0-9.]+" inputmode="numeric" class="form-control" placeholder="Client Cell" required="required" value="<?= isset($client['client_cell']) ? $client['client_cell'] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="text" name="client_contactPerson" class="form-control" placeholder="Client Contact Person" required="required" value="<?= isset($client['client_contactPerson']) ? $client['client_contactPerson'] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <select name="client_status" class="form-control" id="exampleFormControlSelect1">
                        <option value="0" disabled>Status</option>
                        <option value="1" <?= (isset($client) && $client['client_status'] == 1) ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?= (isset($client) && $client['client_status'] == 0) ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="text" name="viewPassword" class="form-control" placeholder="Client View Password" required="required" value="<?= isset($client['viewPassword']) ? 'Edit To Password' : '' ?>">
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
                            <img class="img-sm rounded-10" src="<?= isset($client['client_logo']) ? $client['client_logo'] : base_url('/assets/admin/uploads/images/client_logos/logo.png') ?>" alt="profile">
                            <div class="wrapper ms-3">
                                <p class="ms-1 mb-1 fw-bold"><?= isset($client['client_name']) ? $client['client_name'] : '' ?> Logo</p>
                                <input type="file" name="client_logo" class="file-upload-default">
                                <small class="text-muted mb-0"><?= isset($client['client_logo']) ? $client['client_logo'] : base_url('/assets/admin/uploads/images/client_logos/logo.png') ?></small>
                            </div>
                        </div>
                        <div class="text-muted text-small">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary me-2 text-white">Submit</button>
        <button class="btn btn-light">Cancel</button>
    </div>
</form>
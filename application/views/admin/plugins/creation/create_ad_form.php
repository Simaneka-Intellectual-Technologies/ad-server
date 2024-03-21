<form class="forms-sample p-3" action="<?= base_url('admin/action/create/ad') ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="ad_id" value=" ">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="text" name="title" class="form-control" placeholder="Title" required="required" value="<?= isset($ad['title']) ? $ad['title'] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="text" name="alt" class="form-control" placeholder="Alternative Text" required="required" value="<?= isset($ad['alt']) ? $ad['alt'] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="date" name="start_date" class="form-control" placeholder="start_date" required="required" value="<?= isset($ad['start_date']) ? $ad['start_date'] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="date" name="end_date" class="form-control" placeholder="end_date" required="required" value="<?= isset($ad['end_date']) ? $ad['end_date'] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <div class="col-sm-11">
                    <textarea name="description" id="description" class="form-control" placeholder="Description" cols="30" rows="10"><?= isset($ad['description']) ? $ad['description'] : '' ?></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="text" name="redirect" class="form-control" placeholder="Redirect Link" required="required" value="<?= isset($ad['redirect']) ? $ad['redirect'] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <select name="type" id="type" class="form-control">
                        <option disabled value="0">Select Ad Type</option>
                        <?= $this->admin_model->get_select_options('types', 'name', 'type_id', isset($ad['type_id']) ? $ad['type_id'] : '') ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="number" name="ad_cell" pattern="[0-9.]+" inputmode="numeric" class="form-control" placeholder="ad Cell" required="required" value="<?= isset($ad['ad_cell']) ? $ad['ad_cell'] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="text" name="ad_contactPerson" class="form-control" placeholder="ad Contact Person" required="required" value="<?= isset($ad['ad_contactPerson']) ? $ad['ad_contactPerson'] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <select name="ad_status" class="form-control" id="exampleFormControlSelect1">
                        <option value="0" disabled>Status</option>
                        <option value="1" <?= (isset($ad) && $ad['ad_status'] == 1) ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?= (isset($ad) && $ad['ad_status'] == 0) ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="text" name="viewPassword" class="form-control" placeholder="ad View Password" required="required" value="<?= isset($ad['viewPassword']) ? 'Edit To Password' : '' ?>">
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
                            <img class="img-sm rounded-10" src="<?= isset($ad['ad_logo']) ? $ad['ad_logo'] : base_url('/assets/admin/uploads/images/ad_logos/logo.png') ?>" alt="profile">
                            <div class="wrapper ms-3">
                                <p class="ms-1 mb-1 fw-bold"><?= isset($ad['ad_name']) ? $ad['ad_name'] : '' ?> Logo</p>
                                <input type="file" name="ad_logo" class="file-upload-default">
                                <small class="text-muted mb-0"><?= isset($ad['ad_logo']) ? $ad['ad_logo'] : base_url('/assets/admin/uploads/images/ad_logos/logo.png') ?></small>
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
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="tab-content tab-content-basic row">

                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit Company</h4>
                                <p class="card-description">
                                    Company Details
                                </p>
                                <form class="forms-sample p-3" action="<?= base_url('admin/action/create/company') ?>"
                                    method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="comp_id"
                                        value="<?= isset($company['comp_id']) ? $company['comp_id'] : '' ?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <input type="text" name="title" class="form-control"
                                                        placeholder="Company Name" required="required"
                                                        value="<?= isset($company['title']) ? $company['title'] : '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="description" rows="5">
                                                        <?= isset($company['description']) ? $company['description'] : '' ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="physical_address" rows="5">
                                                        <?= isset($company['physical_address']) ? $company['physical_address'] : '' ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <input type="number" name="cell" class="form-control"
                                                        pattern="[0-9.]+" inputmode="numeric" placeholder="Company Cell"
                                                        required="required"
                                                        value="<?= isset($company['cell']) ? $company['cell'] : '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <input type="email" name="email" class="form-control"
                                                        placeholder="Company Email" required="required"
                                                        value="<?= isset($company['email']) ? $company['email'] : '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <input type="text" name="town" class="form-control"
                                                        placeholder="Town" required="required"
                                                        value="<?= isset($company['town']) ? $company['town'] : '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <input type="text" name="country" class="form-control"
                                                        placeholder="Country" required="required"
                                                        value="<?= isset($company['country']) ? $company['country'] : '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <input type="text" name="continent" class="form-control"
                                                        placeholder="Continent" required="required"
                                                        value="<?= isset($company['continent']) ? $company['continent'] : '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <input type="text" name="contact_person" class="form-control"
                                                        placeholder="Contact Person" required="required"
                                                        value="<?= isset($company['contact_person']) ? $company['contact_person'] : '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <input type="number" name="contact_person_cell" pattern="[0-9.]+"
                                                        inputmode="numeric" class="form-control"
                                                        placeholder="Contact Person Cell" required="required"
                                                        value="<?= isset($company['contact_person_cell']) ? $company['contact_person_cell'] : '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <input type="email" name="contact_person_email" class="form-control"
                                                        placeholder="Contact Person Email Address" required="required"
                                                        value="<?= isset($company['contact_person_email']) ? $company['contact_person_email'] : '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <select name="status" class="form-control"
                                                        id="exampleFormControlSelect1">
                                                        <option value="0" disabled>Status</option>
                                                        <option value="1" <?= (isset($company) && $company['status'] == 1) ? 'selected' : '' ?>>
                                                            Active
                                                        </option>
                                                        <option value="0" <?= (isset($company) && $company['status'] == 0) ? 'selected' : '' ?>>
                                                            Inactive
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row mb-5">
                                            <div class="col-lg-12">
                                                <div class="mt-3">
                                                    <div
                                                        class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                                        <div class="d-flex">
                                                            <img class="img-sm rounded-10"
                                                                src="<?= isset($company['company_logo']) ? $company['company_logo'] : base_url('/assets/admin/uploads/images/company_logos/logo.png') ?>"
                                                                alt="profile">
                                                            <div class="wrapper ms-3">
                                                                <p class="ms-1 mb-1 fw-bold">
                                                                    <?= isset($company['title']) ? $company['title'] : '' ?>
                                                                    Logo
                                                                </p>
                                                                <input type="file" name="company_logo"
                                                                    class="file-upload-default">
                                                                <small class="text-muted mb-0">
                                                                    <?= isset($company['company_logo']) ? $company['company_logo'] : base_url('/assets/admin/uploads/images/company_logos/logo.png') ?>
                                                                </small>
                                                            </div>
                                                        </div>
                                                        <div class="text-muted text-small">
                                                            <button class="file-upload-browse btn btn-primary"
                                                                type="button">Upload</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary me-2 text-white">Submit</button>
                                        <button class="btn btn-light">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->
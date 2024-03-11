<form class="forms-sample p-3" action="<?= base_url('admin/action/create/charge') ?>" method="POST"
    enctype="multipart/form-data">
    <input type="hidden" name="charge_id" value="<?= isset($charge['charge_id']) ? $charge['charge_id'] : '' ?>">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">
                <div class="col-sm-9">
                    <select name="charge_paid" class="form-control" id="exampleFormControlSelect1">
                        <option value="0" disabled>Status</option>
                        <option value="1" <?= (isset($charge) && $charge['charge_paid'] == 1) ? 'selected' : '' ?>>Paid
                        </option>
                        <option value="0" <?= (isset($charge) && $charge['charge_paid'] == 0) ? 'selected' : '' ?>>
                            Unpaid</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="text" name="charge_title" class="form-control" placeholder="Charge Title"
                        required="required"
                        value="<?= isset($charge['charge_title']) ? $charge['charge_title'] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="number" name="charge_cost" class="form-control" placeholder="Charge Cost"
                        required="required" value="<?= isset($charge['charge_cost']) ? $charge['charge_cost'] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <select class="form-control" name="charge_client">
                        <option value="0">Select Client</option>
                        <?= $this->admin_model->get_select_options('clients', $charge['charge_client'], 'client_name') ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-9">
                    <input type="text" name="charge_reference" disabled class="form-control"
                        placeholder="Charge Reference" required="required"
                        value="<?= isset($charge['charge_reference']) ? $charge['charge_reference'] : '' ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary me-2 text-white">Submit</button>
        <button class="btn btn-light">Cancel</button>
    </div>
</form>
<?php
?>
<form class="forms-sample p-3" action="<?= base_url('admin/action/create/billing') ?>" method="POST"
    enctype="multipart/form-data">
    <input type="hidden" name="billing_id" value="<?= isset($billing['billing_id']) ? $billing['billing_id'] : '' ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-11">
                    <select name="billing_client" class="form-control">
                        <option value="0" disabled>Client</option>
                        <?php foreach ($clients as $client): ?>
                            <option value="<?= $client['client_id'] . '|' . $client['client_name'] ?>" <?= (isset($billing) && $billing['client_id'] == $client['client_id']) ? 'selected' : '' ?>>
                                <?= $client['client_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-11">
                    <select name="billing_status" class="form-control">
                        <option value="0" disabled>Status</option>
                        <option value="1" <?= (isset($billing) && $billing['status'] == 1) ? 'selected' : '' ?>>Active
                        </option>
                        <option value="0" <?= (isset($billing) && $billing['status'] == 0) ? 'selected' : '' ?>>Inactive
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-11">
                    <input type="number" name="billing_cost" pattern="[0-9.]+" inputmode="numeric" class="form-control"
                        placeholder="Billing Cost" required="required"
                        value="<?= isset($billing['billing_cost']) ? $billing['billing_cost'] : '' ?>">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-11">
                    <input type="text" name="billing_title" class="form-control" placeholder="Billing Title"
                        required="required"
                        value="<?= isset($billing['billing_title']) ? $billing['billing_title'] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-11">
                    <select name="billing_date" class="form-control">
                        <?php for ($i = 1; $i < 32; $i++): ?>
                            <option value="<?= $i ?>" <?= (isset($billing) && $billing['billing_date'] == $i) ? 'selected' : '' ?>> On
                                the
                                <?= $i ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-11">
                    <select name="billing_frequency" class="form-control">
                        <option value="daily" <?= (isset($billing) && $billing['billing_frequency'] == 'daily') ? 'selected' : '' ?>>Daily</option>
                        <option value="weekly" <?= (isset($billing) && $billing['billing_frequency'] == 'weekly') ? 'selected' : '' ?>>Weekly</option>
                        <option value="monthly" <?= (isset($billing) && $billing['billing_frequency'] == 'monthly') ? 'selected' : '' ?>>Monthly</option>
                        <option value="yearly" <?= (isset($billing) && $billing['billing_frequency'] == 'yearly') ? 'selected' : '' ?>>Yearly</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary me-2 text-white">Submit</button>
    <button class="btn btn-light">Cancel</button>
</form>
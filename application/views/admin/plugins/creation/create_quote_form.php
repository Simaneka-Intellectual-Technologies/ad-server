<form class="forms-sample p-3" action="<?= base_url('admin/action/create/quote') ?>" method="POST"
    enctype="multipart/form-data">
    <input type="hidden" name="quote_id"
        value="<?= isset($quote[url_title('quote_id', '_', true)]) ? $quote[url_title('quote_id', '_', true)] : '' ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-11">
                    <input type="text" name="<?= url_title('Company Name', '_', true) ?>" class="form-control"
                        placeholder="Company Name" required="required"
                        value="<?= isset($quote[url_title('Company Name', '_', true)]) ? $quote[url_title('Company Name', '_', true)] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-11">
                    <input type="text" name="<?= url_title('Physical Address', '_', true) ?>" class="form-control"
                        placeholder="Physical Address" required="required"
                        value="<?= isset($quote[url_title('Physical Address', '_', true)]) ? $quote[url_title('Physical Address', '_', true)] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-11">
                    <input type="email" name="<?= url_title('Company Email', '_', true) ?>" class="form-control"
                        placeholder="Company Email" required="required"
                        value="<?= isset($quote[url_title('Company Email', '_', true)]) ? $quote[url_title('Company Email', '_', true)] : '' ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-sm-11">
                    <input type="number" name="<?= url_title('Company Cell', '_', true) ?>" class="form-control"
                        placeholder="Company Cell" required="required"
                        value="<?= isset($quote[url_title('Company Cell', '_', true)]) ? $quote[url_title('Company Cell', '_', true)] : '' ?>">
                </div>
            </div>
        </div>

        <p class="card-description">
            Entities Quoted For

            <hr style="margin: 0 15px; ">
        </p>
        <div class="row quote_row">
            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-sm-11">
                        <input type="text" name="<?= url_title('Description', '_', true) ?>_1" class="form-control"
                            placeholder="Description of Item" required="required"
                            value="<?= isset($quote[url_title('Description', '_', true)]) ? $quote[url_title('Description', '_', true)] : '' ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-sm-11">
                        <input type="text" name="<?= url_title('Rate', '_', true) ?>_1" class="form-control"
                            placeholder="Rate" required="required"
                            value="<?= isset($quote[url_title('Rate', '_', true)]) ? $quote[url_title('Rate', '_', true)] : '' ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                    <div class="col-sm-11">
                        <input type="text" name="<?= url_title('Quantity', '_', true) ?>_1" class="form-control"
                            placeholder="Quantity" required="required"
                            value="<?= isset($quote[url_title('Quantity', '_', true)]) ? $quote[url_title('Quantity', '_', true)] : '' ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary me-2 text-white">Submit</button>
        <button class="btn btn-light">Cancel</button>
        <button class="btn btn-warning text-white float-end rowRowBtn">Add Row</button>
        <button class="btn btn-danger text-white float-end deleteRowBtn d-none">Delete Row</button>
    </div>

    <input type="hidden" name="rows" value="1" class="rowCount">
</form>

<script>
    var rowRowBtn = document.querySelector('.rowRowBtn')
    var deleteRowBtn = document.querySelector('.deleteRowBtn')
    var rowCount = document.querySelector('.rowCount')

    rowRowBtn.addEventListener('click', (e) => {
        e.preventDefault();

        var rows = document.querySelector('.quote_row');
        var number = document.querySelectorAll('.quote_row').length + 1
        rows.insertAdjacentHTML('afterend', rows.outerHTML.replaceAll('_1', '_' + number))
        if (document.querySelectorAll('.quote_row').length > 1) {
            deleteRowBtn.classList.remove('d-none')
        }
        updateRowCount(document.querySelectorAll('.quote_row').length)
    })


    deleteRowBtn.addEventListener('click', (e) => {
        e.preventDefault();

        var rows = document.querySelectorAll('.quote_row')
        rows[rows.length - 1].remove()

        if (document.querySelectorAll('.quote_row').length == 1) {
            deleteRowBtn.classList.add('d-none')
        }
        updateRowCount(document.querySelectorAll('.quote_row').length)
    })

    updateRowCount(num)
    {
        rowCount.value = num
    }
</script>
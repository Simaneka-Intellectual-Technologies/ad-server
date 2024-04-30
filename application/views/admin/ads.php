<style>
    .dt-buttons {
        display: none;
    }
</style>
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <div>
                        <div class="btn-wrapper f-right">
                            <a href="#" class="btn btn-otline-dark align-items-center copyBtn"><i
                                    class="icon-share"></i>
                                Copy</a>
                            <a href="#" class="btn btn-otline-dark printTBtn"><i class="icon-printer"></i> Print</a>
                            <a href="#" class="btn btn-otline-dark csvBtn"><i class="icon-download"></i> CSV</a>
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
                                            <a href="<?= base_url('admin/page/create/ad/create') ?>"
                                                class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i
                                                    class="mdi mdi-account-plus"></i>Add Advertisment</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="table-responsive  mt-1">
                                        <table class="table select-table" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Ad</th>
                                                    <th>Status</th>
                                                    <th>Start Date</th>
                                                    <th>Duration</th>
                                                    <th>Share</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($ads as $ad): ?>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex ">
                                                                <img src="<?= ($ad['file'] != '') ? base_url('assets/' . $ad['file']) : base_url('/assets/landing/img/logos/logo_23.png') ?>"
                                                                    alt="<?= $ad['title'] . 'Logo' ?>">
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
                                                                <h6><?= $ad['clicks'] . ' Clicks' ?> </h6>
                                                                <p><?= $ad['impressions'] . ' Impressions' ?></p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="#">
                                                                <div class="badge badge-opacity-success">
                                                                    <?= $ad['start_date'] ?>
                                                                </div>
                                                                <div class="badge badge-opacity-warning">
                                                                    <?= $ad['end_date'] ?>
                                                                </div>
                                                            </a>

                                                        </td>
                                                        <td>
                                                            <a href="#" class="downloadBtns" data-id="<?= $ad['ad_id'] ?>">
                                                                <div class="badge badge-opacity-success">Extract Report
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a
                                                                href="<?= base_url('admin/page/create/ad/' . $ad['ad_id']) ?>">
                                                                <div class="badge badge-opacity-warning">Edit</div>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a
                                                                href="<?= base_url('admin/action/delete/ad/' . $ad['ad_id']) ?>">
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

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary modalBtn d-none" data-bs-toggle="modal"
        data-bs-target="#staticBackdrop">
        Modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Share Ad Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-outline-success btn-icon-text printBtn">
                        Print
                        <i class="ti-printer btn-icon-append"></i>
                    </button>
                    <button type="button" class="btn btn-outline-warning btn-icon-text emailBtn">
                        Email
                        <i class="ti-email btn-icon-append"></i>
                    </button>
                    <button type="button" class="btn btn-outline-info btn-icon-text downloadBtn">
                        Download
                        <i class="ti-download btn-icon-append"></i>
                    </button>
                    <div class="form-group row mt-5 mailerBox d-none">
                        <div class="col-sm-10">
                            <label for="">Email Address</label>
                            <input type="email" name="email" class="form-control reportEmail"
                                placeholder="Alternative Text">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success d-none sendEmailBtn">Send</button>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <script src="<?= base_url('assets/admin/js/html2pdf.bundle.js') ?>"></script>
    <script>
        var downloadBtns = document.querySelectorAll('.downloadBtns'),
            modalBtn = document.querySelector('.modalBtn'),
            printBtn = document.querySelector('.printBtn'),
            emailBtn = document.querySelector('.emailBtn'),
            downloadBtn = document.querySelector('.downloadBtn'),
            quote_id = document.querySelector('.quote_id'),
            modalBody = document.querySelector('.modal-body'),
            mailerBox = document.querySelector('.mailerBox'),
            reportEmail = document.querySelector('.reportEmail'),
            sendEmailBtn = document.querySelector('.sendEmailBtn'),
            reply

        downloadBtns.forEach(downBtn => {
            downBtn.addEventListener('click', () => {

                var formdata = new FormData();
                formdata.append("id", downBtn.getAttribute('data-id'));

                var ajax = new XMLHttpRequest();
                ajax.addEventListener("load", completeHandler, false);
                ajax.open("POST", "<?= base_url('/admin/ajax/report') ?>");
                ajax.send(formdata);
            })
        });

        function completeHandler(event) {
            reply = JSON.parse(event.target.responseText);

            if (reply.status) {
                modalBtn.click()
                downloadBtn.addEventListener('click', () => {
                    var opt = {
                        margin: 1,
                        filename: reply.name + " Report - <?= SHORT_APP_NAME ?>.pdf",
                        image: {
                            type: "jpeg",
                            quality: 0.98
                        },
                        html2canvas: {
                            scale: 2
                        },
                        jsPDF: {
                            unit: "in",
                            format: "letter",
                            orientation: "portrait"
                        },
                    };
                    html2pdf().from(reply.report).set(opt).save();
                })

                printBtn.addEventListener('click', () => {
                    // Create a new window and append the cloned item
                    const printWindow = window.open('', '_blank');
                    printWindow.document.body.innerHTML = reply.report;

                    // Call print on the new window
                    printWindow.print();
                })
                emailBtn.addEventListener('click', () => {
                    mailerBox.classList.remove('d-none')
                    sendEmailBtn.classList.remove('d-none')
                })
            }
        }

        sendEmailBtn.addEventListener('click', () => {
            sendEmailBtn.innerHTML =
                'Please Wait... <img height="15px" src="<?= base_url('assets/landing/img/loader.svg') ?>">'
            sendEmailBtn.disabled = true
            var formdata = new FormData();
            formdata.append("ad_id", reply.ad_id);
            formdata.append("email", reportEmail.value);

            var ajax = new XMLHttpRequest();
            ajax.addEventListener("load", completeHandler2, false);
            ajax.open("POST", "<?= base_url('/admin/ajax/sendReport') ?>");
            ajax.send(formdata);
        })

        function completeHandler2(event) {

            var reply = JSON.parse(event.target.responseText);

            if (reply.status) {
                modalBody.innerHTML += '<div class="alert alert-success" role="alert">' + reply.message + '</div>'
            } else {
                modalBody.innerHTML += '<div class="alert alert-daner" role="alert">' + reply.message + '</div>'
            }

            sendEmailBtn.innerHTML = 'Send'
            sendEmailBtn.disabled = false
            reportEmail.value = ''
        }

        window.onload = (event) => {
            const
                csvBtn = document.querySelector('.csvBtn'),
                printTBtn = document.querySelector('.printTBtn'),
                copyBtn = document.querySelector('.copyBtn'),
                buttonsCsv = document.querySelector('.buttons-csv'),
                buttonsCopy = document.querySelector('.buttons-copy'),
                buttonsPrint = document.querySelector('.buttons-print')

            csvBtn.addEventListener('click', () => {
                buttonsCsv.click()
            })
            printTBtn.addEventListener('click', () => {
                buttonsPrint.click()
            })
            copyBtn.addEventListener('click', () => {
                buttonsCopy.click()
            })
        };
    </script>
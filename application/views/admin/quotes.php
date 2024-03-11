<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <div>
                        <div class="btn-wrapper f-right">
                            <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i>
                                Share</a>
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
                                            <h4 class="card-title card-title-dash">Quotes</h4>
                                            <p class="card-subtitle card-subtitle-dash">Here is a list of the quotes
                                                made to quotes</p>
                                        </div>
                                        <div>
                                            <a href="<?= base_url('admin/page/create/quote/create') ?>"
                                                class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i
                                                    class="mdi mdi-cards"></i>Add quote</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="table-responsive  mt-1">
                                        <table class="table select-table">
                                            <thead>
                                                <tr>
                                                    <th>Quoted To</th>
                                                    <th>Cell</th>
                                                    <th>Email</th>
                                                    <th>Quoter</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($quotes as $quotes): ?>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex ">
                                                                <div>
                                                                    <h6>
                                                                        <?= $quotes['name'] ?>
                                                                    </h6>
                                                                    <p>
                                                                        <?= $quotes['address'] ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a style="text-decoration:none;"
                                                                href="tel:264<?= $quotes['cell'] ?>">
                                                                <p class="text-success">
                                                                    <?= '+264' . $quotes['cell'] ?>
                                                                </p>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a style="text-decoration:none;"
                                                                href="mailto:<?= $quotes['email'] ?>">

                                                                <p class="text-success">
                                                                    <?= $quotes['email'] ?>
                                                                </p>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <h6>
                                                                <?= $quotes['created_by'] ?>
                                                            </h6>
                                                            <p class="text-success">
                                                                <?= $quotes['quoted_on_date'] ?>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <a href="#">
                                                                <div class="badge badge-opacity-warning downloadBtns"
                                                                    data-quote-id="<?= $quotes['quote_id'] ?>">SHARE
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a
                                                                href="<?= base_url('admin/page/create/quote/' . $quotes['quote_id']) ?>">
                                                                <div class="badge badge-opacity-success">Edit</div>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a
                                                                href="<?= base_url('admin/action/delete/quote/' . $quotes['quote_id']) ?>">
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
                    <h5 class="modal-title" id="staticBackdropLabel">Share Quote</h5>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
            modalBody = document.querySelector('.modal-body')

        downloadBtns.forEach(downBtn => {
            downBtn.addEventListener('click', () => {

                var formdata = new FormData();
                formdata.append("quote_id", downBtn.getAttribute('data-quote-id'));

                var ajax = new XMLHttpRequest();
                ajax.addEventListener("load", completeHandler, false);
                ajax.open("POST", "<?= base_url('/admin/ajax/quote') ?>");
                ajax.send(formdata);
            })
        });

        function completeHandler(event) {
            var reply = JSON.parse(event.target.responseText);

            if (reply.status) {
                modalBtn.click()
                downloadBtn.addEventListener('click', () => {
                    var opt = {
                        margin: 1,
                        filename: reply.quote.name + " Quote - <?= SHORT_APP_NAME ?>.pdf",
                        image: { type: "jpeg", quality: 0.98 },
                        html2canvas: { scale: 2 },
                        jsPDF: { unit: "in", format: "letter", orientation: "portrait" },
                    };
                    html2pdf().from(reply.quote.quote).set(opt).save();
                })

                printBtn.addEventListener('click', () => {
                    // Create a new window and append the cloned item
                    const printWindow = window.open('', '_blank');
                    printWindow.document.body.innerHTML = reply.quote.quote;

                    // Call print on the new window
                    printWindow.print();
                })
                emailBtn.addEventListener('click', () => {
                    var formdata = new FormData();
                    formdata.append("quote_id", reply.quote.quote_id);

                    var ajax = new XMLHttpRequest();
                    ajax.addEventListener("load", completeHandler2, false);
                    ajax.open("POST", "<?= base_url('/admin/ajax/sendQuote') ?>");
                    ajax.send(formdata);
                })
            }
        }


        function completeHandler2(event) {

            var reply = JSON.parse(event.target.responseText);

            if (reply.status) {
                modalBody.innerHTML += '<div class="alert alert-success" role="alert">' + reply.message + '</div>'
            }
            else {
                modalBody.innerHTML += '<div class="alert alert-daner" role="alert">' + reply.message + '</div>'
            }
        }
    </script>
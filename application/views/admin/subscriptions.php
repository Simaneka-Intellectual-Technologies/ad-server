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
                    <div class="row">
                        <div class="col-md-12" style="align-items:center; justify-content:center">
                            <div class="alert alert-info text-dark" style="display:flex">
                                <i class="mdi mdi-alert-outline text-info d-flex align-self-start me-3 mr-5"></i>
                                You have <?= $company['credits'] ?> credits remaining!
                            </div>
                        </div>
                        <?php foreach ($packages as $key => $package): ?>
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $package['package_name'] ?></h4>
                                    <div class="media">
                                        <i
                                            class="mdi <?= $package['package_icon'] ?> icon-md text-info d-flex align-self-start me-3"></i>
                                        <div class="media-body">
                                            <p class="card-text"><?= $package['package_description'] ?></p>

                                        </div>
                                    </div>
                                    <blockquote class="blockquote blockquote-primary text-center">
                                        <h2>N$ <?= $package['package_price'] ?></h2>
                                    </blockquote>
                                    <button class="btn btn-outline-dark btn-icon-text w-100 getItBtns"
                                        data-amount="<?= $package['package_price'] ?>">
                                        <i class="mdi mdi-auto-fix btn-icon-prepend"></i>
                                        <span class="d-inline-block text-left">
                                            <small class="fw-light d-block">Get it</small>
                                            Now
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="topUpResponse"></div>
                    <div class="row">
                        <div class="col-md-12 mb-lg-0 mb-4">
                            <div class="card mt-4">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-6 d-flex align-items-center">
                                            <h6 class="mb-0">Payment Method</h6>
                                        </div>
                                        <div class="col-6 text-end">
                                            <button type="submit" class="btn btn-primary me-2 text-white topBtn">Top
                                                Up</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-md-6 mb-md-0 mb-4">
                                            <div
                                                class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                                <img class="w-10 me-3 mb-0" width="50px"
                                                    src="<?= base_url('assets/admin/images/logos/mastercard.png') ?>"
                                                    alt="logo">
                                                <h6 class="mb-0">
                                                    ****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;7852
                                                </h6>
                                                <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Edit Card" aria-label="Edit Card"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                                <img class="w-10 me-3 mb-0" width="50px"
                                                    src="<?= base_url('assets/admin/images/logos/visa.png') ?>"
                                                    alt="logo">
                                                <h6 class="mb-0">
                                                    ****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;5248
                                                </h6>
                                                <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Edit Card" aria-label="Edit Card"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var getItBtns = document.querySelectorAll('.getItBtns'),
    topBtn = document.querySelector('.topBtn'),
    topUpResponse = document.querySelector('.topUpResponse'),
    amount = 0

getItBtns.forEach(getItBtn => {
    getItBtn.addEventListener('click', () => {
        getItBtns.forEach(getItBtn => {
            getItBtn.parentElement.parentElement.style.backgroundColor = '#fff'
        })


        getItBtn.parentElement.parentElement.style.backgroundColor = '#ddd'

        amount = getItBtn.getAttribute('data-amount')


    })
});

topBtn.addEventListener('click', () => {
    topBtn.innerHTML =
        'Please Wait... <img height="15px" src="<?= base_url('assets/landing/img/loader.svg') ?>">'
    topBtn.disabled = true
    var formdata = new FormData();
    formdata.append("amount", amount);

    var ajax = new XMLHttpRequest();
    ajax.addEventListener("load", completeHandler, false);
    ajax.open("POST", "<?= base_url('/admin/ajax/topUp') ?>");
    ajax.send(formdata);
})

function completeHandler(event) {

    var reply = JSON.parse(event.target.responseText);

    if (reply.status) {
        topUpResponse.innerHTML += '<div class="alert alert-success" role="alert">' + reply.message + '</div>'
    } else {
        topUpResponse.innerHTML += '<div class="alert alert-daner" role="alert">' + reply.message + '</div>'
    }

    topBtn.innerHTML = 'Top Up'
    topBtn.disabled = false
}
</script>
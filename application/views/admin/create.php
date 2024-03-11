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
                <div class="tab-content tab-content-basic row">

                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Create
                                    <?= ucfirst($type) ?>
                                </h4>
                                <p class="card-description">
                                    Add New
                                    <?= ucfirst($type) ?> to Listing
                                </p>
                                <?php

                                if($type == "billing") {
                                    $data['clients'] = $clients;

                                    if(isset($billing)) {
                                        $data['billing'] = $billing;
                                    }
                                } elseif($type == "clients") {
                                    if(isset($clients)) {
                                        $data['clients'] = $clients[0];
                                    }
                                }

                                $this->load->view('admin/plugins/creation/create_'.$type.'_form', (isset($data) ? $data : null))

                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->
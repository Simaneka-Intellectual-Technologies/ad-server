<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
            <?php

            $version = $this->admin_model->get_version();
            $date = new DateTime($version['update_date']);

            ?>
            <a href="<?= base_url('admin/pages/view/version/' . $version['version_id']) ?>"
                class="text-decoration-none">Verson
                <?= $date->format('ymd') ?> -
            </a>
            <?= APP_NAME ?> by <a class="text-decoration-none" href="http://simaneka.com/" target="_blank">Simaneka
                Intellectual Technologies</a>
        </span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright ©
            <?= date('Y') ?>. All rights reserved.
        </span>
    </div>
</footer>
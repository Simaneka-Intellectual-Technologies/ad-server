<div class="content-wrapper">
  <div class="row">
    <div class="col-sm-12">
      <div class="home-tab">
        <div class="d-sm-flex align-items-center justify-content-between border-bottom">
          <div>
            <div class="btn-wrapper f-right">
              <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
              <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
              <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
            </div>
          </div>
        </div>
        <div class="tab-content tab-content-basic">
          <div class="row">
            <?php if (count($subscription) == 0) : ?>
            <div class="col-md-12" style="align-items:center; justify-content:center">
              <div class="alert alert-info text-dark" style="display:flex">
                <i class="mdi mdi-alert-outline text-info d-flex align-self-start me-3 mr-5"></i>
                You are currently on your trial subscription! 
              </div>
            </div>
            <?php endif; ?>
            <?php foreach ($packages as $key => $package): ?>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"><?= $package['package_name'] ?></h4>
                    <div class="media">
                      <i class="mdi <?= $package['package_icon'] ?> icon-md text-info d-flex align-self-start me-3"></i>
                      <div class="media-body">
                        <p class="card-text"><?= $package['package_description'] ?></p>
                        <ul class="list-ticked">
                          <?php 
                          $perks = explode(',', $package['package_perks']);
                          foreach ($perks as $key => $perk): ?>
                          <li><?= $perk ?></li>
                          <?php endforeach; ?>
                        </ul>
                      </div>
                    </div>
                    <blockquote class="blockquote blockquote-primary text-center">
                      <h2>N$ <?= $package['package_price'] ?> / per month</h2>
                    </blockquote>
                    <?php if (count($subscription) > 0 && $subscription[0]['type'] == 'basic') : ?>
                      <button class="btn btn-dark btn-icon-text w-100 text-white">
                        <i class="mdi mdi-auto-fix btn-icon-prepend"></i>
                        <span class="d-inline-block text-left">
                          <small class="fw-light d-block">Your</small>
                          Current Subscription
                        </span>
                      </button>
                    <?php else : ?>
                      <button class="btn btn-outline-dark btn-icon-text w-100">
                        <i class="mdi mdi-auto-fix btn-icon-prepend"></i>
                        <span class="d-inline-block text-left">
                          <small class="fw-light d-block">Get it</small>
                          Now
                        </span>
                      </button>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php endforeach;?>
          </div>
        </div>
      </div>
    </div>
  </div>
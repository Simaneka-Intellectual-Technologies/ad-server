<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-category">Pages</li>
        <li class="nav-item <?= ($this->uri->segment(3) == 'dashboard') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/page/dashboard') ?>">
                <i class="mdi mdi-chart-bar menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item <?= ($this->uri->segment(3) == 'ads') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/page/ads') ?>">
                <i class="mdi mdi-account-card-details menu-icon"></i>
                <span class="menu-title">Ads</span>
            </a>
        </li>
        
        <li class="nav-item <?= ($this->uri->segment(3) == 'pushish') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/page/pushish') ?>">
                <i class="mdi mdi-account-card-details menu-icon"></i>
                <span class="menu-title">Code Pushish</span>
            </a>
        </li>
        <li class="nav-item <?= ($this->uri->segment(3) == 'bidders') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/page/bidders') ?>">
                <i class="mdi mdi-account-card-details menu-icon"></i>
                <span class="menu-title">Evaluating Bidders</span>
            </a>
        </li>
        <li class="nav-item <?= ($this->uri->segment(3) == 'inventory') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/page/inventory') ?>">
                <i class="mdi mdi-account-card-details menu-icon"></i>
                <span class="menu-title"> inventory</span>
            </a>
        </li>
        <li class="nav-item <?= ($this->uri->segment(3) == 'campaigns') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/page/campaigns') ?>">
                <i class="mdi mdi-account-card-details menu-icon"></i>
                <span class="menu-title"> marketing campaign
</span>
            </a>
        </li>
        <li class="nav-item nav-category">System</li>
        <li class="nav-item <?= ($this->uri->segment(3) == 'companies') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/page/companies') ?>">
                <i class="mdi mdi-city menu-icon"></i>
                <span class="menu-title">Company</span>
            </a>
        </li>
        <li class="nav-item <?= ($this->uri->segment(3) == 'admin') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/page/admin') ?>">
                <i class="mdi mdi-account-multiple menu-icon"></i>
                <span class="menu-title">Admin</span>
            </a>
        </li>
        <li class="nav-item <?= ($this->uri->segment(3) == 'subscriptions') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/page/subscriptions') ?>">
                <i class="mdi mdi-briefcase-download menu-icon"></i>
                <span class="menu-title">Subscription</span>
            </a>
        </li>
        <li class="nav-item nav-category">Help</li>
        <li class="nav-item <?= ($this->uri->segment(3) == 'usage') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/page/usage') ?>">
                <i class="mdi mdi-auto-fix menu-icon"></i>
                <span class="menu-title">Using The System</span>
            </a>
        </li>
        <li class="nav-item <?= ($this->uri->segment(3) == 'help') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/page/help') ?>">
                <i class="mdi mdi-alert-circle menu-icon"></i>
                <span class="menu-title">Help</span>
            </a>
        </li>
        <li class="nav-item <?= ($this->uri->segment(3) == 'about') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/page/about') ?>">
                <i class="mdi mdi-book-open menu-icon"></i>
                <span class="menu-title">About</span>
            </a>
        </li>
    </ul>
</nav>
<div class="main-panel">
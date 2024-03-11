<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-category">Pages</li>
        <li class="nav-item <?= ($this->uri->segment(3) == 'dashboard') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/page/dashboard') ?>">
                <i class="mdi mdi-chart-bar menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item <?= ($this->uri->segment(3) == 'clients') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/page/clients') ?>">
                <i class="mdi mdi-account-card-details menu-icon"></i>
                <span class="menu-title">Clients</span>
            </a>
        </li>
        <li class="nav-item <?= ($this->uri->segment(3) == 'billing') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/page/billing') ?>">
                <i class="mdi mdi-calculator menu-icon"></i>
                <span class="menu-title">Billing</span>
            </a>
        </li>
        <li class="nav-item <?= ($this->uri->segment(3) == 'charges') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/page/charges') ?>">
                <i class="mdi mdi-currency-usd menu-icon"></i>
                <span class="menu-title">Charges</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-cards"></i>
                <span class="menu-title">Quotes</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic" style="">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="<?= base_url('/admin/page/create/quote/create') ?>">Create
                            Templated</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link"
                            href="<?= base_url('/admin/page/create/dynamic/create') ?>">Create Dynamic</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/page/quotes') ?>">List of
                            Quotes</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item <?= ($this->uri->segment(3) == 'documents') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/page/documents') ?>">
                <i class="mdi mdi-file-multiple menu-icon"></i>
                <span class="menu-title">Documents</span>
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
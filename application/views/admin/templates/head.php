<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        <?= APP_NAME.' Admin Panel' ?>
    </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url('assets/admin/vendors/feather/feather.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin/vendors/mdi/css/materialdesignicons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin/vendors/ti-icons/css/themify-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin/vendors/typicons/typicons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin/vendors/simple-line-icons/css/simple-line-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin/vendors/css/vendor.bundle.base.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin/vendors/prism/prism.css') ?>">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url('assets/admin/js/select.dataTables.min.css') ?>">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/vertical-layout-light/style.css') ?>">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url('assets/admin/images/logos/logo_7.png') ?>" />

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="<?= APP_NAME ?>" />
    <meta name="ROBOTS" content="index,follow" />
    <meta name="language" content="en" />
    <meta name="copyright" content="<?= APP_NAME ?>" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="description"
        content="<?= APP_NAME ?> aids individuals, businesses and companies manage their clients and keep track of the imformation pertaining the clients" />
    <meta name="keywords"
        content="Clients, management, systems, track, billing, recurring, money, finances, simaneka, intellectual, technologies, filing, data, information" />
    <meta property="fb:app_id" content="" />
    <meta property="og:title" content="<?= APP_NAME ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:description"
        content="<?= APP_NAME ?> aids individuals, businesses and companies manage their clients and keep track of the imformation pertaining the clients" />
    <meta property="og:url" content="<?= base_url() ?>" />
    <meta property="og:site_name" content="<?= APP_NAME ?>" />
    <meta property="og:image" content="<?= base_url('assets/admin/images/logos/logo_2.png') ?>" />
    <meta name="DC.title" content="<?= APP_NAME ?>" />
    <meta name="DC.description" lang="en"
        content="<?= APP_NAME ?> aids individuals, businesses and companies manage their clients and keep track of the imformation pertaining the clients" />
    <meta name="DC.date" content="<?= date('Y-m-d') ?>" />
    <meta name="DC.date.issued" content="<?= date('Y-m-d') ?>" />
    <meta name="DC.creator" content="<?= APP_NAME ?>" />
    <meta name="DC.publisher" content="<?= APP_NAME ?>" />
    <meta name="DC.language" content="en" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description"
        content="<?= APP_NAME ?> aids individuals, businesses and companies manage their clients and keep track of the imformation pertaining the clients" />
    <meta name="twitter:title" content="<?= APP_NAME ?>" />
    <meta name="twitter:image" content="<?= base_url('assets/admin/images/logos/logo_2.png') ?>" />
    <link href="<?= base_url() ?>" rel="canonical">

    <?php if($_SERVER['DOCUMENT_ROOT'] != 'C:/xampp/htdocs'): ?>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-F1CCE7P5GP"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-F1CCE7P5GP');
        </script>

        <script type="application/ld+json">
                {
                    "@context": "https://schema.org/",
                    "headline": "<?= APP_NAME ?>",
                    "description": "<?= APP_NAME ?> aids individuals, businesses and companies manage their clients and keep track of the imformation pertaining the clients",
                    "keywords": "Clients, management, systems, track, billing, recurring, money, finances, simaneka, intellectual, technologies, filing, data, information",
                    "@type": "WebPage",
                    "author":

                    {
                        "@type": "Organization",
                        "url": "<?= APP_NAME ?>"
                    },
                    "publisher": {
                        "@type": "Organization",
                        "name": "<?= APP_NAME ?>",
                        "url": "<?= base_url() ?>",
                        "sameAs": [""],
                        "logo":

                        {
                            "@type": "ImageObject",
                            "url": "<?= base_url('assets/admin/images/logos/logo_2.png') ?>",
                            "width": "260",
                            "height": "60"
                        }
                    }
                }
            </script>
    <?php endif; ?>
</head>

<body>
    <div class="container-scroller">
        <!-- Navbar-->
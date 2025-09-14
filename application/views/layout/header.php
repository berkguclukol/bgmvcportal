<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=Factory::getPageTitle()?></title>
    <link rel="icon" type="image/svg+xml" href="<?=PUBLIC_ROOT?>assets/image/favicon.svg">
    <link rel="stylesheet" href="<?=VENDOR_ROOT?>bootstrap/css/bootstrap.min.css?t=<?=time()?>">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-expand-lg" data-bs-theme="dark" style="background-color: #409859;">
            <div class="container">
                <a class="navbar-brand" href="<?= SITE_URL ?>" title="<?= SITE_TITLE ?>">
                    <img src="<?= PUBLIC_ROOT ?>assets/image/logo.white.svg" alt="<?= SITE_TITLE ?>" height="42">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?=SITE_URL?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=Factory::navigate("pages")?>">pages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=Factory::navigate("pages","about")?>">pages/about</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?=Factory::navigate("pages","about?id=25")?>">pages/about?id=25</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=Factory::navigate("customers")?>">Customers Operation</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<div class="container mt-3">
    <div class="row">
        <div class="col">

        </div>
    </div>
</div>


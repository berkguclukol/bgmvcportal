<div class="container mt-3">
    <div class="row">
        <div class="col">
            <div class="mt-3 p-5 mb-4 bg-body-tertiary rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">Welcome to the Northwind home page.</h1>
                    <p class="col-md-8 fs-4">PHP project written in mvc framework that I use for my personal
                        projects. Use Northwind mysql DB.</p>
                    <a href="<?=SITE_URL?>pages/customers" class="btn btn-primary btn-lg">Get Started</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php
            //$data = Database::getAll("customers");
            //$customer = Database::getOne('customers', 'WHERE ContactName = ?', array("Aria Cruz"));
            //$customers = Database::getId('customers', 5 ,"CustomerID");
            //$count = Database::count('customers');



            ?>
        </div>
    </div>
</div>
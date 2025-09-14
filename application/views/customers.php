<?php $customers = Database::getAll("customers"); ?>
<div class="container mt-3">
    <div class="row">
        <div class="col">
            <h1>Customers page</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">CustomerName</th>
                    <th scope="col">ContactName</th>
                    <th scope="col">Address</th>
                    <th scope="col">City</th>
                    <th scope="col">PostalCode</th>
                    <th scope="col">Country</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($customers as $customer) : ?>
                    <tr>
                        <th scope="row"><?=$customer->CustomerID?></th>
                        <td><?=$customer->CustomerName?></td>
                        <td><?=$customer->ContactName?></td>
                        <td><?=$customer->Address?></td>
                        <td><?=$customer->City?></td>
                        <td><?=$customer->PostalCode?></td>
                        <td><?=$customer->Country?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
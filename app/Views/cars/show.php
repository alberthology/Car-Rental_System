<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>Car Details</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th width="200">Car ID</th>
                            <td><?= esc($car['car_id']) ?></td>
                        </tr>
                        <tr>
                            <th>Company ID</th>
                            <td><?= esc($car['company_id']) ?></td>
                        </tr>
                        <tr>
                            <th>Model</th>
                            <td><?= esc($car['model']) ?></td>
                        </tr>
                        <tr>
                            <th>Brand</th>
                            <td><?= esc($car['brand']) ?></td>
                        </tr>
                        <tr>
                            <th>Year</th>
                            <td><?= esc($car['year']) ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge <?= $car['status'] === 'Available' ? 'bg-success' : 'bg-danger' ?>">
                                    <?= esc($car['status']) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td><?= esc($car['location']) ?></td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        <a href="<?= base_url('cars/edit/' . $car['car_id']) ?>" class="btn btn-warning">Edit</a>
                        <a href="<?= base_url('cars') ?>" class="btn btn-secondary">Back to List</a>
                        <form action="<?= base_url('cars/delete/' . $car['car_id']) ?>" method="post" class="d-inline">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this car?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 
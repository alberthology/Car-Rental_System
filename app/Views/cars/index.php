<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Cars Management</h2>
        </div>
        <div class="col-md-6 text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCarModal">
                Add New Car
            </button>
        </div>
    </div>

    <!-- Search Form -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form action="<?= base_url('cars/search') ?>" method="get" class="d-flex">
                <input type="text" name="keyword" class="form-control me-2" placeholder="Search by model, brand or location">
                <button type="submit" class="btn btn-outline-primary">Search</button>
            </form>
        </div>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- Cars Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Company ID</th>
                    <th>Model</th>
                    <th>Brand</th>
                    <th>Year</th>
                    <th>Status</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cars as $car): ?>
                    <tr>
                        <td><?= esc($car['car_id']) ?></td>
                        <td><?= esc($car['company_id']) ?></td>
                        <td><?= esc($car['model']) ?></td>
                        <td><?= esc($car['brand']) ?></td>
                        <td><?= esc($car['year']) ?></td>
                        <td>
                            <span class="badge <?= $car['status'] === 'Available' ? 'bg-success' : 'bg-danger' ?>">
                                <?= esc($car['status']) ?>
                            </span>
                        </td>
                        <td><?= esc($car['location']) ?></td>
                        <td>
                            <a href="<?= base_url('cars/show/' . $car['car_id']) ?>" class="btn btn-info btn-sm">View</a>
                            <a href="<?= base_url('cars/edit/' . $car['car_id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form action="<?= base_url('cars/delete/' . $car['car_id']) ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this car?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Car Modal -->
<div class="modal fade" id="addCarModal" tabindex="-1" aria-labelledby="addCarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCarModalLabel">Add New Car</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Display Validation Errors -->
                <div id="validationErrors" class="alert alert-danger" style="display: none;">
                    <ul></ul>
                </div>

                <form id="addCarForm" action="<?= base_url('cars/store') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label for="company_id" class="form-label">Company ID</label>
                        <input type="number" class="form-control" id="company_id" name="company_id" required>
                    </div>

                    <div class="mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" class="form-control" id="model" name="model" required>
                    </div>

                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" class="form-control" id="brand" name="brand" required>
                    </div>

                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" class="form-control" id="year" name="year" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="Available">Available</option>
                            <option value="Unavailable">Unavailable</option>
                            <option value="Damaged">Damaged</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitCarForm()">Add Car</button>
            </div>
        </div>
    </div>
</div>

<script>
function submitCarForm() {
    const form = document.getElementById('addCarForm');
    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Refresh the page to show the new car
            location.reload();
        } else {
            // Show validation errors
            const errorDiv = document.getElementById('validationErrors');
            const errorList = errorDiv.querySelector('ul');
            errorList.innerHTML = '';
            
            Object.values(data.errors).forEach(error => {
                const li = document.createElement('li');
                li.textContent = error;
                errorList.appendChild(li);
            });
            
            errorDiv.style.display = 'block';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while adding the car. Please try again.');
    });
}

// Clear form and errors when modal is closed
document.getElementById('addCarModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('addCarForm').reset();
    document.getElementById('validationErrors').style.display = 'none';
});
</script>
<?= $this->endSection() ?> 
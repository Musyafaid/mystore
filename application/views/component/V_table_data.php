<style>
    .add-link:hover {
    color: #f8f9fa; /* Light color for text on hover */
    }
</style>

<div class="container mt-4">
                <h2>Manage Products</h2>
                <!-- Example Table for Managing Products -->
                
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title">Product List</h5>
                        <a class="nav-link btn btn-outline-dark align-content-center p-2 add-link" href="<?= base_url('C_admin/view/') ?>"  data-bs-toggle="modal" data-bs-target="#addModal">
                            <i class="bi bi-plus-circle"></i> Add
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
    <?php foreach($barang as $row) : ?>
    <tr>
        <td><?= ++$start ?></td>
        <td><?= htmlspecialchars($row['brg_name']) ?></td>
        <td>Rp. <?= number_format($row['brg_harga'], 2, '.', '.') ?></td>
        <td><?= $row['brg_stok'] ?></td>
        <td>
            <a href="<?= base_url('C_admin/delete_barang?brg_id='). $row['encrypted_brg_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
            <a href="<?= base_url('C_admin/update?brg_id='). $row['encrypted_brg_id'] ?>" class="btn btn-sm btn-primary">Edit</a>
        </td>
    </tr>
    <?php endforeach; ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="pagination-container text-center mt-4">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>

               <?php if ($this->session->flashdata('alertSuccess')) : ?>
                    <script>
                        function alertSuccess() {
                            Swal.fire({
                                title: 'Success',
                                text: '<?php echo $this->session->flashdata('alertSuccess'); ?>',
                                icon: 'success'
                            });
                        }

                        alertSuccess();
                    </script>
                <?php endif; ?>
                <?php if ($this->session->flashdata('alertError')) : ?>
                    <script>
                        function alertSuccess() {
                            Swal.fire({
                                title: 'Error',
                                text: '<?php echo $this->session->flashdata('alertError'); ?>',
                                icon: 'error'
                            });
                        }

                        alertSuccess();
                    </script>
                <?php endif; ?>
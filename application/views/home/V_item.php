<header class="bg-dark py-5 my-5 ">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop homepage template</p>
        </div>
    </div>
</header>

<section class="d-flex justify-content-center">
    <div class="container px-4 px-lg-5 my-2 d-flex flex-wrap gap-4 justify-content-center ">
    <?php foreach($kategori as $row) : ?>
    <a href="<?= base_url('C_home/kategori/').$row['kategori_id'] ?>" class="btn border-1 border-success-subtle btn-outline-success small"><?= $row['kategori_name'] ?></a>
    <?php endforeach ; ?>
    </div>
</section>

<!-- Section -->
<section class="py-5">
    <div class="container px-4 ">
        <h3 class="">Kategori : 
            <?php if($this->session->flashdata('kategori')) :?>
                <?=    $this->session->flashdata('kategori') ?>
            <?php endif; ?>

        </h3>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 flex-wrap">
            <?php foreach($barang as $row) : ?>
                <div class="mb-5">
                        <div class="card h-100" style="width: 200px;"> <!-- Set a specific width for the card -->
                            <!-- Product image -->
                            <img class="card-img-top" width="100" src="<?= base_url('uploads/' . $row['brg_gambar']) ?>" alt="<?= htmlspecialchars($row['brg_name']) ?>" style="height: auto;" /> <!-- Reduced width -->
                            <!-- Product details -->
                            <div class="card-body p-2"> <!-- Reduced padding -->
                                <div class="text-center">
                                    <h5 class="fw-bolder" style="font-size: 1rem;"><?= htmlspecialchars($row['brg_name']) ?></h5> <!-- Smaller font size -->
                                    Rp. <?= number_format($row['brg_harga'], 2, '.', '.') ?>
                                </div>
                            </div>
                            <div class="card-footer p-2 pt-0 border-top-0 bg-transparent"> <!-- Reduced padding -->
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="<?= base_url('C_home/detail_item/').$row['brg_id'] ?>">View Detail</a>
                                </div>
                            </div>
                        </div>
                </div>

            <?php endforeach; ?>
        </div>

        <div class="pagination-container text-center mt-4">
            <?php echo $this->pagination->create_links(); ?>
        </div>

        
    </div>
</section>

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
                        function alertError() {
                            Swal.fire({
                                title: 'Error',
                                text: '<?php echo $this->session->flashdata('alertError'); ?>',
                                icon: 'error'
                            });
                        }

                        alertError();
                    </script>
                <?php endif; ?>

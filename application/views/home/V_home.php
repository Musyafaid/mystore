<div class="container mt-4">
        <a class="btn btn-primary" href="<?= base_url('C_'.$this->session->userdata('page').'/logout') ?>">Logout</a>
        <div class="row">
            <!-- Example of items array -->

            <!-- Loop through items array -->
            <?php foreach ($barang as $row): ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="<?= $row['brg_gambar'] ?>" class="card-img-top" alt="" style="height: 150px; object-fit: cover;">
                        <div class="card-body p-2">
                            <h6 class="card-title"><?= $row['brg_name'] ?></h6>
                            <p class="card-text">Harga: Rp <?= number_format($row['brg_harga'],2,'.','.') ?> </p>
                            <p class="card-text"><?= $row['brg_stok'] ?></p>
                            <a href="#" class="btn btn-primary btn-sm">Beli</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
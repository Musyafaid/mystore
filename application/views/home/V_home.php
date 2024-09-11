<div class="container mt-4">
        <a class="btn btn-primary" href="<?= base_url('C_'.$this->session->userdata('page').'/logout') ?>">Logout</a>
        <div class="row">
            <!-- Example of items array -->
            <?php
            $items = [
                [
                    'gambar' => 'https://via.placeholder.com/150',
                    'nama' => 'Barang 1',
                    'harga' => 100000,
                    'stok' => 10
                ],
                [
                    'gambar' => 'https://via.placeholder.com/150',
                    'nama' => 'Barang 2',
                    'harga' => 200000,
                    'stok' => 5
                ],
                [
                    'gambar' => 'https://via.placeholder.com/150',
                    'nama' => 'Barang 3',
                    'harga' => 300000,
                    'stok' => 7
                ],
                // Add more items as needed
            ];
            ?>

            <!-- Loop through items array -->
            <?php foreach ($items as $item): ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="<?php echo $item['gambar']; ?>" class="card-img-top" alt="<?php echo $item['nama']; ?>" style="height: 150px; object-fit: cover;">
                        <div class="card-body p-2">
                            <h6 class="card-title"><?php echo $item['nama']; ?></h6>
                            <p class="card-text">Harga: Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></p>
                            <p class="card-text">Stok: <?php echo $item['stok']; ?></p>
                            <a href="#" class="btn btn-primary btn-sm">Beli</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
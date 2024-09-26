<section id="detail" class="d-block my-5 py-5 mx-auto" style="width:75%; height:auto;">
    <div class="col-11 d-block gap-4 flex-wrap h-auto">
        <?php foreach($barang as $row) : ?>
        <div class="card shadow-sm mb-4 " >
            <div class="row g-0 w-auto d-flex justify-content-between">
                <div class="col-md-6 w-auto " style="display: block;">
                    <img src="<?= base_url('uploads/') . $row['brg_gambar'] ?>" alt="<?= $row['brg_name'] ?>" 
                         class="img-fluid rounded-start" 
                         style="border-radius: 15px 0 0 15px; max-height: 370px; max-width: 100%; object-fit: contain;"> <!-- Set max dimensions -->
                </div>

                <div class="col d-block py-2 d-flex h-auto flex-column px-2 " >
                    <div>
                        <h5 class="m-0 mb-2" style="font-size: 1.5rem;"><?= $row['brg_name'] ?></h5> <!-- Increased font size -->
                        <div class="border-bottom border-success text-center mb-2 pb-1">
                            <span class="text-success fw-bold">Detail</span>
                        </div>
                        <p class="small mb-1">Description: <?= $row['description'] ?></p>
                        <p class="small mb-1">Stock: <span class="fw-bold"><?= $row['brg_stok'] ?></span></p>
                        <span class="text-secondary small">
                            <i class="bi bi-geo-alt-fill"></i> Shipped from: <?= $row['pj_alamat'] ?>
                        </span>
                    </div>

                    <form action="<?= site_url('C_home/add_to_cart') ?>" method="post">
                        <input type="hidden" name="brg_id" value="<?= $row['brg_id'] ?>">
                        <input type="hidden" name="brg_name" value="<?= $row['brg_name'] ?>">
                        <input type="hidden" name="brg_harga" value="<?= $row['brg_harga'] ?>" class="brg_harga">
                        <input type="hidden" name="brg_gambar" value="<?= $row['brg_gambar'] ?>">
                        <input type="hidden" name="max_qty" value="<?= $row['brg_stok'] ?>">
                        
                        <div class="d-block mt-3 align-items-center gap-2 my-2">
                            <input type="number" name="quantity" value="1" min="1" max="<?= $row['brg_stok'] ?>" class="form-control me-2 qty-input" style="width: 70px;">
                            <span class="total-price fw-bold text-success text-center" id="total-price-<?= $row['brg_id'] ?>">Rp <?= number_format($row['brg_harga'], 0, ',', '.') ?></span>
                        </div>
                        <button type="submit" class="btn btn-success">Add to Cart</button>
                    </form>

                    <div class="border-top h-100 d-flex align-items-center border-secondary-subtle py-2 mt-3">
                       
                        <div class="d-flex h-auto align-items-center">
                            <img class="rounded-circle me-3" src="<?= base_url('uploads/') . $row['pj_gambar'] ?>" alt="Seller Image" width="50" height="50">
                            <div>
                                <p class="mb-0 fw-bold"><?= $row['pj_name'] ?></p>
                                <p class="mb-0 text-muted">From: <?= $row['pj_alamat'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<script>
    document.querySelectorAll('.qty-input').forEach(function(input) {
        input.addEventListener('input', function() {
            const harga = parseFloat(this.closest('form').querySelector('.brg_harga').value);
            const quantity = parseInt(this.value);
            const totalPriceElement = this.closest('form').querySelector('.total-price');

            if (!isNaN(harga) && !isNaN(quantity)) {
                const totalPrice = harga * quantity;
                totalPriceElement.textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
            }
        });
    });
</script>

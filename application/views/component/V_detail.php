<section id="detail" class=" d-flex justify-content-center my-5 ">
            <div class=" col-11 d-flex justify-content-center gap-4">
                <?php foreach($barang as $row) :?>
                <div class="w-50 py-1">

                    <img src="<?= base_url('uploads/').$row['brg_gambar']?>" alt="" class="w-100 h-100">
                </div>
                
                
                <div class="w-50 align-baseline">
                    <h5 class="m-0"><?= $row['brg_name'] ?></h5>
                    <p class="my-1 small">Stok <?= $row['brg_stok'] ?></p>
                    <div class="mb-0 py-0">
                        <span class="border-2 border-bottom border-success text-center">
                            Detail
                        </span>
                        <p class="mb-0"><?= $row['description'] ?></p>
                    </div>
                    <div class="mb-2 text">
                        <span class="text-secondary"> <i class="bi bi-geo-alt "></i> Dikirim dari : <?= $row['pj_alamat'] ?></span>
                    </div>
                    <div>
                        <a href="" class="btn btn-success">Checkout</a>
                    </div>
                </div>
                <?php endforeach ;?>
            </div>
</section>
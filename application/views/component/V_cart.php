<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



<?php if(validation_errors()) : ?>
<script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            myModal.show();
        });
    </script>
<?php endif ;?>


<style>
    
input[type="file"] {
            display: none; 
        }

        .custom-file-label {
            display: inline-block;    
        }
        .custom-file-field {
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
            border: 1px solid #ced4da;
            border-radius: 4px;
            width: 100%;
            text-align: left;
        }
    .modal-backdrop {
    background-color: rgba(0, 0, 0, 0.6);
  }

    .modal-body input, 
    .modal-body textarea {
    width: 100%; 
    padding: 10px; 
    font-size: 1.1rem; 
  }

  .modal-body label {
    font-size: 1.1rem; 
  }
</style>

<div class="container my-5">
    <h2 class="mb-4">Shopping Cart</h2>

    <?php if (!empty($cart_items)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart_items as $item): ?>
                    <tr>
                        <td>
                            <img src="<?= base_url('uploads/') . $item['gambar'] ?>" alt="<?= $item['name'] ?>" width="50" height="50">
                            <?= $item['name'] ?>
                        </td>
                        <td>Rp <?= number_format($item['price'], 2, ',', '.') ?></td>
                        <td>
                            <input type="number" name="cart[<?= $item['rowid'] ?>]" value="<?= $item['qty'] ?>" min="1" max="<?= $item['max_qty'] ?>" class="form-control qty-input" style="width: 70px;" data-price="<?= $item['price'] ?>" data-rowid="<?= $item['rowid'] ?>">
                        </td>
                        <td class="subtotal" id="subtotal-<?= $item['rowid'] ?>">Rp <?= number_format($item['subtotal'], 2, ',', '.') ?></td>
                        <td>
                            <a href="<?= site_url('C_home/remove_item/' . $item['rowid']) ?>" class="btn btn-danger btn-sm">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center">
            <h4>Total: <span id="total"><?= 'Rp ' . number_format($total, 2, ',', '.') ?></span></h4>
            <a href="<?= site_url('C_home/clear_cart') ?>" class="btn btn-danger">Clear Cart</a>
        </div>
        <button type="button" class="btn btn-success mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Buy Now..
        </button>
    <?php else: ?>
        <div class="alert alert-info">Your cart is empty.</div>
    <?php endif; ?>
    
    
    <a href="<?= site_url('C_home/landing/') ?>" class="btn btn-primary mt-4">Continue Shopping</a>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Alamat Penerima</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <form method="post" action="">
                    <div class="modal-body">
                                <div class="card-body d-flex justify-content-center gap-4">
                                    <div class="w-50">
                                        <div class="mb-5">
                                            <label for="province_id" class="form-label">Provinsi</label>
                                            <select name="province_id" id="province_id" class="form-control">
                                                <option value="">Pilih Provinsi</option>
                                            </select>
                                            <?php if(validation_errors()) : ?>
                                                <small class="m-1 text-danger position-absolute  my-0 mx-2 small"><?=  form_error('province_id'); ?></small>
                                            <?php endif ; ?>
                                            
                                        </div>

                                        <div class="mb-5">
                                            <label for="city_id" class="form-label">Kota/Kabupaten</label>
                                            <select name="city_id" id="city_id" class="form-control" disabled>
                                                <option value="">Pilih Kota</option>
                                            </select>
                                            <?php if(validation_errors()) : ?>
                                                <small class="m-1 text-danger position-absolute  my-0 mx-2 small"><?=  form_error('city_id'); ?></small>
                                            <?php endif ; ?>
                                        </div>
                                        
                                        <div class="mb-5">
                                            <label for="district_id" class="form-label">Kecamatan</label>
                                            <select name="district_id" id="district_id" class="form-control" disabled>
                                                <option value="">Pilih Kecamatan</option>
                                            </select>
                                            <?php if(validation_errors()) : ?>
                                                <small class="m-1 text-danger position-absolute  my-0 mx-2 small"><?=  form_error('district_id'); ?></small>
                                            <?php endif ; ?>
                                        </div>
                                        
                                        <div class="mb-5">
                                            <label for="subdistrict_id" class="form-label">Kelurahan</label>
                                            <select name="subdistrict_id" id="subdistrict_id" class="form-control" disabled>
                                                <option value="">Pilih Kelurahan</option>
                                            </select>
                                            <?php if(validation_errors()) : ?>
                                                <small class="m-1 text-danger position-absolute  my-0 mx-2 small"><?=  form_error('subdistrict_id'); ?></small>
                                            <?php endif ; ?>
                                        </div>
                                    </div>
                                    
                                    <div class="w-50">
                                        <div class="mb-5">
                                            <label for="postal_code" class="form-label">Kode Pos</label>
                                            <input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="Masukkan kode pos" disabled readonly>
                                        </div>
                                        
                                        <div class="mb-5">
                                            <label for="address" class="form-label">Alamat Lengkap</label>
                                            <textarea class="form-control" name="address" id="address" rows="4" placeholder="Masukkan alamat lengkap"></textarea>
                                            <?php if(validation_errors()) : ?>
                                                <small class="m-1 text-danger position-absolute  my-0 mx-2 small"><?=  form_error('address'); ?></small>
                                            <?php endif ; ?>
                                        </div>

                                        <div class="mb-5">
                                            <label for="catatan" class="form-label">Catatan (Optional)</label>
                                            <input type="text" class="form-control" name="catatan" id="catatan" placeholder="Masukkan catatan">
                                        </div>

                                        <!-- Hidden inputs for selected names and postal code -->
                                        <input type="hidden" name="selected_province_name" id="selected_province_name">
                                        <input type="hidden" name="selected_city_name" id="selected_city_name">
                                        <input type="hidden" name="selected_district_name" id="selected_district_name">
                                        <input type="hidden" name="selected_subdistrict_name" id="selected_subdistrict_name">
                                        <input type="hidden" name="selected_postal_code" id="selected_postal_code">
                                    </div>
                                </div>
                            
                            </div>
                            <div class="modal-footer">
                                <a href="<?= base_url('C_home/view_cart/') ?>" class="btn btn-danger">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {
    // Saat kuantitas berubah
    $('.qty-input').on('input', function() {
        const rowId = $(this).data('rowid');
        const price = $(this).data('price');
        let qty = parseInt($(this).val());
        const maxQty = parseInt($(this).attr('max'));

        // Validasi qty
        if (qty > maxQty) {
            qty = maxQty;
            $(this).val(maxQty);
        } else if (qty < 1) {
            qty = 1;
            $(this).val(1); 
        }

        // Hitung subtotal
        const subtotal = price * qty;
        $('#subtotal-' + rowId).text(
            new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(subtotal)
        );

        // Update total
        let total = 0;
        $('.subtotal').each(function() {
            const subtotalValue = parseFloat($(this).text().replace(/[Rp. ]/g, '').replace(',', '.'));
            total += subtotalValue;
        });
        $('#total').text(
            new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(total)
        );

        // Kirim update ke server via AJAX
        $.ajax({
            url: '<?= site_url("C_home/update_cart") ?>',
            type: 'POST',
            data: {
                rowid: rowId,
                qty: qty
            },
            success: function(response) {
                let res = JSON.parse(response);
                if (res.status === 'success') {
                    console.log('Cart updated successfully!');
                } else {
                    alert('Failed to update cart.');
                }
            },
            error: function() {
                alert('Failed to update cart. Please try again.');
            }
        });
    });
});
</script>

<script>
    $(document).ready(function() {
        $.ajax({
            url: 'https://alamat.thecloudalert.com/api/provinsi/get/',
            method: 'GET',
            success: function(response) {
                if (response.status === 200 && response.result) {
                    $.each(response.result, function(index, province) {
                        $('#province_id').append('<option value="' + province.id + '">' + province.text + '</option>');
                    });
                }
            },
            error: function() {
                alert('Gagal mengambil data provinsi. Silakan coba lagi.');
            }
        });

        $('#province_id').change(function() {
            var provinceId = $(this).val();
            $('#city_id').empty().append('<option value="">Pilih Kota</option>').prop('disabled', true);
            $('#district_id').empty().append('<option value="">Pilih Kecamatan</option>').prop('disabled', true);
            $('#subdistrict_id').empty().append('<option value="">Pilih Kelurahan</option>').prop('disabled', true);
            $('#postal_code').val('');

            if (provinceId) {
                $('#city_id').prop('disabled', false);

                $.ajax({
                    url: 'https://alamat.thecloudalert.com/api/kabkota/get/?d_provinsi_id=' + provinceId,
                    method: 'GET',
                    success: function(response) {
                        if (response.status === 200 && response.result) {
                            $.each(response.result, function(index, city) {
                                $('#city_id').append('<option value="' + city.id + '">' + city.text + '</option>');
                            });
                        }
                    },
                    error: function() {
                        alert('Gagal mengambil data kota. Silakan coba lagi.');
                    }
                });

              
                $('#selected_province_name').val($('#province_id option:selected').text());
            }
        });

        $('#city_id').change(function() {
            var cityId = $(this).val();
            var cityName = $(this).find('option:selected').text(); 
            $('#district_id').empty().append('<option value="">Pilih Kecamatan</option>').prop('disabled', true);
            $('#subdistrict_id').empty().append('<option value="">Pilih Kelurahan</option>').prop('disabled', true);
            $('#postal_code').val('');

         
            $('#selected_city_name').val(cityName);

            if (cityId) {
                $('#district_id').prop('disabled', false);

                $.ajax({
                    url: 'https://alamat.thecloudalert.com/api/kecamatan/get/?d_kabkota_id=' + cityId,
                    method: 'GET',
                    success: function(response) {
                        if (response.status === 200 && response.result) {
                            $.each(response.result, function(index, district) {
                                $('#district_id').append('<option value="' + district.id + '">' + district.text + '</option>');
                            });
                        }
                    },
                    error: function() {
                        alert('Gagal mengambil data kecamatan. Silakan coba lagi.');
                    }
                });
            }
        });

        $('#district_id').change(function() {
            var districtId = $(this).val();
            var districtName = $(this).find('option:selected').text(); // Get the selected district name
            $('#subdistrict_id').empty().append('<option value="">Pilih Kelurahan</option>').prop('disabled', true);
            $('#postal_code').val('');
            
            $('#selected_district_name').val(districtName);
            
            if (districtId) {
                $('#subdistrict_id').prop('disabled', false);
                
                $.ajax({
                    url: 'https://alamat.thecloudalert.com/api/kelurahan/get/?d_kecamatan_id=' + districtId,
                    method: 'GET',
                    success: function(response) {
                        if (response.status === 200 && response.result) {
                            $.each(response.result, function(index, subdistrict) {
                                $('#subdistrict_id').append('<option value="' + subdistrict.id + '">' + subdistrict.text + '</option>');
                            });
                        }
                    },
                    error: function() {
                        alert('Gagal mengambil data kelurahan. Silakan coba lagi.');
                    }
                });
            }
        });

        $('#subdistrict_id').change(function() {
    var cityId = $('#city_id').val();
    var districtId = $('#district_id').val();
    var subdistrictId = $(this).val();

    if (cityId && districtId && subdistrictId) {
        // Fetch postal code based on selected subdistrict
        $.ajax({
            url: 'https://alamat.thecloudalert.com/api/kodepos/get/?d_kabkota_id=' + cityId + '&d_kecamatan_id=' + districtId + '&d_kelurahan_id=' + subdistrictId,
            method: 'GET',
            success: function(response) {
                if (response.status === 200 && response.result) {
                    var postalCode = response.result[0].text; // Assuming you want the first postal code
                    $('#postal_code').val(postalCode);
                    // Set the hidden input for the selected postal code
                    $('#selected_postal_code').val(postalCode);
                }
            },
            error: function() {
                alert('Gagal mengambil kode pos. Silakan coba lagi.');
            }
        });
    }
});
    });
 
</script>




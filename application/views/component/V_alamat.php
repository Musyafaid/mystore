
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
    </style>


<div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Data Alamat</h5>
                    </div>
                    <form method="post" action="">
                        <div class="card-body d-flex justify-content-center gap-4">
                            <div class="w-50">
                                <div class="mb-3">
                                    <label for="province_id" class="form-label">Provinsi</label>
                                    <select name="province_id" id="province_id" class="form-control">
                                        <option value="">Pilih Provinsi</option>
                                        <!-- Options will be populated here -->
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="city_id" class="form-label">Kota/Kabupaten</label>
                                    <select name="city_id" id="city_id" class="form-control" disabled>
                                        <option value="">Pilih Kota</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="district_id" class="form-label">Kecamatan</label>
                                    <select name="district_id" id="district_id" class="form-control" disabled>
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="subdistrict_id" class="form-label">Kelurahan</label>
                                    <select name="subdistrict_id" id="subdistrict_id" class="form-control" disabled>
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="w-50">
                                <div class="mb-3">
                                    <label for="postal_code" class="form-label">Kode Pos</label>
                                    <input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="Masukkan kode pos" disabled readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control" name="address" id="address" rows="5" placeholder="Masukkan alamat lengkap"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Catatan</label>
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
                        <div class="card-footer d-flex justify-content-end gap-2">
                            <a href="#" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        // Fetch provinces
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

                // Set the hidden input value for the selected province name
                $('#selected_province_name').val($('#province_id option:selected').text());
            }
        });

        $('#city_id').change(function() {
            var cityId = $(this).val();
            var cityName = $(this).find('option:selected').text(); // Get the selected city name
            $('#district_id').empty().append('<option value="">Pilih Kecamatan</option>').prop('disabled', true);
            $('#subdistrict_id').empty().append('<option value="">Pilih Kelurahan</option>').prop('disabled', true);
            $('#postal_code').val('');

            // Set the hidden input value for the city name
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
            
            // Set the hidden input value for the district name
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
</script>


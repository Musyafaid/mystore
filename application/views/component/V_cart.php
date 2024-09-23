<div class="container my-5">
    <h2 class="mb-4">Shopping Cart</h2>

    <?php if ($this->session->flashdata('alertSuccess')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('alertSuccess'); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($cart_items)): ?>
        <table class="table table-bordered">
            <thead class="thead-light">
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
                            <input max="<?= $item['max_qty'] ?>" type="number" name="cart[<?= $item['rowid'] ?>]" value="<?= $item['qty'] ?>" min="1" class="form-control qty-input" style="width: 70px;" data-price="<?= $item['price'] ?>" data-rowid="<?= $item['rowid'] ?>">
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
            <h4><span id="total"><?= 'Rp ' . number_format($total, 2, ',', '.') ?></span></h4>
            <a href="<?= site_url('C_home/clear_cart') ?>" class="btn btn-danger">Clear Cart</a>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Your cart is empty.</div>
    <?php endif; ?>
    
    <a href="<?= site_url('C_home/landing') ?>" class="btn btn-primary mt-4">Continue Shopping</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {
    $('.qty-input').on('input', function() {
        const rowId = $(this).data('rowid');
        const price = $(this).data('price');
        const qty = parseInt($(this).val());
        const maxQty = parseInt($(this).attr('max'));
        
        // Ensure quantity does not exceed max_qty
        if (qty > maxQty) {
            $(this).val(maxQty); // Reset to max quantity
        } else if (qty < 1) {
            $(this).val(1); // Reset to 1 if less than 1
        }

        const subtotal = price * $(this).val();
        $('#subtotal-' + rowId).text(
            new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(subtotal)
        );

        // Update the total
        let total = 0;
        $('.subtotal').each(function() {
            const subtotalValue = parseFloat($(this).text().replace(/[Rp. ]/g, '').replace(',', '.')); // Remove currency formatting
            total += subtotalValue;
        });
        $('#total').text(
            new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(total)
        );
    });
});
</script>

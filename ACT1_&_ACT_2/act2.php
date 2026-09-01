<form method="get" action="">
    <label for="total">enter cart total</label>
    <input type="number" step="0.01" id="total" name="total" required>
    <button type="submit">calculate</button>
</form>

<?php
if (isset($_GET['total'])) {
    $total = (float)$_GET['total'];
    $discount_rate = 0;

    if ($total >= 200) {
        $discount_rate = 0.20;
    } elseif ($total >= 100) {
        $discount_rate = 0.15;
    } elseif ($total >= 50) {
        $discount_rate = 0.10;
    }

    $discount_amount = $total * $discount_rate;
    $final_price = $total - $discount_amount;

    echo "<p>original price: ₱" . number_format($total, 2) . "</p>";
    echo "<p>discount amount: ₱" . number_format($discount_amount, 2) . "</p>";
    echo "<p>final price: ₱" . number_format($final_price, 2) . "</p>";
}
?>
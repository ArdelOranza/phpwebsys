<form method="get" action="">
    <label for="number">enter a number</label>
    <input type="number" id="number" name="number" required>
    <button type="submit">submit</button>
</form>

<?php
if (isset($_GET['number'])) {
    $number = (int)$_GET['number'];

    if ($number > 0) {
        if ($number % 2 === 0) {
            echo "the number $number is positive and even.";
        } else {
            echo "the number $number is positive and odd.";
        }
    } elseif ($number < 0) {
        echo "the number $number is negative.";
    } else {
        echo "the number is zero.";
    }
}
?>
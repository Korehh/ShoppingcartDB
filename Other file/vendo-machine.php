<?php
    $products = [
        'Coke' => 15,
        'Sprite' => 20,
        'Royal' => 20,
        'Pepsi' => 15,
        'Mountain Dew' => 20
    ];

    $sizes = [
        0 => 'Regular',
        5 => 'Up-Size',
        10 => 'Jumbo'
    ];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendo Machine</title>
</head>
<body>
    <h1>Vendo Machine</h1>

    <form method="post">
        <fieldset style="width: 500px;">
            <legend>Products:</legend>
            <?php
                if(isset($products)) {
                    foreach($products as $product => $cost) {
                        echo '<input type="checkbox" name="products[]" id="' . $product . '" value="' . $product . '">';
                        echo '<label for="' . $product . '">' . $product . ' - ₱ '. $cost .'</label><br>';                     
                    }
                }
            ?>
        </fieldset>
        <fieldset style="width: 500px;">
            <legend>Options:</legend>
            <label for="size">Select Size: </label>
            <select name="size" id="size">
                <?php
                    if(isset($sizes)) {
                        foreach($sizes as $additional_cost => $size) {
                            echo '<option value="' . $additional_cost . '">' . $size . ($additional_cost > 0 ? ' (add ₱ ' . $additional_cost . ')' : '') . '</option>';
                        }
                    }
                ?>
            </select>
            
            <label for="qty">Quantity: </label>
            <input type="number" name="qty" id="qty" min="0" max="100" value="0">

            <button type="submit" name="btn_checkout">
                Check Out
            </button>
        </fieldset>
    </form>

    <?php
        if(isset($_POST['btn_checkout'])) {
            if(isset($_POST['products']) && $_POST['qty'] > 0) {
                $selected_products = $_POST['products'];
                $additional_cost = $_POST['size'];
                $qty = $_POST['qty'];
                $total_amount = 0;

                echo '<br><hr><br><h3>Purchase Summary:</h3>';
                echo '<ul>';
                    foreach($selected_products as $selected_product) {
                        $amount = ($products[$selected_product] + $additional_cost) * $qty;
                        $total_amount += $amount;
                        echo '<li>' . $qty . ($qty > 1 ? ' pieces of ' : ' peice of ') . $sizes[$additional_cost] . ' ' . $selected_product . ' amounting to ₱ ' . $amount . '</li>';
                    }
                echo '</ul>';
                echo '<b>Total Number of Items: </b>' . count($selected_products) * $qty . '<br>';
                echo '<b>Total Amount:</b>' . $total_amount;
            }
            else
                echo '<br><hr><br>Cannot Proceed to Check Out! Please Select a product!';
        }
    ?>
</body>
</html>
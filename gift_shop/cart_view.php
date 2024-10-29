<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
</head>
<body>
    <h1>Your Shopping Cart</h1>
    
    <?php if (empty($items)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($items as $productId => $quantity): ?>
                <li>
                    Product ID: <?php echo $productId; ?> - Quantity: <?php echo $quantity; ?>
                    <form action="/cart/update" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                        <input type="number" name="quantity" value="<?php echo $quantity; ?>">
                        <button type="submit">Update Quantity</button>
                    </form>
                    <a href="/cart/remove?product_id=<?php echo $productId; ?>">Remove</a>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="/cart/clear">Clear Cart</a>
    <?php endif; ?>
</body>
</html>

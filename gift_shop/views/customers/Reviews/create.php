<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Review</title>
</head>
<body>
    <h1>Product Reviews</h1>
    <form action="/customers/reviews/store" method="POST">
        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product_id); ?>"> <!-- Add the product ID -->
        
        <label for="rating">Rating (1-5):</label>
        <input type="number" name="rating" id="rating" min="1" max="5" required>
        
        <label for="review_text">Review:</label>
        <textarea name="review_text" id="review_text" required></textarea>
        
        <button type="submit">Submit Review</button>
    </form>
    <a href="/customers/product/details">Back to Product</a>
</body>
</html>

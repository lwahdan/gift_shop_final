<!-- views/reviews/index.php -->
<h3>Product Reviews</h3>
<?php if (!empty($reviews)): ?>
    <?php foreach ($reviews as $review): ?>
        <div class="review">
            <p>Rating: <?= htmlspecialchars($review['rating']) ?>/5</p>
            <p><?= htmlspecialchars($review['review_text']) ?></p>
            <small>Reviewed on: <?= htmlspecialchars($review['created_at']) ?></small>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No reviews yet.</p>
<?php endif; ?>

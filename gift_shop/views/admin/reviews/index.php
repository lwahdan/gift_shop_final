<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>

<div class="cont">

    <h2>Reviews</h2>
</div>

<?php
echo '<div class="cardBox">';
if (isset($reviews)) {
    foreach ($reviews as $review) {
        echo '
            <div class="card">
                <div>
                    <div class="numbers2">
                        <h3>Review by user id: ' . htmlspecialchars($review['id']) . '</h3>
                        <h4>' . htmlspecialchars($review['review_text']) . '</h4>
                        <div class="rating-stars">';

        // Display a star icon for each rating point
        for ($i = 0; $i < $review['rating']; $i++) {
            echo '<ion-icon name="star-sharp" style="color: gold"></ion-icon>';
        }

        echo '        </div>
                    </div>
                    <div class="cardName" style="font-size: 15px">' . htmlspecialchars($review['updated_at']) . '</div>
                </div>
                <div class="iconBx" style="display: inline-grid;">
                    <a href="/admin/reviews/toggleStatus/' . $review['id'] . '/' . ($review['status'] ? 0 : 1) . '" class="' . ($review['status'] == 1 ? 'btn-danger' : 'btn-Green') . '">
                        ' . ($review['status'] ? 'Disapprove' : 'Approve') . '
                    </a>
                </div>
            </div>';
    }
} else {
    echo '<p>No reviews found.</p>';
}
echo '</div>';
?>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>

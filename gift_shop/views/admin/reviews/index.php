<?php
$review_active = "active";

require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Reviews</h6>
                    </div>
                    <div class="card-body pb-0 p-3">
                        <div class="row g-4">
                            <?php
                            if (isset($reviews)) {
                                foreach ($reviews as $review) {
                                    echo '
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h3 class="card-title " style="color:#dabd8e ">User name: ' . htmlspecialchars($review['id']) . '</h3>
                                            <p class="card-text">' . htmlspecialchars($review['review_text']) . '</p>
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="rating-stars">';

                                    // Display a star icon for each rating point
                                    for ($i = 0; $i < $review['rating']; $i++) {
                                        echo '<ion-icon name="star-sharp" style="color: gold"></ion-icon>';
                                        if ($i == $review['rating']-1) {
                                            for ($j = $i; $j < 4; $j++) {
                                                echo '<ion-icon name="star-outline" style="color: gold"></ion-icon>';
                                            }
                                        }
                                    }

                                    echo '        </div>
                                            </div>
                                            <p class="card-text"><small class="text-muted">' . htmlspecialchars($review['updated_at']) . '</small></p>
                                        </div>
                                        <div class="card-footer d-flex justify-content-end">
                              
                                         <a href="/admin/reviews/toggleStatus/' . $review['id'] . '/' . ($review['status'] ? 0 : 1) . '">
    <span class="status-badge ' . ($review['status'] == 1 ? 'status-enabled' : 'status-disabled') . '">
        ' . ($review['status'] ? 'Disapprove' : 'Approve') . '
    </span>
</a>

                                        </div>
                                    </div>
                                </div>';
                                }
                            } else {
                                echo '<p>No reviews found.</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>

    </style>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>
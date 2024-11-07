<?php
$review_active = "active";
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Reviews</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Reviews</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <!-- Search Input -->
                <div class="input-group me-3">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Search by Review ID" id="reviewSearchInput" onkeyup="filterReviews()">
                </div>
                <!-- Status Filter Dropdown -->
                <select class="form-select" id="statusFilter" onchange="filterReviews()">
                    <option value="all">All</option>
                    <option value="approved">Approve</option>
                    <option value="disapproved">Disapprove</option>
                </select>
            </div>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="/admin/logout" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg h-100">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Reviews</h6>
                </div>
                <div class="card-body pb-0 p-3">
                    <div class="row g-4" id="reviewsContainer">
                        <?php
                        if (isset($reviews)) {
                            foreach ($reviews as $review) {
                                echo '
                            <div class="col-md-6 col-lg-4 review-card" data-review-id="' . htmlspecialchars($review['id']) . '" data-review-status="' . ($review['status'] ? 'approved' : 'disapproved') . '">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h3 class="card-title" style="color:#dabd8e">From: ' . htmlspecialchars($review['username']) . '</h3>
                                        <h5 class="card-text"> product_id: ' . htmlspecialchars($review['product_id']) . '</h5>
                                        <p class="card-text">' . htmlspecialchars($review['review_text']) . '</p>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="rating-stars">';

                                // Display star icons based on rating
                                for ($i = 0; $i < $review['rating']; $i++) {
                                    echo '<ion-icon name="star-sharp" style="color: gold"></ion-icon>';
                                }
                                for ($j = $review['rating']; $j < 5; $j++) {
                                    echo '<ion-icon name="star-outline" style="color: gold"></ion-icon>';
                                }

                                echo '        </div>
                                        </div>
                                        <p class="card-text"><small class="text-muted">' . htmlspecialchars($review['updated_at']) . '</small></p>
                                    </div>
                                    <div class="card-footer d-flex justify-content-end">
                                        <a href="/admin/reviews/toggleStatus/' . htmlspecialchars($review['id']) . '/' . ($review['status'] ? 0 : 1) . '">
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

<script>
    function filterReviews() {
        const input = document.getElementById("reviewSearchInput").value.toLowerCase();
        const status = document.getElementById("statusFilter").value;
        const cards = document.querySelectorAll(".review-card");

        cards.forEach(card => {
            const reviewId = card.getAttribute("data-review-id").toLowerCase();
            const reviewStatus = card.getAttribute("data-review-status").toLowerCase();

            // Show card if it matches search input and status filter
            const matchesId = reviewId.includes(input);
            const matchesStatus = (status === "all") || (reviewStatus === status);

            if (matchesId && matchesStatus) {
                card.style.display = "";
            } else {
                card.style.display = "none";
            }
        });
    }
</script>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>

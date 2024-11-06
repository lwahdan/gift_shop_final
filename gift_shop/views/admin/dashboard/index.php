<?php

$totalProducts = count($data['totalProducts']);
$totalUsers = count($data['totalUsers']);
$dashboard_active = "active";
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";

?>


<div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-6 col-12">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
              <div class="card">
                <span class="mask bg-primary opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                  <div class="row">
                    <div class="col-8 text-start">
                      <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                        <i class="ni text-dark text-gradient text-lg opacity-10" aria-hidden="true">  <ion-icon name="people-outline"></ion-icon></i>
                      </div>
                      <h5 class="text-white font-weight-bolder mb-0 mt-3">
                      <?php echo $totalUsers; ?>
                      </h5>
                      <span class="text-white text-sm">Total Users</span>
                    </div>
                    <div class="col-4">
                     
                      <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0"></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
              <div class="card">
                <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                  <div class="row">
                    <div class="col-8 text-start">
                      <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                      <i class="ni text-dark text-gradient text-lg opacity-10" aria-hidden="true"><ion-icon name="cube-outline"></ion-icon></i>
                      </div>
                      <h5 class="text-white font-weight-bolder mb-0 mt-3">
                      <?php echo $totalProducts; ?>
                      </h5>
                      <span class="text-white text-sm">Total Products</span>
                    </div>
                    <div class="col-4">
                      <div class="dropstart text-end mb-6">
                     
                      </div>
                      <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0"></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-lg-6 col-md-6 col-12">
              <div class="card">
                <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                  <div class="row">
                    <div class="col-8 text-start">
                      <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                      <i class="ni text-dark text-gradient text-lg opacity-10" aria-hidden="true">  <ion-icon name="chatbubbles-outline"></ion-icon></i>
                      </div>
                      <h5 class="text-white font-weight-bolder mb-0 mt-3">
                      <?php echo $totalComments; ?>
                      </h5>
                      <span class="text-white text-sm">Total Reviews</span>
                    </div>
                    <div class="col-4">
                      <div class="dropdown text-end mb-6">
                       
                       
                      </div>
                      <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0"></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
              <div class="card">
                <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                  <div class="row">
                    <div class="col-8 text-start">
                      <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                      <i class="ni text-dark text-gradient text-lg opacity-10" aria-hidden="true">   <ion-icon name="pricetags-outline"></ion-icon></i>
                      </div>
                      <h5 class="text-white font-weight-bolder mb-0 mt-3">
                      <?php echo $totalCoupons; ?>
                      </h5>
                      <span class="text-white text-sm">Total Coupons</span>
                    </div>
                    <div class="col-4">
                      <div class="dropstart text-end mb-6">
                        
                      </div>
                      <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0"></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-12 mt-4 mt-lg-0">
          <div class="card shadow h-100">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Reviews</h6>
            </div>
            <div class="card-body pb-0 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-0">
                  <div class="w-100">
                    <div class="d-flex mb-2">
                      <span class="me-2 text-sm font-weight-bold text-dark">All Reviews</span>
                      <span class="ms-auto text-sm font-weight-bold"><?php echo $totalComments; ?></span>
                    </div>
                    <div>
                      <div class="progress progress-md">
                      <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo 100; ?>%;" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>

                      </div>
                    </div>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                  <div class="w-100">
                    <div class="d-flex mb-2">
                      <span class="me-2 text-sm font-weight-bold text-dark">Neutral Reviews</span>
                      <span class="ms-auto text-sm font-weight-bold">17</span>
                    </div>
                    <div>
                      <div class="progress progress-md">
                      <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo 17/19*100; ?>%;" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                  <div class="w-100">
                    <div class="d-flex mb-2">
                      <span class="me-2 text-sm font-weight-bold text-dark">Negative Reviews</span>
                      <span class="ms-auto text-sm font-weight-bold">2</span>
                    </div>
                    <div>
                      <div class="progress progress-md">
                      <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo 2/19*100; ?>%;" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <div class="card-footer pt-0 p-3 d-flex align-items-center">
              <div class="w-60">
                <p class="text-sm">
                </p>
              </div>
              <div class="w-40 text-end">
                <a class="btn btn-dark mb-0 text-end" href="/admin/reviews">View all reviews</a>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>
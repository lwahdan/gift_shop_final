<?php

$totalProducts = count($data['totalProducts']);
$totalUsers = count($data['totalUsers']);
$dashboard_active = "active";
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";

?>
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Dashboard</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Type here...">
                    </div>
                </div>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <a href="/admin/logout" class="nav-link text-body font-weight-bold px-0">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">Sign Out</span>
                        </a>
                    </li>
                </ul>
                </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

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
                      <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo (17/$totalComments)*100; ?>%;" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
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
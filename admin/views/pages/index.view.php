<?php
require "./dashboard.php";
$obj=new dashboard();
?>
    <!-- ======================= Cards ================== -->
    <div class="cardBox">
        <div class="card">
            <div>
                <div class="numbers">
                    <?php
                    echo  $obj->totalUsers();
                    ?>
                </div>
                <div class="cardName">Total Users</div>
            </div>

            <div class="iconBx">
                <ion-icon name="people-outline"></ion-icon>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers">
                    <?php
                    echo  $obj->totalProducts();
                    ?>
                </div>
                <div class="cardName">Total Products</div>
            </div>

            <div class="iconBx">
                <ion-icon name="cube-outline"></ion-icon>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers">
                    <?php
                    echo  $obj->totalComments();
                    ?>
                </div>
                <div class="cardName">Total Comments</div>
            </div>

            <div class="iconBx">
                <ion-icon name="chatbubbles-outline"></ion-icon>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers">
                    <?php
                    echo  $obj->totalCoupons()
                    ?>
                </div>
                <div class="cardName">Total Coupons</div>
            </div>

            <div class="iconBx">
                <ion-icon name="pricetags-outline"></ion-icon>
            </div>
        </div>
    </div>


</div>

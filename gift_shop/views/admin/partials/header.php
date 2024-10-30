
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/public/css/admin.css">
</head>

<body>
<div class="container">
    <div class="navigation">
        <ul>

            <li><a href="#"><span class="icon"><ion-icon name="gift-outline"></ion-icon></span><span class="title">Gift</span></a></li>
            <li><a href="/admin/dashboard"><span class="icon"><ion-icon name="clipboard-outline"></ion-icon></span><span class="title">Dashboard</span></a></li>
            <li><a href="/admin/users"><span class="icon"><ion-icon name="people-outline"></ion-icon></span><span class="title">Users</span></a></li>
            <li><a href="/admin/category"><span class="icon"><ion-icon name="cube-outline"></ion-icon></span><span class="title">Category</span></a></li>
            <li><a href="/admin/comments"><span class="icon"><ion-icon name="chatbubble-outline"></ion-icon></span><span class="title">Comments</span></a></li>
            <li><a href="/admin/coupons"><span class="icon"><ion-icon name="pricetags-outline"></ion-icon></span><span class="title">Coupons</span></a></li>
            <li><a href="/admin/Password"><span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span><span class="title">Password</span></a></li>
            <li><a href="/admin/Signout"><span class="icon"><ion-icon name="log-out-outline"></ion-icon></span><span class="title">Sign Out</span></a></li>
        </ul>
    </div>

    <div class="main" >
        <div class="topbar">
            <div class="toggle"><ion-icon name="menu-outline"></ion-icon></div>
            <div class="search">
                <label><input type="text" placeholder="Search here"><ion-icon name="search-outline"></ion-icon></label>
            </div>
            <div class="user"><ion-icon name="person-outline"></ion-icon></div>
        </div>
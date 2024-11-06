<?php
//update to our pages names
class Core {
    protected $routes = [
        // Default route to customer index
        '' => 'ProductController@home',  // This handles the root URL

        // Admin Routes
        'SuperAdmin/admin' => 'AdminController@index',                  // List all admins
        'SuperAdmin/admin/create' => 'AdminController@create',          // Form to create a new admin
        'SuperAdmin/admin/store' => 'AdminController@store',            // Store a new admin
        'SuperAdmin/admin/edit/{id}' => 'AdminController@edit',         // Edit a specific admin
        'SuperAdmin/admin/update/{id}' => 'AdminController@update',     // Update a specific admin
        'SuperAdmin/admin/delete/{id}' => 'AdminController@delete',     // Delete a specific admin
        'SuperAdmin/admin/toggleStatus/{id}/{status}' => 'AdminController@toggleStatus',

        // Admin Routes
        'admin/dashboard' => 'DashboardController@index',
        'admin/users' => 'UserController@index',
        'admin/reviews' => 'ReviewController2@index',
        'admin/users/create' => 'UserController@create',
        'admin/users/status' => 'UserController@toggleStatus',
        'admin/coupons' => 'CouponController@index',
        'admin/coupons/create' => 'CouponController@create',
        'admin/coupons/edit/{id}' => 'CouponController@edit',
        'admin/coupons/delete/{id}' => 'CouponController@delete',
        'admin/users/toggleStatus/{id}/{status}' => 'UserController@toggleStatus',
        'admin/reviews/toggleStatus/{id}/{status}' => 'ReviewController2@toggleStatus',
        'admin/coupons/toggleStatus/{id}/{status}' => 'CouponController@toggleStatus',
        'admin/login' => 'AdminController@login',
        'admin/Allproducts' => 'DashboardController@Allproducts',

        'admin/users/show/{id}' => 'UserController@show',
        'admin/category' => 'CategoryController2@index',                 // List categories
        'admin/category/create' => 'CategoryController2@create',           // Create category form
        'admin/category/store' => 'CategoryController2@store',             // Store new category
        'admin/category/edit/{id}' => 'CategoryController2@edit',

        'admin/categories/show/{id}' => 'ProductController@show',


        'admin/orders' => 'OrderController@index',              // List all orders
        'admin/orders/show/{id}' => 'OrderController@show',     // Show a specific order
        'admin/orders/create' => 'OrderController@create',      // Create a new order
        'admin/orders/store' => 'OrderController@store',        // Store new order data
        'admin/orders/edit/{id}' => 'OrderController@edit',     // Edit a specific order
        'admin/orders/update/{id}' => 'OrderController@update', // Update a specific order
        'admin/orders/delete/{id}' => 'OrderController@delete',




        'admin' => 'DashboardController@index',
        'categories/create' => 'CategoryController2@create',
        'categories/store' => 'CategoryController2@store',
// Route to show edit form
      'categories/edit/{id}'=> 'CategoryController2@edit',

// Route to handle update form submission
    'categories/update/{id}'=> 'CategoryController2@update',

// Route to delete a category
    'categories/delete/{id}'=> 'CategoryController2@delete',

        'Categories/createProduct' => 'DashboardController@createProduct',
        'admin/manage_category' => 'DashboardController@manageCategory',
        'admin/products' => 'DashboardController@Allproducts',
        'admin/manage_orders' => 'DashboardController@manageOrders',
        'admin/manage_customers' => 'DashboardController@manageCustomers',
        'admin/manage_coupon' => 'DashboardController@manageCoupon',
        'admin/messages' => 'DashboardController@messages',
        'admin/account_settings' => 'DashboardController@accountSettings',
        'admin/logout' => 'DashboardController@logout',

        // customers Routes
        'customers/about-us' => 'CustomerController@home',
        'customers/contact-us' => 'CustomerController@home2',
        'customers/checkout' => 'CustomerController@checkout',        
        'customers/my-account' => 'CustomerController@account',
        'customers/login' => 'AuthController@login',
        'customers/register' => 'AuthController@register',

        //order Route
        'order/details/{id}' => 'OrderController@getOrderProducts',

        'profile/update', 'ProfileController@updateProfile',
        'customers/dashboard' => 'AdminController@dashboard',
       
        //product Routes
        'product/details' => 'ProductController@details',
        'products' => 'ProductController@index',
        'home' => 'ProductController@home',
        'category/{id}' => 'ProductController@getProductsByCategory',
        'search' => 'ProductController@search',

        //admin routes
        'admin/product/create' => 'ProductController@create',

        'admin/login' => 'AdminController@showSignInForm',
        'admin/login/submit' => 'AdminController@signIn',
        'admin/logout' => 'AdminController@logout',

        //wishlist routes
        'wishlist' => 'WishlistController@index',
        'wishlist/add/{product_id}' => 'WishlistController@add',
        'wishlist/addProduct/{product_id}' => 'WishlistController@addProduct',
        'wishlist/remove/{product_id}' => 'WishlistController@delete',
        'wishlist/addOrRemove/{product_id}' => 'WishlistController@addOrRemove',
        'wishlist/count' => 'WishlistController@count',
        'wishlist/isIn/{product_id}' => 'WishlistController@isInWishlist',
        'wishlist/getWishlistProductIds' => 'WishlistController@getWishlistProductIds',

        // Routes for managing products
        'dashboard/manageProducts' => 'DashboardController@Allproducts',
        'dashboard/createProduct' => 'DashboardController@createProduct',
        'dashboard/addProduct' => 'DashboardController@addProduct',
        'dashboard/editProduct/{id}' => 'DashboardController@editProduct',
        'dashboard/updateProduct/{id}' => 'DashboardController@updateProduct',
        'dashboard/deleteProduct/{id}' => 'DashboardController@deleteProduct',

        // Cart routes
        'cart/add' => 'CartController@add',
        'customers/cart' => 'CartController@index',
        'cart/remove' => 'CartController@remove',
        'cart/calculateTotals' => 'CartController@calculateTotals',
        'cart/applyCoupon' => 'CartController@applyCoupon',
        'cart/view' => 'CartController@viewCart',

        'customers/logout' => 'AuthController@logout',
        'customers/edit' => 'UserController@editProfile',
        'customers/updateProfile' => 'UserController@updateProfile',
        'customers/profile' => 'ProfileController@viewProfile',
        'profile/updateProfile' => 'ProfileController@updateProfile',
        'customers/edit' => 'UserController@editProfile',
        'customers/updateProfile' => 'UserController@updateProfile',
        'customers/profile' => 'ProfileController@viewProfile',
        'customers/profile/updateProfile' => 'ProfileController@updateProfile',
        'customers/changePassword'=>'ProfileController@changePassword',
        'auth/changePassword' => 'ProfileController@changePassword',
        'reviews/create' => 'ReviewController@create',              
        'reviews/view' => 'ReviewController@viewReview',            
        'reviews/toggleStatus' => 'ReviewController@toggleStatus',   
        'reviews/index' => 'ReviewController@index',  
        'reviews/delete/{id}' => 'ReviewController@delete',
        'reviews/edit/{id}' => 'ReviewController@edit',
        

    // contact
    'contact/submit' => 'ContactController@submitContactForm',
    'order/submit' => 'OrderController@submitOrder',
    ];
    

    public function __construct() {
        $this->dispatch();
    }

private function dispatch() {
    $url = $this->getUrl();

    // Check for dynamic routes
    foreach ($this->routes as $route => $action) {
        // Create a regex pattern from the route, replacing {param} with a regex capture group
        $routePattern = preg_replace('/\{(\w+)\}/', '([^\/]+)', $route);
        
        // Check if the current URL matches the route pattern
        if (preg_match('#^' . $routePattern . '$#', $url, $matches)) {
            // Remove the first element which is the full match
            array_shift($matches);
            
            $route = explode('@', $action);
            $controllerName = $route[0];
            $methodName = $route[1];

            // Check if the controller file exists
            if (file_exists('controllers/' . $controllerName . '.php')) {
                require_once 'controllers/' . $controllerName . '.php';
                $controller = new $controllerName;

                // Check if the method exists in the controller
                if (method_exists($controller, $methodName)) {
                    // Call the method with the captured parameters
                    call_user_func_array([$controller, $methodName], $matches);
                    return;  // End function after successful dispatch
                } else {
                    die("ERROR: Method $methodName not found in $controllerName.");
                }
            } else {
                die("ERROR: Controller $controllerName not found.");
            }
        }
    }

    // Default route handling for non-dynamic routes
    if (isset($this->routes[$url])) {
        $route = explode('@', $this->routes[$url]);
        $controllerName = $route[0];
        $methodName = $route[1];

        if (file_exists('controllers/' . $controllerName . '.php')) {
            require_once 'controllers/' . $controllerName . '.php';
            $controller = new $controllerName;

            if (method_exists($controller, $methodName)) {
                $controller->$methodName();
                return;  // End function after successful dispatch
            } else {
                die("ERROR: Method $methodName not found in $controllerName.");
            }
        } else {
            die("ERROR: Controller $controllerName not found.");
        }
    } else {
        die("ERROR: Route not found for URL '$url'.");
    }
}

    private function getUrl() {
        $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        $url = trim($url, '/');  // Trim leading and trailing slashes

        if (strpos($url, '?') !== false) {
            $url = strstr($url, '?', true);  // Remove query strings for clean URL
        }

        return $url;
    }
    
}
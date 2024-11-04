<?php
//update to our pages names
class Core {
    protected $routes = [
        // Default route to customer index
        '' => 'ProductController@home',  // This handles the root URL

        // Admin Routes

        'admin/dashboard' => 'DashboardController@index',
        'admin' => 'DashboardController@index',
        'admin/users' => 'UserController@index',
        'admin/users/create' => 'UserController@create',
        'admin/users/status' => 'UserController@toggleStatus',
        'admin/users/toggleStatus/{id}/{status}' => 'UserController@toggleStatus',
        'admin/coupons/toggleStatus/{id}/{status}' => 'CouponController@toggleStatus',
        'admin/login' => 'DashboardController@login',
        'admin/manage_category' => 'DashboardController@manageCategory',
        'admin/products' => 'DashboardController@manageProducts',
        'admin/manage_orders' => 'DashboardController@manageOrders',
        'admin/manage_customers' => 'DashboardController@manageCustomers',
        'admin/manage_coupon' => 'DashboardController@manageCoupon',
        'admin/messages' => 'DashboardController@messages',
        'admin/account_settings' => 'DashboardController@accountSettings',
        'admin/logout' => 'DashboardController@logout',

        // Order Management Route
        'admin/manage_orders/{user_id}' => 'OrderController@manageOrders',

        // customers Routes
        'customers/about-us' => 'CustomerController@about',
        'customers/contact-us' => 'CustomerController@contact',
        'customers/checkout' => 'CustomerController@checkout',        
        'customers/my-account' => 'CustomerController@account',
        'customers/login' => 'AuthController@login',
        'customers/register' => 'AuthController@register',
        'customers/logout' => 'AuthController@logout',
        'customers/profile' => 'ProfileController@viewProfile',
        'profile/update', 'ProfileController@updateProfile',
        'customers/wishlist' => 'CustomerController@wishlist',
        'customers/dashboard' => 'AdminController@dashboard',
       
        //product Routes
        'product/details/{id}' => 'ProductController@details',
        'product/details' => 'ProductController@details',
        'products' => 'ProductController@index',
        'home' => 'ProductController@home',
        'category/{id}' => 'ProductController@getProductsByCategory',
        'search' => 'ProductController@search',

        //admin routes
        'admin/product/create' => 'ProductController@create',

        //wishlist routes
        'wishlist' => 'WishlistController@index',
        'wishlist/add/{product_id}' => 'WishlistController@add',
        'wishlist/remove/{wishlist_id}' => 'WishlistController@remove',

        // Routes for managing products
        'dashboard/manageProducts' => 'DashboardController@manageProducts',
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
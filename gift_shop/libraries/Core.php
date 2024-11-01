<?php
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
        'customers/_404' => 'CustomerController@_404',
        'customers/about-us' => 'CustomerController@about',
        'customers/cart' => 'CustomerController@cart',
        'customers/contact-us' => 'CustomerController@contact',
        'customers/checkout' => 'CustomerController@checkout',
        'customers/faq' => 'CustomerController@faq',

        'customers/index' => 'CustomerController@index',
        
        'customers/my-account' => 'CustomerController@account',
        'customers/privacy-policy' => 'CustomerController@privacy',
        'customers/login' => 'AuthController@login',
        'customers/register' => 'AuthController@register',

        'customers/logout' => 'AuthController@logout',
        'customers/profile' => 'ProfileController@viewProfile',
        'profile/update', 'ProfileController@update',

        // 'customers/product-details-default' => 'CustomerController@product',
        'customers/wishlist' => 'CustomerController@wishlist',

      
        'customers/dashboard' => 'AdminController@dashboard',
       


        //product Routes
        'product/details' => 'ProductController@details',
        // 'products' => 'ProductController@index',
        'home' => 'ProductController@home',

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
                array_shift($matches);  // Remove the full match

                $route = explode('@', $action);
                $controllerName = $route[0];
                $methodName = $route[1];

                $controllerPath = 'controllers/' . $controllerName . '.php';

                if (file_exists($controllerPath)) {
                    require_once $controllerPath;
                    $controller = new $controllerName;

                    if (method_exists($controller, $methodName)) {
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

            $controllerPath = 'controllers/' . $controllerName . '.php';

            if (file_exists($controllerPath)) {
                require_once $controllerPath;
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
            // Handle non-matching routes (404)
            header("HTTP/1.0 404 Not Found");
            echo "ERROR: Route not found for URL '$url'.";
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

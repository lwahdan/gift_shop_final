<?php
//update to our pages names
class Core {
    protected $routes = [
        // Default route to customer index
        '' => 'CustomerController@index',  // This handles the root URL

        // Admin Routes
        'admin/login' => 'AdminController@login',
        'admin/dashboard' => 'AdminController@dashboard',
        'admin/manage_category' => 'AdminController@manageCategory',
        'admin/manage_products' => 'AdminController@manageProducts',
        'admin/manage_orders' => 'AdminController@manageOrders',
        'admin/manage_customers' => 'AdminController@manageCustomers',
        'admin/manage_coupon' => 'AdminController@manageCoupon',
        'admin/messages' => 'AdminController@messages',
        'admin/account_settings' => 'AdminController@accountSettings',
        'admin/logout' => 'AdminController@logout',

        // Super Admin Routes
        'super-admin/login' => 'SuperAdminController@login',
        'super-admin/dashboard' => 'SuperAdminController@dashboard',
        'super-admin/manage_category' => 'SuperAdminController@manageCategory',
        'super-admin/manage_products' => 'SuperAdminController@manageProducts',
        'super-admin/manage_orders' => 'SuperAdminController@manageOrders',
        'super-admin/manage_customers' => 'SuperAdminController@manageCustomers',
        'super-admin/manage_coupon' => 'SuperAdminController@manageCoupon',
        'super-admin/messages' => 'SuperAdminController@messages',
        'super-admin/account_settings' => 'SuperAdminController@accountSettings',
        'super-admin/logout' => 'SuperAdminController@logout',
        'super-admin/manage_admin' => 'SuperAdminController@manageAdmin',

        // customers Routes
        'customers/_404' => 'CustomerController@_404',
        'customers/about-us' => 'CustomerController@about',
        'customers/cart' => 'CustomerController@cart',
        'customers/contact-us' => 'CustomerController@contact',
        'customers/checkout' => 'CustomerController@checkout',
        'customers/faq' => 'CustomerController@faq',
        'customers/index' => 'CustomerController@index',
        'customers/login' => 'CustomerController@login',
        'customers/my-account' => 'CustomerController@account',
        'customers/privacy-policy' => 'CustomerController@privacy',
        'customers/product-details-default' => 'CustomerController@product',
        'customers/wishlist' => 'CustomerController@wishlist',
    ];

    public function __construct() {
        $this->dispatch();
    }

    private function dispatch() {
        $url = $this->getUrl();

//        echo "DEBUG: Requested URL is '$url'<br>"; // Display parsed URL for debugging

        if (isset($this->routes[$url])) {
            $route = explode('@', $this->routes[$url]);
            $controllerName = $route[0];
            $methodName = $route[1];

//            echo "DEBUG: Dispatching to controller: $controllerName, method: $methodName<br>";

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
//
    private function getUrl() {
        $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        $url = trim($url, '/');  // Trim leading and trailing slashes

        if (strpos($url, '?') !== false) {
            $url = strstr($url, '?', true);  // Remove query strings for clean URL
        }

        return $url;
    }
    
}
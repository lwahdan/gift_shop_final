<?php
class AdminController extends Controller {
    public function dashboard() {
        // Logic to retrieve and display admin dashboard data
        $this->view('customers/dashbord'); // Render the admin dashboard view
           
    }
}

<?php
require_once 'models/ReemModel.php';
require_once 'BaseController.php';
class ReemController extends Controller{
   
public function index(){
   $reemmodel=new ReemModel();
   
    $name=$reemmodel->type();
    
    $this->view('customers/Reem', ['name' => $name]);

}



}
<?php
require_once 'BaseModel.php';
class ContactMessage extends BaseModel
{
    public function __construct()
    {
        parent::__construct('contact_messages'); 
    }

    public function saveMessage($data)
    {
        return $this->create($data); 
    }
}

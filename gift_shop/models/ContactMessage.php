<?php
require_once 'BaseModel.php';
class ContactMessage extends BaseModel
{
    public function __construct()
    {
        parent::__construct('contact_messages');  // Pass the table name to the BaseModel
    }

    public function saveMessage($data)
    {
        return $this->create($data);  // Use BaseModel's create method to insert data
    }
}

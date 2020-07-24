<?php

class DBUserMock
{
    public $id;
    public $username;
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $type;

    public function create()
    {
        return true;
    }

    public function delete()
    {
        $this->id = null;
        $this->username = null;
        $this->firstName = null;
        $this->lastName = null;
        $this->email = null;
        $this->password = null;
        $this->type = null;
    }
}

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

    public function save()
    {
        return true;
    }

    public function all()
    {
        return [
                ['1', 'username', 'firstName', 'lastName', 'email', 'password', 'type'],
                ['2', 'username2', 'firstName2', 'lastName2', 'email2', 'password2', 'type2']
               ];
    }
}

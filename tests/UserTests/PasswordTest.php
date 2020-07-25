<?php

use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    private const FULL_INFO_ARRAY = ['1', 'username', 'firstName', 'lastName', 'email', 'password', 'type'];

    public function testPasswordShouldBeHashed()
    {
        // Arrange
        $userDB = new \DBUserMock();
        $user = new \User($userDB, self::FULL_INFO_ARRAY);
        $user->create();

        // Act
        $password = $user->getPassword();

        // Assert
        self::assertNotEquals('password', $password);
    }

    public function testPasswordShouldBeChangeable()
    {
    }
}

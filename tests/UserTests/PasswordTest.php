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
        
        // Act
        $user->create();

        // Assert
        $password = $user->getPassword();
        self::assertNotEquals('password', $password);
    }

    public function testPasswordShouldBeChangeable()
    {
        // Arrange
        $userDB = new \DBUserMock();
        $user = new \User($userDB, self::FULL_INFO_ARRAY);
        $user->create();
        $newPassword = 'Robert123';

        // Act
        $user->changePassword($newPassword);

        // Assert
        $password = $user->getPassword();
        self::assertTrue(password_verify($newPassword, $password));
    }
}

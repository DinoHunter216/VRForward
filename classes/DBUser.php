<?php
/**
 * PHP version 7.2.4
 *
 * @author    Jimmy Gilbert <masterjim@gmail.com>
 * @copyright 2019 Jimmy Gilbert
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   GIT: $Id$
 * @link      http://pear.php.net/package/PackageName
 */

require_once "Crud.php";

class DBUser extends Crud
{
    // Your Table name
    protected $table = 'user';

    // Primary Key of the Table
    protected $pk = 'id';
}

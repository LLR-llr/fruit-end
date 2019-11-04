<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/29
 * Time: 10:18
 */

$password='12345678';
//$pass=md5(crypt($password,md5('wllg')));
$pass=md5($password);
echo $pass;
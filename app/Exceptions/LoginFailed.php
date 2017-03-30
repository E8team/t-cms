<?php
/**
 * Created by PhpStorm.
 * User: ty
 * Date: 2017/3/30 0030
 * Time: 下午 8:31
 */

namespace App\Exceptions;


class LoginFailed extends \RuntimeException
{
    private $error;

    public function __construct($error)
    {
        $this->error = $error;
    }

    public function getError()
    {
        return $this->error;
    }
}
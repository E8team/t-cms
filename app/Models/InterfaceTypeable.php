<?php


namespace App\Models;


interface InterfaceTypeable
{
    public function scopeByType($query, $type);
}
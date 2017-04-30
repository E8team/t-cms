<?php


namespace App\Entities;


interface InterfaceTypeable
{
    public function scopeByType($query, $type);
}
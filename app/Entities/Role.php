<?php

namespace App\Entities;


use Zizaco\Entrust\Contracts\EntrustRoleInterface;
use Zizaco\Entrust\EntrustRole;
use Config;
use Zizaco\Entrust\Traits\EntrustRoleTrait;

class Role extends EntrustRole implements EntrustRoleInterface
{
    use EntrustRoleTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('entrust.roles_table');
    }
}
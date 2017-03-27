<?php
/**
 * Created by PhpStorm.
 * User: ty
 * Date: 2017/3/27 0027
 * Time: 下午 12:54
 */

namespace App\Entities\Traits;


trait Cachable
{
    abstract protected function clearCache();

    public function save(array $options = [])
    {
        if (!parent::save($options)) {
            return false;
        }
        $this->clearCache();
        return true;
    }

    public function delete(array $options = [])
    {
        if (!parent::delete($options)) {
            return false;
        }
        $this->clearCache();
        return true;
    }

    public function restore()
    {
        if (!parent::restore()) {
            return false;
        }
        $this->clearCache();
        return true;
    }
}
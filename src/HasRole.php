<?php

namespace Sunxyw\LaravelQuickRole;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;
use Sunxyw\LaravelQuickRole\Models\Role;

trait HasRole
{
    /**
     * 定义关联关系
     *
     * @return mixed
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * 判断用户是否有指定角色
     *
     * @param Sunxyw\LaravelQuickRole\Models\Role|string|integer $role 角色实例/名称/ID
     * @return boolean 是否拥有
     */
    public function hasRole($role): bool
    {
        if (is_string($role)) {
            $role = Role::query()->firstWhere('name', $role);
        }
        if (is_int($role)) {
            $role = Role::query()->find($role);
        }
        if (!($role instanceof Role)) {
            throw new InvalidArgumentException('错误的角色实例/名称/ID');
        }
        if (is_null($role)) {
            throw new ModelNotFoundException('无法找到角色');
        }

        return $this->role->is($role);
    }

    /**
     * 为用户分配角色
     *
     * @param Sunxyw\LaravelQuickRole\Models\Role|string|integer $role 角色实例/名称/ID
     * @return boolean 是否成功
     */
    public function assignRole($role): bool
    {
        if (is_string($role)) {
            $role = Role::query()->firstWhere('name', $role);
        }
        if (is_int($role)) {
            $role = Role::query()->find($role);
        }
        if (!($role instanceof Role)) {
            throw new InvalidArgumentException('错误的角色实例/名称/ID');
        }
        if (is_null($role)) {
            throw new ModelNotFoundException('无法找到角色');
        }

        $this->role_id = $role->id;
        return $this->save();
    }

    /**
     * 判断用户是否有其中一个角色
     *
     * @param iterable $roles 可循环类型，包含角色实例/名称/ID
     * @return boolean
     */
    public function hasAnyRole($roles): bool
    {
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }

        return false;
    }
}

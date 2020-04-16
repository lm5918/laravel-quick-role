<?php

namespace Sunxyw\LaravelQuickRole\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'title', 'color'];

    /**
     * 标题获取器
     * 如果不存在标题则使用名称作为标题
     *
     * @param string $value 标题
     * @return string
     */
    public function getTitleAttribute($value): string
    {
        return $value ?: $this->name;
    }

    /**
     * 颜色获取器
     *
     * @return array|null
     */
    public function getColorAttribute($value)
    {
        $color_map = collect(config('quick-role.color_map'));
        $color = $color_map->firstWhere('hex', $value);
        return $color;
    }

    /**
     * 颜色名称获取器
     *
     * @return string
     */
    public function getColorNameAttribute(): string
    {
        $color = $this->color;
        return is_null($color) ? 'Unknown' : $color['name'];
    }

    /**
     * 颜色代码获取器
     *
     * @return string
     */
    public function getColorCodeAttribute(): string
    {
        $color = $this->color;
        return is_null($color) ? '0' : $color['code'];
    }

    /**
     * 颜色HEX获取器
     *
     * @return string
     */
    public function getColorHexAttribute(): string
    {
        $color = $this->color;
        return is_null($color) ? $this->getOriginal('color') : $color['hex'];
    }
}

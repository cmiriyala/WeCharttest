<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class module_navigation extends Model
{
    protected $fillable = [
        'module_id', 'navigation_id', 'visible','display_order'
    ];

    public function navigations() {
        return $this->hasMany('App\navigation');
    }

    public function modules() {
        return $this->hasMany('App\module');
    }

    protected $table = 'modules_navigations';
}

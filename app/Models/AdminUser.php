<?php

namespace App\Models;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminUser extends Administrator
{
    use SoftDeletes;
}

<?php

namespace App\Models;

use App\Handlers\WalletHandler;
use App\Models\Traits\UnreadNotificationCountCacheRedisHelper;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminUser extends Administrator
{
    use SoftDeletes;
}

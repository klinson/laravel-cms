<?php
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Auth;
class UserController extends Controller
{
    public function index()
    {
        return $this->view();
    }
}
<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\V1\UserResource;
use Illuminate\Support\Facades\Auth;

class ManagementController extends Controller
{
    public function allUsers()
    {
        $users = User::paginate(30);

        return $users;
    }
}

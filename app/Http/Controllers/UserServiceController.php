<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserServiceController extends Controller
{
    public function show(User $user)
    {
        $services = $user->services()->get();

        return view('user.service.show', compact('services'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    //
    /*
     * Show a list of all users, allow upgrade to admin, or downgrade, or ban.
     */
    public function show()
    {
        $users=User::get();
        return view('pages.users',compact('users'));
    }

    public function toggleAdmin($userid)
    {
        $user=User::findOrFail($userid);
        $user->admin=!$user->admin;
        $user->save();
        return redirect("/users");
    }

}

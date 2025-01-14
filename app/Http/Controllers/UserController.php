<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function testResponse()
    {
    $users= User::all();

    return response()->json(['userdetails'=>$users],status:200);
    }

}

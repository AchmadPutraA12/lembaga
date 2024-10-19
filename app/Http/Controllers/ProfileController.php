<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){

        $profile = User::select([
            'name', 'nip', 'email'
        ])
        ->where('id', '=', auth()->user()->id)
        ->first();

        return view( 'profile.index', [
            'profile' => $profile
        ] );
    }
}

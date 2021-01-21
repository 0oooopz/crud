<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsersController extends Controller {
	public function index() {
		$users = DB::table('users')->get();
		return view('users.index', ['users' => $users]);
	}

	public function create(){
		return view('users.create');
	}

	public function show(User $user){
		return view('users.show',['user'=>$user]);
	}
}

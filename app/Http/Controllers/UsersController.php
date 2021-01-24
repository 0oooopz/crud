<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;


class UsersController extends Controller {

	public function index(Request $request,User $user) {

		$sortBy = $request->orderBy;
		if(isset($sortBy)){
			switch ($sortBy){
				case $sortBy == 'first-name';
					$user = $user->orderBy('first_name')->get();
					break;
				case $sortBy == 'last-name';
					$user = $user->orderBy('last_name')->get();
					break;
				case $sortBy == 'email';
					$user = $user->orderBy('email')->get();
					break;
				case $sortBy == 'created-at';
					$user = $user->orderBy('created_at')->get();
					break;
				case $sortBy == 'updated-at';
					$user = $user->orderBy('updated_at')->get();
					break;
				default:
					$user = $user->orderBydesc('id')->get();
			}
		}

		if($request->ajax()){
			return view('ajax.sort-by',[
				'users' => $user,
			])->render();
		}
		return view('users.index', [
			'users' => $user->all(),
		]);
	}

	public function create(){
		return view('users.create');
	}

	public function store(Request $request, User $user){

		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->email = $request->email;
		$user->save();
		return redirect()->back()->withSuccess(' ');
	}

	public function show(User $user){
		return view('users.show',[
			'user'=>$user
		]);
	}


	public function edit(User $user)
	{
		return view('users.edit',[
			'user' => $user,
		]);
	}

	/**
	 * @param Request $request
	 * @param User $user
	 * @return RedirectResponse
	 */
	public function update(Request $request, User $user): RedirectResponse
	{
		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->email = $request->email;
		$user->save();

		return redirect()->back()->withSuccess(' ');
	}

	/**
	 * @param User $user
	 * @return RedirectResponse
	 * @throws \Exception
	 */
	public function destroy(User $user): RedirectResponse
	{

		$user->delete();
		return redirect()->back()->withSuccess(' ');
	}

}

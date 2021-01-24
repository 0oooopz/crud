<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;


class UsersController extends Controller {
	/**
	 * @param Request $request
	 * @param User $user
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|string
	 */
	public function index(Request $request, User $user) {

		$search = $request->search;
		$sortBy = $request->orderBy;

		if (isset($search)) {

			$user = $user->where('first_name', 'like', "%$search%")
				->orWhere('last_name', 'like', "%$search%")
				->orWhere('email', 'like', "%$search%")
				->orWhere('created_at', 'like', "%$search%")
				->orWhere('updated_at', 'like', "%$search%")
				->orWhere('id', 'like', "%$search%");
		}

		if (isset($sortBy)) {
			$user = $user->orderBy($sortBy)->get();
		}

		if ($request->ajax()) {
			return view('ajax.sort-by', [
				'users' => $user,
			])->render();
		}
		return view('users.index', [
			'users' => $user->all(),
		]);
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function create() {
		return view('users.create');
	}

	/**
	 * @param Request $request
	 * @param User $user
	 * @return mixed
	 */
	public function store(Request $request, User $user) {

		$validateData = $request->validate([
			'first_name' => ['required','max:12'],
			'last_name' => ['required', 'max:12'],
			'email' => ['required', 'unique:users', 'email','max:25'],
		]);

		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->email = $request->email;
		$user->save();
		return redirect()->back()->withSuccess(' ');
	}

	/**
	 * @param User $user
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function show(User $user) {
		return view('users.show', [
			'user' => $user
		]);
	}

	public function edit(User $user) {
		return view('users.edit', [
			'user' => $user,
		]);
	}

	/**
	 * @param Request $request
	 * @param User $user
	 * @return RedirectResponse
	 */
	public function update(Request $request, User $user): RedirectResponse {

		$validateData = $request->validate([
			'first_name' => ['required','max:12'],
			'last_name' => ['required', 'max:12'],
			'email' => ['required', 'email','max:25'],
		]);

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
	public function destroy(User $user): RedirectResponse {
		$user->delete();
		return redirect()->back()->withSuccess(' ');
	}

}

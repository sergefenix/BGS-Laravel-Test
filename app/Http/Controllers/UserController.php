<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Exception;
use App\User;

class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $users = User::paginate(10);
        return view('users', compact(['users']));
    }

    /**
     * @param User $user
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('users');
    }
}

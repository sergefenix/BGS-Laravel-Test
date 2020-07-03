<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use App\Repositories\UserRepository;
use Exception;
use App\User;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $users = $this->userRepository->paginate(10);

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
        $this->userRepository->delete($user->id);

        return redirect()->route('users');
    }
}

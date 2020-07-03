<?php

namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\Collection;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
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
     * @return User[]|Collection
     */
    public function index()
    {
        return  $this->userRepository->all();
    }

    /**
     * @param User $user
     *
     * @return JsonResponse
     */
    public function delete(User $user): JsonResponse
    {
        $this->userRepository->delete($user->id);

        return response()->json(null, 204);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Services\AuthService;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    public $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        try {
            return $this->authService->authenticate($request);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    public function logout(Request $request)
    {
        try {
            return $this->authService->logout($request);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    public function register()
    {
        try {
            return view('auth.register');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    public function registerPost(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->authService->create($request);
            session()->flash('success', __('message.registerSuccess'));
            DB::commit();
            return redirect(route('login.show'));
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponser;

    protected function guard()
    {
        return Auth::guard('api');
    }

    public function respondWithToken($token)
    {
        $token_validity = Carbon::now()->addDays(30)->timestamp;
        $this->guard()->factory()->setTTL($token_validity);
        return $this->successResponse([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL(),
        ], 'Authorized');
    }
}

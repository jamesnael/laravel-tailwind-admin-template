<?php

namespace App\Actions\Fortify;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

class AuthenticateLoginAttempt
{
  /**
   * Override default login logic.
   *
   * @return \App\Model\Karyawan
   */
  public function __invoke(Request $request)
  {
    $user = Karyawan::where(function($subquery) use ($request) {
                      $subquery->where('email', $request->email)
                              ->orWhere('username', $request->email);
                    })
                    ->where('status', true)    
                    ->whereHas('jabatan', function(Builder $subquery) {
                      $subquery->whereIn('tipe_user', ['Backend User']);
                    })    
                    ->first();

    if ($user && Hash::check($request->password, $user->password)) {
      return $user;
    }
  }
}
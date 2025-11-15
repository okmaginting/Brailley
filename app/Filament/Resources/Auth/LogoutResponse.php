<?php

namespace App\Filament\Resources\Auth;

use Illuminate\Http\RedirectResponse;
use Filament\Auth\Http\Responses\Contracts\LogoutResponse as Responsable;

class LogoutResponse implements Responsable
{
    public function toResponse($request): RedirectResponse
    {
        return redirect()->route('login');
    }
}
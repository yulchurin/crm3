<?php

namespace App\Http\Middleware;

use App\Services\Appointments\Limitations;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HandleAppointmentLimits
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (Limitations::allottedTime()) {
            return back()->with('message', 'Вы израсходовали все доступные занятия');
        }

        if (Limitations::weekly()) {
            return back()->with('message', 'Вы израсходовали недельный лимит');
        }

        if (Limitations::daily()) {
            return back()->with('message', 'Вы израсходовали дневной лимит');
        }

        if (Limitations::payment()) {
            return back()->with('message', 'На Вашем счёте недостаточно денег для бронирования уроков');
        }

        return $next($request);
    }
}

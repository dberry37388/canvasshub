<?php

namespace App\Http\Middleware;

use App\Notifications\Users\ActivateEmailNotification;
use Closure;

class CheckUserActivated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        
        $disableDate = $user->created_at->addDays(30)->format("F j, Y");
        
        if (! $user->is_activated && today()->gte($disableDate)) {
            
            $user->notify(new ActivateEmailNotification($user));
            
            return redirect('/not-active');
        }
        
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Day;

class ForceInitialSetup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $days = Day::count();
        if ($days == 0) {
            return redirect('days/create');
        } else {
            return redirect('collections');
        }
    }
}

<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Logs;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class AuthorizationMiddleware
{
    public function handle(Request $request, Closure $next)
    {   
        $authorizationHeader = $request->header('Authorization');
        
        if ($authorizationHeader !== '$xv1623tty') {
            return redirect()->back();
        }
        
        $ip = $request->ip();
        $logs = new Logs();
        $logs->ip = $ip;
        $logs->save();
    
        $requestCountKey = 'request_count_' . $ip;
        $requestCount = Cache::get($requestCountKey, 0);
        if ($requestCount >= 30) {
            return response()->json(['error' => 'Too many requests'], 429);
        }

        Cache::put($requestCountKey, $requestCount + 1, Carbon::now()->addMinutes(1));
        return $next($request);
      
    }
}






?>
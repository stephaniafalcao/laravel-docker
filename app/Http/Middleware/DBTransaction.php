<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class DBTransaction
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

        //return DB::transaction(function () use ($next, $request) {
            try{
                echo "opa00000";
                return $next($request);
            } catch(\Throwable $e) {
                echo "não foi";
                throw $e;
            }

       // });
    }
}

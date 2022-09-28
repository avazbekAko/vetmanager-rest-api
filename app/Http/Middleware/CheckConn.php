<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckConn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user()->id_conn();
        if($user){
            return redirect()->route('clients-all', Auth::user()->id_conn)->with('success','Connected successfully.');
        }
        else{
            return redirect()->route('companies.create')->with('success','Connected does not exist.');
        }

        return $next($request);
    }
}

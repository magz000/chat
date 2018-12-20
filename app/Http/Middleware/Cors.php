<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        $response = $next($request);
        $IlluminateResponse = 'Illuminate\Http\Response';
        $SymfonyResopnse = 'Symfony\Component\HttpFoundation\Response';

        if($response instanceof $SymfonyResopnse) {
            $response->headers->set('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, DELETE, PATCH');
            $response->headers->set('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        }else{
            $response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, DELETE, PATCH');
            $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
            $response->header('Access-Control-Allow-Origin', '*');
            return $response;
        }


    }
}

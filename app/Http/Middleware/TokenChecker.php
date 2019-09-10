<?php

namespace App\Http\Middleware;
use App\User;
use Closure;

class TokenChecker
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
        $header = $request->header('Authorization');

        if ($header != null) {
            $user = User::where('id', $request->user_id)->first();
            $token = $user->token;
            if ($token != null) {
                $data = array(
                    "Api Type" => 'Token Authorization',
                    "status" => 'failed',
                    "message" => 'Invalid token.',
                );
                $decode_data = json_decode(json_encode($data), true);
                return view('pages.home')->withData($decode_data);
            } else {
                $request->headers->set('Authorization', "Bearer " . $token);
                return $next($request);
            }
        }
        return $next($request);
    }
}

<?php

namespace App\Api\Controllers;
use App\User;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser as JwtParser;
use League\OAuth2\Server\AuthorizationServer;
use Psr\Http\Message\ServerRequestInterface;

class TokenController extends Controller
{

    protected $server;
    protected $tokens;
    protected $jwt;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorizationServer $server,TokenRepository $tokens,JwtParser $jwt)
    {
        $this->jwt = $jwt;
        $this->server = $server;
        $this->tokens = $tokens;
    }

    public function getRefreshToken(ServerRequestInterface $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'user_id' => 'required',
        //     'client_id' => 'required',
        //     'client_secret' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => $validator->errors()->first()
        //     ]);
        // }

        // $user = User::find($request->user_id);
                
        $controller = new AccessTokenController($this->server, $this->tokens, $this->jwt);

        $request = $request->withParsedBody($request->getParsedBody() +
        [
            'grant_type' => 'refresh_token',
            // 'refresh_token' => $user->refresh_token,
            'client_id' =>  $request->client_id,
            'client_secret' => $request->client_secret,
            'scope' => '*'
        ]);

        dd($request);

        return with($controller)->issueToken($request);
    }

}
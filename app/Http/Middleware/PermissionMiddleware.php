<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use App\Services\CommonEssentialService;

class PermissionMiddleware
{
    protected $commonEssentialService;

    public function __construct()
    {
        $this->commonEssentialService = new CommonEssentialService();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->hasHeader('X-Header-Service') && $request->hasHeader('Authorization')) {
            // $user = Auth::user();
            $redisKey = "permission" . $user['preferred_username'];
            $permissions = collect(Redis::get($redisKey));
            $method = $this->mappingMethod($request->method());

            if (empty($permissions)) {
                $permissions = collect($this->commonEssentialService->getHakAksesMenu($user['preferred_username']));
                Redis::set($redisKey, $permissions);
                Redis::expire($redisKey, 86400);
            }

            $permission = $permissions->firstWhere('url', $request->path());

            if (!empty($permission) && $this->containsWord($permission->hak, $method)) {
                return $next($request);
            }
        }elseif($request->hasHeader('X-Header-Service')) {
            return $next($request);
        }


        return response()->json([
            'status' => 401,
            'message' => "Unauthorized",
        ], 401);
    }

    function mappingMethod($httpMethod)
    {
        switch ($httpMethod) {
            case 'GET':
                return "R";
                break;
            case 'POST':
                return "C";
                break;
            case 'PUT':
                return "U";
                break;
            case 'DELETE':
                return "D";
                break;
        }
    }

    function containsWord($str, $word)
    {
        if (strpos($str, $word) !== false) {
            return true;
        } else {
            return false;
        }
    }
}

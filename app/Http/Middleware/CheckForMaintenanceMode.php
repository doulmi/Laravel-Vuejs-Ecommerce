<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Symfony\Component\HttpKernel\Exception\HttpException;


class CheckForMaintenanceMode
{
  /**
   * The application implementation.
   *
   * @var \Illuminate\Contracts\Foundation\Application
   */
  protected $app;

  /**
   * Create a new middleware instance.
   *
   * @param  \Illuminate\Contracts\Foundation\Application  $app
   * @return void
   */
  public function __construct(Application $app)
  {
    $this->app = $app;
  }

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   *
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   */
  public function handle($request, Closure $next)
  {
    if ($this->app->isDownForMaintenance()) {
      $whitelist = explode('|', env('MAINTENANCE_WHITELIST'));

      $ip = $request->ip();
      $serverId = $request->server('SERVER_ADDR');

      if($ip != $serverId && !in_array($ip, $whitelist)) {
        throw new HttpException(503);
      }
    }
    return $next($request);
  }
}

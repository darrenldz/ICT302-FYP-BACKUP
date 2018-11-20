<?php

namespace Darren\ImportCsv\Http\Middleware;

use Darren\ImportCsv\ImportCsv;

class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        return resolve(ImportCsv::class)->authorize($request) ? $next($request) : abort(403);
    }
}

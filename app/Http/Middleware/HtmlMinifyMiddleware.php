<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use voku\helper\HtmlMin;

class HtmlMinifyMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (
            $response instanceof \Illuminate\Http\Response &&
            strpos($response->headers->get('Content-Type'), 'text/html') !== false
        ) {
            $htmlMin = new HtmlMin();
            $minifiedHtml = $htmlMin->minify($response->getContent());
            $response->setContent($minifiedHtml);
        }

        return $response;
    }
}

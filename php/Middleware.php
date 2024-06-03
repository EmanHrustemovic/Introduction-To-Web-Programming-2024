<?php
function middleware($request, $response, $next) {
    
    return $next($request, $response);
}

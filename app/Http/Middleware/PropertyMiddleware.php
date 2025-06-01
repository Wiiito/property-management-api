<?php

namespace App\Http\Middleware;

use App\Models\Property;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PropertyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $property = Property::find($request->property);

        if (!$property) {
            return response()->json(['message' => 'Property not found'], Response::HTTP_BAD_REQUEST);
        }

        if ($request->user()->id != $property->owner_id) {
            return response()->json(['message' => 'Not authorized'], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}

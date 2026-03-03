<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ManageDatabaseConnections
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        // Close all database connections after response is sent
        try {
            // Get current connection count for logging
            $connections = DB::select('SELECT COUNT(*) as count FROM information_schema.PROCESSLIST WHERE db = ?', 
                [config('database.connections.mysql.database')]);
            
            Log::info('Active connections before cleanup: ' . ($connections[0]->count ?? 'N/A'));
            
            // Close the connection
            DB::disconnect();
            
        } catch (\Exception $e) {
            Log::error('Database disconnect error: ' . $e->getMessage());
        }
    }
}
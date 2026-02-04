<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/debug-images', function () {
    try {
        $programmes = DB::table('programs')->select('id', 'title', 'image')->get();
        $team = DB::table('team_members')->select('id', 'name', 'image')->get();
        
        return response()->json([
            'storage_path' => storage_path('app/public'),
            'public_path' => public_path('storage'),
            'programmes' => $programmes,
            'team' => $team,
            'files_in_storage' => array_diff(scandir(storage_path('app/public')), ['.', '..']),
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

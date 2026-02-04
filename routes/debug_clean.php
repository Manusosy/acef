
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/debug-images', function () {
    try {
        $programmes = DB::table('programs')->select('id', 'title', 'image')->get();
        // $team = DB::table('team_members')->select('id', 'name', 'image')->get(); // Comment out team to isolate if table missing
        
        return response()->json([
            'files_in_storage' => array_diff(scandir(storage_path('app/public')), ['.', '..']),
            'programmes_sample' => $programmes->take(3),
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

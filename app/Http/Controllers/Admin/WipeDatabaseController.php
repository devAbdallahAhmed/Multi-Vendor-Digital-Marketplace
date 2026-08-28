<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Exception;

class WipeDatabaseController extends Controller
{
    public function index()
    {
        return view('admin.wipe-database.index');
    }

    public function destroy(Request $request)
    {
        try {
            Artisan::call('migrate:fresh --seed');

            return response()->json([
                'status' => 'success',
                'message' => 'Database wiped successfully.'
            ]);
        } catch (Exception $e) {
            Log::error($e);

            throw $e;
        }
    }
}

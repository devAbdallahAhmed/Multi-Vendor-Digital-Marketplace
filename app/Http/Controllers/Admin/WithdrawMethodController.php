<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WithdrawMethodRequest;
use App\Models\WithdrawMethod;
use App\Services\NotificationService;
use App\Services\WithdrawMethodServices;
use Exception;
use Illuminate\Http\Request;

class WithdrawMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $withdrawService;

    function __construct(WithdrawMethodServices $withdrawMethodServices)
    {
        $this->withdrawService = $withdrawMethodServices;
    }
    public function index()
    {
        $methods = WithdrawMethod::all();
        return view('admin.dashboard.withdraw-method.index', compact('methods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.withdraw-method.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WithdrawMethodRequest $request)
    {
        $validated = $request->validated();

        $this->withdrawService->storeWIthdraw($validated);
        NotificationService::created();
        return redirect()->route('admin.withdraw-method.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $withdrawalMethod = WithdrawMethod::findOrFail($id);
        return view('admin.dashboard.withdraw-method.edit', compact('withdrawalMethod'));
    }


    public function update(WithdrawMethodRequest $request, WithdrawMethod $withdraw_method)
    {
        $validated = $request->validated();

        $this->withdrawService->updateWithdraw($validated, $withdraw_method);

        NotificationService::updated();

        return redirect()->route('admin.withdraw-method.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WithdrawMethod $withdraw_method)
    {
        try {
            $withdraw_method->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Withdraw method deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete: ' . $e->getMessage()
            ], 500);
        }
    }
}

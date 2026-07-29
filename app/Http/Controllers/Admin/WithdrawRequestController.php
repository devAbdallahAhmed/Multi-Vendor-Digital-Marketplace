<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Withdraws;
use Illuminate\Support\Facades\DB;
use App\Events\WithdrawProcessed;
class WithdrawRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $withdraws = Withdraws::paginate(25);
        return view('admin.dashboard.withdraw-request.index', compact('withdraws'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $withdraw = Withdraws::findOrFail($id);
        return view('admin.dashboard.withdraw-request.show', compact('withdraw'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'in:pending,paid,rejected']
        ]);

        $withdraw = Withdraws::findOrFail($id);

        if ($withdraw->status !== 'pending') {
            flash()->error(__('This request has already been processed.'));
            return redirect()->back();
        }

        try {
            DB::transaction(function () use ($withdraw, $request) {
                $withdraw->status = $request->status;
                $withdraw->save();

                if ($request->status === 'paid') {
                    $withdraw->author->decrement('balance', $withdraw->amount);
                }
            });

            event(new WithdrawProcessed($withdraw));

            flash()->success(__('Withdraw request updated and user notified successfully.'));
        } catch (\Exception $e) {
            flash()->error(__('Something went wrong! Please try again.'));
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         Withdraws::where('id', $id)->whereStatus('rejected')->delete();
        return redirect()->back();
    }
}

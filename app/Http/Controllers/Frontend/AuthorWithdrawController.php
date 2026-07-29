<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use App\Models\Withdraws;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthorWithdrawController extends Controller
{
    public function index()
    {
        $withdraws = Withdraws::where('author_id',  Auth::id())->paginate(25);
        return view(
            'frontend.dashboard.withdraws.index',
            compact('withdraws')
        );
    }

    public function create()
    {
        return view('frontend.dashboard.withdraws.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'amount' => ['required', 'numeric']
        ]);

        $hasPendingRequest = Withdraws::where('author_id', auth()->id())
            ->whereStatus('pending')
            ->exists();

        if ($hasPendingRequest) {
            throw ValidationException::withMessages([
                'amount' => __('You already have a pending withdraw request. Please wait until it is processed.')
            ]);
        }

        $withdrawInfo = auth()->user()->withdrawAuthorInfo;

        if (!$withdrawInfo || !$withdrawInfo->withdrawGateway) {
            NotificationService::error(__('Please set up your payout settings first.'));
            return redirect()->back();
        }

        $gateway = $withdrawInfo->withdrawGateway;

        if ($request->amount < $gateway->minimum_amount) {
            throw ValidationException::withMessages([
                'amount' => __('The minimum amount for withdraw is :amount', ['amount' => $gateway->minimum_amount])
            ]);
        }

        if ($request->amount > $gateway->maximum_amount) {
            throw ValidationException::withMessages([
                'amount' => __('The maximum amount for withdraw is :amount', ['amount' => $gateway->maximum_amount])
            ]);
        }

        $user = auth()->user();

        if ($request->amount > $user->balance) {
            throw ValidationException::withMessages([
                'amount' => __('Insufficient balance. Your current balance is :amount', ['amount' => $user->balance])
            ]);
        }

        $withdraw = new \App\Models\Withdraws();
        $withdraw->author_id = $user->id;
        $withdraw->amount = $request->amount;
        $withdraw->method = $gateway->name;
        $withdraw->account = $withdrawInfo->information;
        $withdraw->status = 'pending';
        $withdraw->save();

        NotificationService::created(__('Withdraw request has been submitted successfully.'));
        return redirect()->route('user.withdraw.index');
    }
}

<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\WithdrawMethod;

class WithdrawMethodServices
{

    function storeWIthdraw(array $data)
    {

        return DB::transaction(function () use ($data) {

            return WithdrawMethod::create([
                'name' => $data['name'],
                'minimum_amount' => $data['minimum_amount'],
                'maximum_amount' => $data['maximum_amount'],
                'description' => $data['description'],
                'status' => $data['status'],

            ]);
        });
    }

    public function updateWithdraw(array $data, WithdrawMethod $withdrawMethod)
    {
        return DB::transaction(function () use ($data, $withdrawMethod) {

            $withdrawMethod->update([
                'name'           => $data['name'],
                'minimum_amount' => $data['minimum_amount'],
                'maximum_amount' => $data['maximum_amount'],
                'description'    => $data['description'],
                'status'         => $data['status'],
            ]);

            return $withdrawMethod;
        });
    }
}

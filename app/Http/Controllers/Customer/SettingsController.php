<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\SettingsRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    /**
     * Show customer settings.
     */
    public function index(): View
    {
        $user = auth()->user();

        return view(
            'customer.settings.index',
            compact('user')
        );
    }

    /**
     * Update customer settings.
     */
    public function update(
        SettingsRequest $request
    ): RedirectResponse {
        $user = $request->user();

        $validated = $request->validated();

        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? null;

        /*
        |--------------------------------------------------------------------------
        | Password
        |--------------------------------------------------------------------------
        */

        if (! empty($validated['new_password'])) {
            $user->password = Hash::make(
                $validated['new_password']
            );
        }

        $user->save();

        return back()->with(
            'success',
            'تنظیمات حساب با موفقیت ذخیره شد.'
        );
    }
}

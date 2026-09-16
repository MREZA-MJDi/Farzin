<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\AddressRequest;
use App\Models\Address;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AddressController extends Controller
{
    public function index(): View
    {
        $addresses = auth()->user()
            ->addresses()
            ->latest('is_default')
            ->latest()
            ->get();

        return view('customer.addresses.index', compact('addresses'));
    }

    public function create(): View
    {
        return view('customer.addresses.create');
    }

    public function store(AddressRequest $request): RedirectResponse
    {
        $user = $request->user();

        $isFirstAddress = ! $user
            ->addresses()
            ->exists();

        $isDefault =
            $request->boolean('is_default') ||
            $isFirstAddress;

        $address = $user->addresses()->create([
            'title' => $request->string('title')->toString(),
            'full_name' => $request->string('full_name')->toString(),
            'phone' => $request->string('phone')->toString(),
            'country' => $request->string('country')->toString(),
            'province' => $request->string('province')->toString(),
            'city' => $request->string('city')->toString(),
            'postal_code' => $request->string('postal_code')->toString(),
            'address' => $request->string('address')->toString(),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'is_default' => false,
        ]);

        if ($isDefault) {
            $address->makeDefault();
        }

        return redirect()
            ->route('customer.checkout.index')
            ->with('success', 'آدرس با موفقیت ثبت شد.');
    }

    public function edit(Address $address): View
    {
        abort_unless(
            (int) $address->user_id === (int) auth()->id(),
            403
        );

        return view('customer.addresses.edit', compact('address'));
    }

    public function update(
        AddressRequest $request,
        Address $address
    ): RedirectResponse {
        abort_unless(
            (int) $address->user_id === (int) auth()->id(),
            403
        );

        $address->update([
            'title' => $request->string('title')->toString(),
            'full_name' => $request->string('full_name')->toString(),
            'phone' => $request->string('phone')->toString(),
            'country' => $request->string('country')->toString(),
            'province' => $request->string('province')->toString(),
            'city' => $request->string('city')->toString(),
            'postal_code' => $request->string('postal_code')->toString(),
            'address' => $request->string('address')->toString(),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'is_default' => false,
        ]);

        if ($request->boolean('is_default')) {
            $address->makeDefault();
        }

        return redirect()
            ->route('customer.checkout.index')
            ->with('success', 'آدرس با موفقیت ویرایش شد.');
    }

    public function destroy(Address $address): RedirectResponse
    {
        abort_unless(
            (int) $address->user_id === (int) auth()->id(),
            403
        );

        $wasDefault = $address->is_default;

        $address->delete();

        if ($wasDefault) {
            $nextAddress = auth()->user()
                ->addresses()
                ->latest()
                ->first();

            if ($nextAddress) {
                $nextAddress->makeDefault();
            }
        }

        return back()->with(
            'success',
            'آدرس با موفقیت حذف شد.'
        );
    }

    public function setDefault(Address $address): RedirectResponse
    {
        abort_unless(
            (int) $address->user_id === (int) auth()->id(),
            403
        );

        $address->makeDefault();

        return back()->with(
            'success',
            'آدرس پیش‌فرض تغییر کرد.'
        );
    }
}

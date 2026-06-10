<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrder;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('contact');
    }

    public function store(StoreOrder $request): RedirectResponse
    {
        Order::query()->create($request->validated());

        return redirect()
            ->route('contact')
            ->with('success', 'Ваш заказ успешно отправлен! Мы свяжемся с вами в ближайшее время.');
    }

    public function storeFromServices(StoreOrder $request): RedirectResponse
    {
        Order::query()->create($request->validated());

        return redirect()
            ->route('services')
            ->with('success', 'Ваш заказ успешно отправлен! Мы свяжемся с вами в ближайшее время.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWhatsappPhoneRequest;
use App\Services\WhatsappNumberConfig;

class WhatsappPhoneController extends Controller
{
    public function index()
    {
        $phone = WhatsappNumberConfig::get();
        return view('admin.whatsapp_phone.index', compact('phone'));
    }

    public function store(StoreWhatsappPhoneRequest $request)
    {
        $data = $request->validated();
        WhatsappNumberConfig::set($data['phone']);

        return response()->json(['success' => true]);
    }
}

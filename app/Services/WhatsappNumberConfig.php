<?php

namespace App\Services;

class WhatsappNumberConfig
{
    public static function get()
    {
        $path = storage_path('app/whatsapp.json');

        if (!file_exists($path)) {
            return null;
        }

        return json_decode(file_get_contents($path), true);
    }

    /**
     * Сохраняет номер в storage/app/whatsapp.json
     *
     * @param string $phoneNumber В формате +7XXXXXXXXXX
     * @return bool
     */
    public static function set(string $phoneNumber): bool
    {
        $path = storage_path('app/whatsapp.json');

        // Убираем все символы кроме цифр
        $digits = preg_replace('/\D/', '', $phoneNumber);

        // Форматируем: +7 (XXX) XXX-XX-XX
        $formatted = '+'.$digits[0].' (' . substr($digits, 1, 3) . ') ' . substr($digits, 4, 3) . '-' . substr($digits, 7, 2) . '-' . substr($digits, 9, 2);

        $data = [
            'phone' => $digits,
            'formatted' => $formatted,
        ];

        return (bool) file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}

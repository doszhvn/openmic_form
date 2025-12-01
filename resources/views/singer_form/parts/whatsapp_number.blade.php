@php
    $whatsapp = \App\Services\WhatsappNumberConfig::get();
@endphp

@if($whatsapp)
    <div class="text-center mt-3">
        <p class="text-white-50 mb-0">
            Если у вас возникли проблемы напишите нам на WhatsApp:
            <a href="https://wa.me/{{ $whatsapp['phone'] }}"
               class="text-warning fw-bold" target="_blank">
                {{ $whatsapp['formatted'] }}
            </a>
        </p>
    </div>
@endif

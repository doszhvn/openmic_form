@extends('layouts.app')

@section('content')
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('{{ asset('assets/images/openmic.jpg') }}') no-repeat center center fixed;
            background-size: cover;
        }

        .overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1;
        }
        .form-control:focus {
            border-color: #ff6600;
            box-shadow: 0 0 0 0.2rem rgba(255,102,0,0.25);
        }
    </style>

    <div class="overlay"></div>

    <div class="d-flex flex-column align-items-center justify-content-center position-relative z-3 min-vh-100">
        <div class="container text-center rounded-3 p-4">
            @csrf
            <div class="mb-3 d-flex flex-column align-items-center">
                <h1 class="text-center mb-3 text-white display-6 fw-bold">ОТКРЫТЫЙ МИКРОФОН</h1>

                <img
                    src="{{ asset('assets/images/logo.png') }}"
                    alt="Logo"
                    class="brand-image opacity-75 shadow w-50"
                />
            </div>
            <div class="bg-dark bg-opacity-50 rounded-3 p-4">
                <h2 class="text-white fw-bold mb-3">УПС...</h2>
                <p class="text-white fs-5">
                    В данный момент <span class="fw-bold text-warning">нет свободных песен</span>
                    для регистрации.
                </p>
                <p class="text-white-50 mb-4">
                    Пожалуйста, попробуйте позже 🙏
                </p>
                <button
                    onclick="location.reload()"
                    class="btn w-100 py-2"
                    style="background-color: #ff7a00; color: white; border: none;">
                    Перезагрузить страницу
                </button>
            </div>
            @include('singer_form.parts.whatsapp_number')
        </div>
    </div>
@endsection



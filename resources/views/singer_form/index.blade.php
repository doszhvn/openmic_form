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
        <form id="singerForm" class="container rounded-3 p-4" method="POST">
            @csrf
            <div class="mb-3 d-flex flex-column align-items-center">
                <h1 class="text-center mb-3 text-white display-6 fw-bold">ОТКРЫТЫЙ МИКРОФОН</h1>

                <img
                    src="{{ asset('assets/images/logo.png') }}"
                    alt="Logo"
                    class="brand-image opacity-75 shadow w-50"
                />
            </div>
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Имя" required>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text">+7</span>
                    <input
                        id="phone_visible"
                        type="tel"
                        class="form-control"
                        placeholder="(XXX) XXX-XX-XX"
                        maxlength="15"
                        pattern="\(\d{3}\) \d{3}-\d{2}-\d{2}" required>
                    <input type="hidden" name="phone" id="phone_hidden">
                </div>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">@</span>
                <input type="text" name="instagram" class="form-control" placeholder="Instagram" required>
            </div>

            <div class="mb-3">
                <select name="song_id" class="form-select" required>
                    <option value="" selected disabled>Выберите песню</option>
                    @foreach($songs as $song)
                        <option value="{{$song['id']}}">{{$song['name']}}</option>
                    @endforeach
                </select>
            </div>

            <button
                id="formSubmitButton"
                type="submit"
                class="btn w-100 py-2"
                style="background-color: #ff7a00; color: white; border: none;">
                Зарегистрироваться
            </button>
            @include('singer_form.parts.whatsapp_number')
        </form>
    </div>

    @include('singer_form.parts.success_modal')
    @include('singer_form.parts.error_modal')
    <script>
        $(document).ready(function () {
            $('#phone_visible').on('input', function (event) {
                event.preventDefault();
                let numbers = $(this).val().replace(/\D/g, '').slice(-10);
                let formatted = '';
                if (numbers.length > 0) formatted = '(' + numbers.substring(0, 3);
                if (numbers.length >= 4) formatted += ') ' + numbers.substring(3, 6);
                if (numbers.length >= 7) formatted += '-' + numbers.substring(6, 8);
                if (numbers.length >= 9) formatted += '-' + numbers.substring(8, 10);
                $(this).val(formatted)
                $('#phone_hidden').val('+7' + numbers)
            });

            $("#singerForm").on('submit', function (event) {
                event.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('singer.order.create') }}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $("#formSubmitButton").prop('disabled', true);
                        $("#singerForm :input").prop("disabled", true);

                        // Вставляем ключ из ответа в модалку
                        $("#successModal .modal-body").html(
                            response.message
                        );

                        // Показываем модальное окно
                        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                        successModal.show();

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        let response = jqXHR.responseJSON; // <-- здесь JSON, который вернул сервер

                        let message = response?.message || 'Произошла ошибка'; // если message нет, показываем дефолт

                        // Вставляем ключ из ответа в модалку
                        $("#errorModal .modal-body").html(message);

                        // Показываем модальное окно
                        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                        errorModal.show();
                    }
                });
            });
        });
    </script>
@endsection

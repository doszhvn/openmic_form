@extends('layouts.admin')

@section('content')
        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title m-0">Текущий номер: {{$phone ['formatted'] ?? "Не указано"}}</h3>
                            </div>
                            <div class="card-body">
                                <form id="phoneForm">
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
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Изменить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <!-- /.col -->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->

    <script>
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

        $("#phoneForm").on('submit', function (event) {
            event.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('admin.phone.store') }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    location.reload()
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(jqXHR)
                }
            });
        });
    </script>
@endsection

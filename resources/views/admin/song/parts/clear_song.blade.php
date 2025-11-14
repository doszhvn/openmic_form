<!-- Модальное окно -->
<div class="modal fade" id="clearSongsModal" tabindex="-1" aria-labelledby="clearSongsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Заголовок модального окна -->
            <div class="modal-header">
                <h5 class="modal-title" id="clearSongsModalLabel">Вы уверены что хотите очистить песни?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>

            <!-- Тело модального окна -->
            <div class="modal-body">
                Песни очистятся вместе регистрациями пользователей
            </div>

            <!-- Футер модального окна -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button id="confirmClear" type="button" class="btn btn-danger">Да, очистить</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#confirmClear").on('click', function (event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('admin.songs.clear') }}",
                method: 'DELETE',
                processData: false,
                contentType: false,
                success: function () {
                    location.reload();
                },
                error: function () {
                    alert("Произошла ошибка при очистке")
                }
            });
        });
    });
</script>

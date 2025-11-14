<!-- Модальное окно -->
<div class="modal fade" id="createSongModal" tabindex="-1" aria-labelledby="createSongModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="createSongForm" class="container rounded-3 p-4" method="POST">
            <div class="modal-content">
                <!-- Заголовок модального окна -->
                <div class="modal-header">
                    <h5 class="modal-title" id="createSongModalLabel">Добавить 1 песню</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>

                <!-- Тело модального окна -->
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Название и исполнитель песни">
                    </div>
                </div>

                <!-- Футер модального окна -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Добавить песню</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    $(document).ready(function () {
        $("#createSongForm").on('submit', function (event) {
            event.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('admin.song.store') }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function () {
                    location.reload();
                },
                error: function () {
                    alert("Произошла ошибка при создании")
                }
            });
        });
    });
</script>


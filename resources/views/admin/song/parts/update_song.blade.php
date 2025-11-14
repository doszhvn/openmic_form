<div class="modal fade" id="updateSongModal{{ $song->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Заголовок -->
            <div class="modal-header">
                <h5 class="modal-title">Изменить песню: {{ $song->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Тело -->
            <div class="modal-body">
                <form id="updateSongForm{{ $song->id }}">
                    @csrf
                    <div class="mb-3">
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ $song->name }}"
                               placeholder="Название и исполнитель">
                    </div>
                </form>
            </div>

            <!-- Футер -->
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">Закрыть</button>

                <button form="updateSongForm{{ $song->id }}"
                        type="submit"
                        class="btn btn-primary">
                    Сохранить изменения
                </button>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#updateSongForm{{ $song->id }}").on('submit', function (event) {
            event.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('admin.song.update', ['song' => $song->id]) }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function () {
                    location.reload();
                },
                error: function () {
                    alert("Произошла ошибка при обновлении")
                }
            });
        });
    });
</script>

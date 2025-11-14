<div class="modal fade" id="deleteSongModal{{ $song->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Удалить песню {{ $song->name }}?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Вы точно хотите удалить песню <strong>{{ $song->name }}</strong>?
            </div>
            <div class="modal-footer">
                <form id="confirmDeleteSong{{ $song->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Да, удалить</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#confirmDeleteSong{{ $song->id }}").on('click', function (event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('admin.song.destroy', ['song' => $song->id]) }}",
                method: 'DELETE',
                processData: false,
                contentType: false,
                success: function () {
                    location.reload();
                },
                error: function () {
                    alert("Произошла ошибка при удалении")
                }
            });
        });
    });
</script>

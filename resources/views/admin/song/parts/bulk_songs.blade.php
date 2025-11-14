<!-- Модальное окно -->
<div class="modal fade" id="bulkSongModal" tabindex="-1" aria-labelledby="bulkSongModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="bulkSongForm" class="container rounded-3 p-4" method="POST">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="bulkSongModalLabel">Загрузить несколько песен</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <label class="form-label">Вставьте строки из Excel / Google Sheets:</label>
                    <textarea id="bulkSongsInput" class="form-control" rows="8"
                              placeholder="Название 1\nНазвание 2\nНазвание 3"></textarea>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Импортировать</button>
                </div>

            </div>
        </form>
    </div>
</div>


<script>
    $(document).ready(function () {

        $("#bulkSongForm").on('submit', function (event) {
            event.preventDefault();

            let rawText = $("#bulkSongsInput").val().trim();

            if (!rawText) return;

            // Разделяем строки
            let lines = rawText.split("\n").map(s => s.trim()).filter(s => s.length > 0);

            let formData = new FormData();
            lines.forEach(line => formData.append("songs[]", line));

            $.ajax({
                url: "{{ route('admin.song.store.bulk') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function () {
                    location.reload();
                },
                error: function (xhr) {
                    alert("Произошла ошибка при выгрузке")
                }
            });
        });

    });
</script>

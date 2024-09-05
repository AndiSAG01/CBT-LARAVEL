<!-- Trigger the modal with a button -->
<button class="btn btn-primary" data-toggle="modal" data-target="#editModal" data-id="{{ $item->id }}" data-name="{{ $item->name }}"><i class="fas fa-pen fa-sm"></i></button>
<!-- Modal -->
<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title">Edit Kategori</span>
               
            </div>
            <div class="modal-body">
                <form id="editForm" action="{{ route('kategori.update', $item->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <input type="text" name="user_id" value="{{ $user }}" hidden>
                    <div class="form-group">
                        <label for="editName">Nama Mata Pelajaran <i class="fas fa-book-reader"></i></label>
                        <input type="text" class="form-control" id="editName" name="name" value="{{ $item->name }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default bg-danger text-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');

            var modal = $(this);
            modal.find('#editName').val(name);
            modal.find('#editForm').attr('action', '/kategori/' + id);
        });
    });
</script>

 <form id="formAddBook" name="contact" role="form" method="post">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tạo mới sách</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group d-flex">
                    <label class="col-sm-3 col-form-label">Tên sách: </label>
                    <input type="text" name="book_name" size="30">
                </div>

                <div class="form-group d-flex">
                    <label class="col-sm-3 col-form-label">Tác giả:</label>
                    <select name="author_id" id="author_id_add" class="form-control">
                         <option value="" disabled selected> -- Lựa chọn --</option>
                        @foreach($authorList as $author)
                        <option value="{{ $author->id }}"> {{ $author->author_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-save-add" data-link-add="{{ route('book.store') }}">Lưu</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
            </div>
        </div>
    </div>
</form>
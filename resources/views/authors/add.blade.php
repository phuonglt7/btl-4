 <form id="formAuthor" name="contact" role="form" method="post" >
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tạo mới tác giả</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group d-flex">
                    <label class="col-sm-3 col-form-label">Tác giả:</label>
                    <input type="text" name="author_name" size="30">
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-save-add" data-link-add="{{ route('author.store') }}">Lưu</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
            </div>
        </div>
    </div>
</form>
 <form id="contactForm" name="contact" role="form" method="post" action="{{ route('author.store') }}">
    @csrf
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tạo mới tác giả</h4>
              <button type="button" class="close" data-dismiss="modal">×</button>
          </div>
          <div class="modal-body">
            <div class="form-group d-flex">
                <label>Tác giả:</label>
                <input type="text" name="author_name" size="30" required="">
            </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="submit" class="btn btn-success save-btn">Lưu</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
        </div>
    </div>
</div>
</form>
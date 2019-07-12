 <form id="contactForm" name="contact" role="form" method="post" action="{{ route('book.store') }}">
    @csrf
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tạo mới sách</h4>
              <button type="button" class="close" data-dismiss="modal">×</button>
          </div>
          <div class="modal-body">
            <div class="form-group d-flex">
                <label>Tên sách: </label>
                <input type="text" name="book_name" size="30" required="">
            </div>
            <div class="form-group d-flex">
                <label>Tác giả:</label>
                <select name="author_id">
                    <option value=""> -- Lựa chọn --</option>
                    @foreach($authorList as $author)
                    <option value="{{ $author->id }}"> {{ $author->author_name }}</option>
                    @endforeach
                </select>
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
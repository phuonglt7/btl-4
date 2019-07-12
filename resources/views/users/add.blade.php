 <form id="contactForm" name="contact" role="form" method="post" action="{{ route('user.store') }}">
    @csrf
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tạo mới sách</h4>
              <button type="button" class="close" data-dismiss="modal">×</button>
          </div>
          <div class="modal-body">
            @include('layouts.announce')
            <div class="form-group d-flex">
                <label>Username: </label>
                <input type="text" name="username" size="30" required="">
            </div>
            <div class="form-group d-flex">
                <label>Email: </label>
                <input type="email" name="email" size="30" required="">
            </div>
            <div class="form-group d-flex">
                <label>Fullname: </label>
                <input type="text" name="fullname" size="30" required="">
            </div>
            <div class="form-group d-flex">
                <label>Password: </label>
                <input type="password" name="password" size="30" required="">
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
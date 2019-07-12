<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/comfirmDelete.js') }}"></script>
    <script src="{{ asset('js/author/validate.js') }}"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <form id="formAuthor" name="contact" role="form" method="post" action="{{ route('author.store') }}">
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
                <input type="text" name="author_name" size="30">
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
    </body>
</html>

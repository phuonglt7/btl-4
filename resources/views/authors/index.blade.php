@extends('layouts.menuLeft')

@section('execute')
<h3> QUẢN LÝ TÁC GIẢ </h3>
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Tạo mới tác giả
</button>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            @include('authors.add')
        </div>
    </div>
</div>

<table class="table table-striped">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
    </tr>
</thead>
<tbody>
  <tr>
    <td>John</td>
    <td>Doe</td>
    <td>
        <button class="btn-delete" > Xoa </button>
    </td>
</tr>
<tr>
    <td>Mary</td>
    <td>Moe</td>
    <td>mary@example.com</td>
</tr>
</tbody>
</table>
@endsection

<table class="table table-bordered data-table">
   <thead>
    <th>STT</th>
    <th>Tên sách</th>
    <th> Tác giả </th>
    <th> Trạng thái </th>
    <th> Người mượn </th>
    <th width="200px">Action</th>
</thead>
<tbody>
    @foreach($view as $key=>$item)
    <tr data-id="{{ $item->id }}">
        <td> {{ $key + 1 + PAGE * ($page - 1)}} </td>
        <td> {{ $item->book_name }} </td>
        @foreach($authorList as $author)
        @if ($author->id == $item->author_id)
        <td data-author="{{ $item->author_id }}"> {{ $author->author_name }} </td>
        @endif
        @endforeach

        @if ($item->book_status == 1)
        <td> Chưa mượn </td>
        @elseif($item->book_status == 2)
        <td> Đang xem </td>
        @elseif ($item->book_status == 3)
        <td> Đã mượn </td>
        @endif
        <td>
            @foreach($item->users as $p)
            {{ $p->username}}
            @endforeach
        </td>

        <td>
            <div class = "d-flex">
                <button class='btn btn-info btn-edit mr-4 ml-4'>Sửa</button>
                <button type="submit" class="btn btn-danger btn-delete">Xóa</button>
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
</table>
{{ $view->links() }}
@include('books.edit')

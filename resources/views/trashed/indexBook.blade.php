<table class="table table-bordered data-table">
<thead>
    <th>STT</th>
    <th>Tên sách</th>
    <th> Tác giả </th>
    <th width="200px">Action</th>
</thead>
<tbody>
    @foreach($viewBook as $key => $item)
    <tr data-id="{{ $item->id }}">
        <td> {{ $key + 1 + PAGE * ($page - 1)}} </td>
        <td> {{ $item->book_name }} </td>

        @foreach($authorList as $author)
        @if ($author->id == $item->author_id)
        <td data-author="{{ $author->id }}"> {{ $author->author_name }} </td>
        @endif
        @endforeach
        <td>
            <div class = "d-flex">
                    <button type="submit" class="btn btn-info mr-4 ml-4 btn-restore" data-link="{{ route('trash-book.restore') }}">Phục hồi</button>
                    <button type="submit" class="btn btn-danger btn-delete" data-link-delete="{{ route('trash-book.deleteAjax') }}">Xóa</button>
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
</table>
{{ $viewBook->links() }}
 <script src="{{ asset('js/trashBook.js') }}"></script>

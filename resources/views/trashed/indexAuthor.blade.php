<table class="table table-bordered data-table">
<thead>
    <th>STT</th>
    <th>Author</th>
    <th width="200px">Action</th>

</thead>
<tbody>
    @foreach($view as $key => $item)
    <tr data-id="{{ $item->id }}" data-name="{{ $item->author_name }}" >
        <td> {{ $key + 1 + PAGE * ($page - 1)}} </td>
        <td> {{ $item->author_name }} </td>
        <td>
            <div class = "d-flex">
                    <button type="submit" class="btn btn-info mr-4 ml-4 btn-restore" data-link="{{ route('trash-author.restore') }}">Phục hồi</button>
                    <button type="submit" class="btn btn-danger btn-delete" data-link-delete="{{ route('trash-author.deleteAjax') }}">Xóa</button>
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
</table>
{{ $view->links() }}
 <script src="{{ asset('js/trashBook.js') }}"></script>

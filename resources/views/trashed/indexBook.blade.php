@extends('trashed.layouts')

@section('content-trashed')

<thead>
    <th>STT</th>
    <th>Tên sách</th>
    <th> Tác giả </th>
    <th width="200px">Action</th>

</thead>
<tbody>
    @foreach($view as $item)
    <tr data-id="{{ $item->id }}">
        <td> {{ $i ++}}</td>
        <td> {{ $item->book_name }} </td>

        @foreach($authorList as $author)
        @if ($author->id == $item->author_id)
        <td data-author="{{ $author->id }}"> {{ $author->author_name }} </td>
        @endif
        @endforeach
        <td>
            <div class = "d-flex">
                <form action="{{route('trash-book.restore') }}" class="submitDelete" method="post" onsubmit="return confirmRestore();" >
                    {!! csrf_field() !!}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="book_id" value="{{ $item->id }}">
                    <button type="submit" class="btn btn-info btn-edit mr-4 ml-4">Phục hồi</button>
                </form>
                <form action="{{route('trash-book.delete') }}" class="submitDelete" method="post" onsubmit="return confirmDeleteTrashAuthor();" >
                    {!! csrf_field() !!}
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="book_id" value="{{ $item->id }}">
                    <button type="submit" class="btn btn-danger btn-cancel">Xóa</button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
@endsection

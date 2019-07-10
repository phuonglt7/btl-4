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
                <button class='btn btn-info btn-edit mr-4 ml-4'>Sửa</button>
                <form action="{{route('book.destroy', $item->id) }}" class="submitDelete" method="post" onsubmit="return confirmDeleteAuthor();" >
                    {!! csrf_field() !!}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger btn-cancel">Xóa</button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
@endsection

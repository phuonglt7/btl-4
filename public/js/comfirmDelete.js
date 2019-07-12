function confirmDeleteAuthor()
{
    var x = confirm("Bạn có muốn thực hiện xóa?");
    if (x)
        return true;
    else
      	return false;
}

function confirmDeleteTrashAuthor()
{
    var z = confirm("Bạn có muốn thực hiện xóa tác giả này và xóa sách tác giả?");
    if (z)
        return true;
    else
      	return false;
}

function confirmRestore()
{
    var y = confirm("Bạn có muốn thực hiện phục hồi dữ liệu?");
    if (y)
        return true;
    else
      	return false;
}
$(document).ready(function () {
    $('#btn_search').attr('disabled', true);
    $("input[name='search']").on('input change keyup', function () {
        var str, message;
        str = $("input[name='search']").val().length;
        if (str < 3) {
            $('#src-warning').css('display', 'block');
            $('#btn_search').attr('disabled', true);
        } else {
            $('#btn_search').attr('disabled', false);
            $('#src-warning').css('display', 'none');
        }
    });
});

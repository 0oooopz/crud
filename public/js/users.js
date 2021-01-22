$(document).ready(function () {
    $('.delete-btn').click(function () {
        var res = confirm('Are you sure ?');
        if (!res) {
            return false;
        }
    })
});
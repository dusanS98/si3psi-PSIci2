$(document).ready(function () {
    $('#dataTable').DataTable();

    $("#sidebarToggle").on("click", function (e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
});

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
$(".openModal").on("click", function () {
    let title = $(this).data("title");
    let url = $(this).data("url");
    let type = $(this).data("type");
    $.ajax({
        type: type,
        url: url,
        success: function (response) {
            $("#exampleModal").modal("show");
            $(".modal-title").text(title);
            $("#modalBody").html(response);
        },
    });
});


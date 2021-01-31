require('./bootstrap');

$(function () {
    $("#new-row").on("click", function () {
        const newRow = document.createElement("tr");
        newRow.innerHTML = $("#new-collection-row-template").html();
        newRow.className="new-collection-row";
        $("#collection-table-body").prepend(newRow);
    });
});

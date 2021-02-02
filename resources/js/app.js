require('./bootstrap');

$(function () {
    $("#new-row").on("click", function () {
        const newRow = $(".new-collection-row:first").clone();
        newRow[0].children[2].children[0].value = "";
        $("#collection-table-body").prepend(newRow);
    });

    $("#filter-day").on("change", function (e) {
        const todayNumberInWeek = new Date().getDay();
        const todayRows = $(`.day-row[data-number-in-week="${todayNumberInWeek}"`)
        if ($(e.target).is(":checked")) {
            $(".day-row").hide();
            todayRows.show();
        } else {
            $(".day-row").show();
        }
    })

    $(".filter-collections").on("keyup", function (e) {
        const filterValue = $(this).val().toLowerCase();
        const filterData = $(this)[0].dataset.col;
        if (e.key === 'Tab') return false;
        $(`.collection-${filterData}`).each(function (i, e) {
            $(this).parent().toggle(e.innerText.toLowerCase().includes(filterValue));
        });
    });
});

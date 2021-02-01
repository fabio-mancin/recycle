require('./bootstrap');

$(function () {
    $("#new-row").on("click", function () {
        const newRow=$(".new-collection-row:first").clone();
        console.log(newRow);
        $("#collection-table-body").prepend(newRow);
    });

    $("#filter-day").on("change", function(e){
        const todayNumberInWeek = new Date().getDay();
        const todayRows = $(`.day-row[data-number-in-week="${todayNumberInWeek}"`)
        if ($(e.target).is(":checked")) {          
            $(".day-row").hide();
            todayRows.show();
        } else {
            $(".day-row").show();
        }
    })
});

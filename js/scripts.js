$("#new").click(function () {
    $.ajax({
        url: "new.php"
    }).done(function (data) { // data what is sent back by the php page
        $("#content").html(data); // display data
        ActivateTinyMCE();
    });
});

$("#stats").click(function () {
    $.ajax({
        url: "stats.php"
    }).done(function (data) { // data what is sent back by the php page
        $("#content").html(data); // display data
    });
});

$("#list").click(function () {
    $.ajax({
        url: "list.php"
    }).done(function (data) { // data what is sent back by the php page
        $("#content").html(data); // display data
    });
});
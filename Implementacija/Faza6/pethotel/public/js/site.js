$(document).ready(function () {
    $(".custom-control-input").click(function () {
        var baseUrl = $("#base").val();
        var page = $("#page").val();

        var dogs = $("#customCheckDogs").prop("checked");
        var cats = $("#customCheckCats").prop("checked");
        var birds = $("#customCheckBirds").prop("checked");
        var fishes = $("#customCheckFishes").prop("checked");
        var littleAnimals = $("#customCheckLittleAnimals").prop("checked");

        $.ajax(
            {
                type: "post",
                url: baseUrl + "/Shop/searchCategories/" + page,
                data: {
                    dogs: dogs,
                    cats: cats,
                    birds: birds,
                    fishes: fishes,
                    littleAnimals: littleAnimals
                },
                success: function (response) {
                    var res = response.split("#delimiter#");

                    if (res.length == 2) {
                        if (res[0] == "" && page > 1) {
                            window.location.href = baseUrl + "/Shop/showCategories/" + (page - 1);
                        }
                        $("#articles").html(res[0]);
                        $("#pagination").html(res[1]);
                    }
                }
            }
        );
    });
});


//Autor: Dušan Stanivuković 2017/0605

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
                        if (res[0] == "<div class='alert alert-info alert-dismissible text-center mx-auto my-4'>"
                            + "<strong>Nema proizvoda</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'>"
                            + "<span aria-hidden='true'>&times;</span></button></div>"
                            && page > 1) {
                            window.location.href = baseUrl + "/Shop/showArticlesByCategory/" + (page - 1);
                        }
                        $("#articles").html(res[0]);
                        $("#pagination").html(res[1]);
                    }
                }
            }
        );
    });
    $("#petCheckDogs").click(customPetCheck);
    $("#petCheckCats").click(customPetCheck);
    $("#petCheckFishes").click(customPetCheck);
    $("#petCheckBirds").click(customPetCheck);
    $("#petCheckLittleAnimals").click(customPetCheck);

    function customPetCheck() {
        var baseUrl = $("#base").val();
        var page = $("#page").val();

        var dogs = $("#petCheckDogs").prop("checked");
        var cats = $("#petCheckCats").prop("checked");
        var birds = $("#petCheckBirds").prop("checked");
        var fishes = $("#petCheckFishes").prop("checked");
        var littleAnimals = $("#petCheckLittleAnimals").prop("checked");

        $.ajax(
            {
                type: "post",
                url: baseUrl + "/Pet/searchCategoriesPets/" + page,
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
                        if (res[0] == "<div class='alert alert-info alert-dismissible text-center mx-auto my-4'>"
                            + "<strong>Nema proizvoda</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'>"
                            + "<span aria-hidden='true'>&times;</span></button></div>"
                            && page > 1) {
                            window.location.href = baseUrl + "/Pet/showPetsByCategory/" + (page - 1);
                        }
                        $("#pets").html(res[0]);
                        $("#pagination").html(res[1]);
                    }
                }
            }
        );
    }

    $("#searchButton").click(function () {
        var baseUrl = $("#base").val();
        var name = $("#searchName").val();

        $.ajax(
            {
                type: "post",
                url: baseUrl + "/Shop/searchNames/",
                data: {
                    name: name
                },
                success: function (response) {
                    var res = response.split("#delimiter#");

                    if (res.length == 2) {
                        $("#articles").html(res[0]);
                        $("#pagination").html(res[1]);

                        if (!$("#customCheckDogs").prop("checked"))
                            $("#customCheckDogs").click();
                        if (!$("#customCheckCats").prop("checked"))
                            $("#customCheckCats").click();
                        if (!$("#customCheckBirds").prop("checked"))
                            $("#customCheckBirds").click();
                        if (!$("#customCheckFishes").prop("checked"))
                            $("#customCheckFishes").click();
                        if (!$("#customCheckLittleAnimals").prop("checked"))
                            $("#customCheckLittleAnimals").click();
                    }
                }
            }
        );
    });
});

function minus() {
    var amount = parseInt($("#modalAmount").val());
    if (amount > 1)
        $("#modalAmount, #hiddenAmount").val(--amount);
}

function plus() {
    var amount = parseInt($("#modalAmount").val());
    $("#modalAmount, #hiddenAmount").val(++amount);
}

function updateAmount() {
    var amount = parseInt($("#modalAmount").val());
    if (amount >= 1)
        $("#hiddenAmount").val(amount);
}

function showAmount(amountId) {
    amountId = amountId.split("#");
    var amount = $("#articleAmount" + amountId[1]).html();
    $("#modalAmount").val(amount);
    $("#modalHiddenAmount").val(amountId[0]);
    $("#modalHiddenArticleId").val(amountId[1]);
}

function changeAmount() {
    var baseUrl = $("#base").val();
    var amount = $("#modalAmount").val();
    var articleId = $("#modalHiddenArticleId").val();
    var orderId = $("#modalHiddenOrderId").val();

    if (amount <= 0) amount = 1;

    $.ajax(
        {
            type: "post",
            url: baseUrl + "/Shop/changeAmount",
            data: {
                amount: amount,
                articleId: articleId,
                orderId: orderId
            },
            success: function (response) {
                if (response != "error") {
                    var res = response.split("#");
                    if (res.length == 3) {
                        $("#articleAmount" + articleId).html(res[0]);
                        $("#articlePrice" + articleId).html(res[1]);
                        $("#priceAlert").html(res[2]);
                    }
                }
                $("#modalCloseButton").click();
            }
        }
    );
}

function removeArticle(articleId) {
    var baseUrl = $("#base").val();
    var orderId = $("#modalHiddenOrderId").val();
    articleId = parseInt(articleId);

    $.ajax(
        {
            type: "post",
            url: baseUrl + "/Shop/removeArticleFromCart",
            data: {
                articleId: articleId,
                orderId: orderId
            },
            success: function (response) {
                var res = response.split("#delimiter#");
                if (res.length == 2) {
                    $("#priceAlert").html(res[0]);
                    $("#articles").html(res[1]);
                }
            }
        }
    );
}


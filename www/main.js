var customValues = {
    playerName: "",
    playerHand: "",
    playerHeight: "",
    playerCountry: "",
    playerRank: ""
};

$(document).ready ( function() {

    updateCustomValues();

    $( ".search_button" ).click(function() {

        getCustomData();
      });

})

updateCustomValues = function () {
    $(".player-name").change(function () {
        customValues.playerName = $(this).val();
        console.log(customValues.playerName);
    })
    $(".player-hand").change(function () {
        customValues.playerHand = $(this).val();
        console.log(customValues.playerHand);
    })
    $(".player-height").change(function () {
        customValues.playerHeight = $(this).val();
        console.log(customValues.playerHeight);
    })
    $(".player-country").change(function () {
        customValues.playerCountry = $(this).val();
        console.log(customValues.playerCountry);
    })
    $(".player-rank").change(function () {
        customValues.playerRank = $(this).val();
        console.log(customValues.playerRank);
    })
}

getCustomData = function () {
    console.log(customValues.playerRank);
    var search_url = "player_table.php/?custom_search=true" +
                        "&playerName=" + customValues.playerName +
                        "&playerHand=" + customValues.playerHand +
                        "&playerHeight=" + customValues.playerHeight +
                        "&playerCountry=" + customValues.playerCountry + 
                        "&playerRank=" + customValues.playerRank

    $.ajax({
        url: search_url,
        context: document.body
      }).done(function(data) {
        console.log(data);

        $("#data-table").html(data); // remember to call event hanlders again after reloading html
        updateCustomValues();
      });
}
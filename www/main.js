var customValues = {
    playerName: ["", ".name-td"],
    playerHand: ["", ".hand-td"],
    playerHeight: ["", ".height-td"],
    playerCountry: ["", ".country-td"],
    playerRank: ["",".rank-td"]
};

$(document).ready ( function() {

    updateCustomValues();
    sortColumns();

    $( ".search_button" ).click(function() {
        getCustomData();
      });
    $( ".get_all_button" ).click(function() {
        getAllData();
      });

})

resetCustomValues = function () {
    customValues.playerName[0] = "";
    customValues.playerHand[0] = "";
    customValues.playerHeight[0] = "";
    customValues.playerCountry[0] = "";
    customValues.playerRank[0] = "";
}

filterCurrentCol = function () {
    var nameTuples = $(customValues.playerName[1]);
    var handTuples = $(customValues.playerHand[1]);
    var heightTuples = $(customValues.playerHeight[1]);
    var countryTuples = $(customValues.playerCountry[1]);
    var rankTuples = $(customValues.playerRank[1]);

    for (i = 0; i < nameTuples.length; i++) { // all the same size
        if (nameTuples[i].innerText.toUpperCase().indexOf(customValues.playerName[0].toUpperCase()) > -1
            && handTuples[i].innerText.toUpperCase().indexOf(customValues.playerHand[0].toUpperCase()) > -1
            && heightTuples[i].innerText.toUpperCase().indexOf(customValues.playerHeight[0].toUpperCase()) > -1
            && countryTuples[i].innerText.toUpperCase().indexOf(customValues.playerCountry[0].toUpperCase()) > -1
            && rankTuples[i].innerText.toUpperCase().indexOf(customValues.playerRank[0].toUpperCase()) > -1)
            nameTuples[i].parentNode.style.display = "";
        else {
            nameTuples[i].parentNode.style.display = "none";
        }
    }
}

updateCustomValues = function () {
    $(".player-name").keyup(function () {
        customValues.playerName[0] = $(this).val();
        console.log(customValues.playerName[0]);
        filterCurrentCol();
    })
    $(".player-hand").keyup(function () {
        customValues.playerHand[0] = $(this).val();
        console.log(customValues.playerHand[0]);
        filterCurrentCol();
    })
    $(".player-height").keyup(function () {
        customValues.playerHeight[0] = $(this).val();
        console.log(customValues.playerHeight[0]);
        filterCurrentCol();
    })
    $(".player-country").keyup(function () {
        customValues.playerCountry[0] = $(this).val();
        console.log(customValues.playerCountry[0]);
        filterCurrentCol(customValues.playerCountry[0], "country-td");
    })
    $(".player-rank").keyup(function () {
        customValues.playerRank[0] = $(this).val();
        console.log(customValues.playerRank[0]);
        filterCurrentCol(customValues.playerRank[0], "rank-td");
    })
}

getCustomData = function () {
    console.log(customValues.playerName[0]);
    var search_url = "player_table.php/?custom_search=true" +
                        "&playerName=" + customValues.playerName[0] +
                        "&playerHand=" + customValues.playerHand[0] +
                        "&playerHeight=" + customValues.playerHeight[0] +
                        "&playerCountry=" + customValues.playerCountry[0] + 
                        "&playerRank=" + customValues.playerRank[0]

    $.ajax({
        url: search_url,
        context: document.body
      }).done(function(data) {
        console.log(data);

        $("#data-table").html(data); // remember to call event hanlders again after reloading html
        resetCustomValues();
        updateCustomValues();
        sortColumns();
      });
}

getAllData = function () {
    console.log("Getting all data");
    var search_url = "player_table.php"
    $.ajax({
        url: search_url,
        context: document.body
      }).done(function(data) {
        $("#data-table").html(data); // remember to call event hanlders again after reloading html
        resetCustomValues();
        updateCustomValues();
        sortColumns();
      });
}

sortColumns = function () {
    var tuplesLength = 100;

    $(".sort-name-asc").click( function() {    
        var playerTuples = Array.from($(".player-tuple"));
        playerTuples.sort(function(a,b) {
            return a.childNodes[1].innerText.localeCompare(b.childNodes[1].innerText);
        });
        replaceTuples(tuplesLength, playerTuples);
    });
    $(".sort-name-desc").click( function() {   
        var playerTuples = Array.from($(".player-tuple")); 
        playerTuples.sort(function(b,a) {
            return a.childNodes[1].innerText.localeCompare(b.childNodes[1].innerText);
        });
        replaceTuples(tuplesLength, playerTuples);
    });
    $(".sort-height-asc").click( function() {    
        var playerTuples = Array.from($(".player-tuple"));
        playerTuples.sort(function(a,b) {
            return a.childNodes[5].innerText.localeCompare(b.childNodes[5].innerText);
        });
        replaceTuples(tuplesLength, playerTuples);
    });
    $(".sort-height-desc").click( function() {   
        var playerTuples = Array.from($(".player-tuple")); 
        playerTuples.sort(function(b,a) {
            return a.childNodes[5].innerText.localeCompare(b.childNodes[5].innerText);
        });
        replaceTuples(tuplesLength, playerTuples);
    });
    $(".sort-country-asc").click( function() {    
        var playerTuples = Array.from($(".player-tuple"));
        playerTuples.sort(function(a,b) {
            return a.childNodes[7].innerText.localeCompare(b.childNodes[7].innerText);
        });
        replaceTuples(tuplesLength, playerTuples);
    });
    $(".sort-country-desc").click( function() {   
        var playerTuples = Array.from($(".player-tuple")); 
        playerTuples.sort(function(b,a) {
            return a.childNodes[7].innerText.localeCompare(b.childNodes[7].innerText);
        });
        replaceTuples(tuplesLength, playerTuples);
    });
    $(".sort-rank-asc").click( function() {    
        var playerTuples = Array.from($(".player-tuple"));
        playerTuples.sort(function(a,b) {
            return a.childNodes[9].innerText.localeCompare(b.childNodes[9].innerText);
        });
        replaceTuples(tuplesLength, playerTuples);
    });
    $(".sort-rank-desc").click( function() {   
        var playerTuples = Array.from($(".player-tuple")); 
        playerTuples.sort(function(b,a) {
            return a.childNodes[9].innerText.localeCompare(b.childNodes[9].innerText);
        });
        replaceTuples(tuplesLength, playerTuples);
    });
}

replaceTuples = function(length, sorted) {
    for (i = 0; i < length; i++) {
        $(".player-table-body")[0].append(sorted[i])
    }
}
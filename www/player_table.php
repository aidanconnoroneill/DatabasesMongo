<table class="table table-hover table-responsive" id="data-table">
        <thead>
        <tr>
            <th scope="col">

                <input class="form-control player-name" type="text" value="" placeholder="Filter name"> 
                <div class="dropdown" >
                  <button class="btn btn-outline-secondary dropdown-toggle filter_button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Name
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Sort Desc</a>
                    <a class="dropdown-item" href="#">Sort Asc</a>
                    </div>
            </th>
            <th scope="col"> 
                <input class="form-control player-hand" type="text" value="" placeholder="Filter hand"> 
                <div class="dropdown" >
                  <button class="btn btn-outline-secondary dropdown-toggle filter_button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hand
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Sort Desc</a>
                    <a class="dropdown-item" href="#">Sort Asc</a>
                    </div>
            </th>
            <th scope="col">
                <input class="form-control player-height" type="text" value="" placeholder="Filter height"> 
                <div class="dropdown" >
                  <button class="btn btn-outline-secondary dropdown-toggle filter_button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Height
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Sort Desc</a>
                    <a class="dropdown-item" href="#">Sort Asc</a>
                    </div>
            </th>
            <th scope="col">
                <input class="form-control player-country" type="text" value="" placeholder="Filter country"> 
                <div class="dropdown" >
                  <button class="btn btn-outline-secondary dropdown-toggle filter_button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Country
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Sort Desc</a>
                    <a class="dropdown-item" href="#">Sort Asc</a>
                    </div>
            </th>
            <th scope="col">
                <input class="form-control player-rank" type="text" value="" placeholder="Filter rank"> 
                <div class="dropdown" >
                  <button class="btn btn-outline-secondary dropdown-toggle filter_button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Rank
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Sort Desc</a>
                    <a class="dropdown-item" href="#">Sort Asc</a>
                    </div>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
            require 'vendor/autoload.php'; // include composer's autoloader
            $conn = new MongoDB\Client('mongodb://localhost');
            $db = $conn->tennis;
            $collection = $db->players;
            $tuple_count = 0;

            if (isset($_GET['custom_search'])) {
              $playerName = $_GET['playerName'];
              $playerHand = $_GET['playerHand'];
              $playerHeight = $_GET['playerHeight'];
              $playerCountry = $_GET['playerCountry'];
              $playerRank = $_GET['playerRank'];

              $players = $collection->find([ 'name' => $playerName, 'hand' => $playerHand, 'height' => $playerHeight, 'country' => $playerCountry, 'rank' => $playerRank ]);

              foreach ($players as $player) {
                echo "<tr class='player-tuple'> <td class='name-td'>$player[name]</td> <td class='hand-td'>$player[hand]</td> <td class='height-td'>$player[height]</td> <td class='country-td'>$player[country]</td> <td class='rank-td'>$player[rank]</td></tr>";
              }
              
            } else {
              $players = $collection->find();

              foreach ($players as $player) {
                $tuple_count++;
                if ($tuple_count > 100) {
                  break;
                }
                echo "<tr class='player-tuple'> <td class='name-td'>$player[name]</td> <td class='hand-td'>$player[hand]</td> <td class='height-td'>$player[height]</td> <td class='country-td'>$player[country]</td> <td class='rank-td'>$player[rank]</td></tr>";
              }
            }

          ?>                                      
        </tbody>
      </table>
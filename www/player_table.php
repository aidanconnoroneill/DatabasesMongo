<table class="table table-hover table-responsive" id="data-table">
        <thead>
          <tr>
            <th scope="col">
                <input class="form-control player-name" type="text" value="" placeholder="Enter name"> 
                <input class="btn btn-outline-secondary filter_button"  type="submit" value="Name">
            </th>
            <th scope="col"> 
                <input class="form-control player-hand" type="text" value="" placeholder="Enter hand"> 
                <input class="btn btn-outline-secondary filter_button" type="submit" value="Hand">
            </th>
            <th scope="col">
                <input class="form-control player-height" type="text" value="" placeholder="Enter height"> 
                <input class="btn btn-outline-secondary filter_button" type="submit" value="Height">
            </th>
            <th scope="col">
                <input class="form-control player-country" type="text" value="" placeholder="Enter country"> 
                <input class="btn btn-outline-secondary filter_button" type="submit" value="Country">
            </th>
            <th scope="col">
                <input class="form-control player-rank" type="text" value="" placeholder="Enter rank"> 
                <input class="btn btn-outline-secondary filter_button" type="submit" value="Rank">
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
                echo "<tr> <td>$player[name]</td> <td>$player[hand]</td> <td>$player[height]</td> <td>$player[country]</td> <td>$player[rank]</td></tr>";
              }
              
            } else {
              $players = $collection->find();

              foreach ($players as $player) {
                $tuple_count++;
                if ($tuple_count > 100) {
                  break;
                }
                echo "<tr> <td>$player[name]</td> <td>$player[hand]</td> <td>$player[height]</td> <td>$player[country]</td> <td>$player[rank]</td></tr>";
              }
            }

          ?>                                      
        </tbody>
      </table>
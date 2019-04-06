<table class="table table-hover table-responsive" id="data-table">
        <thead>
        <tr>
            <th scope="col">
                <input class="form-control player-name" type="text" value="" placeholder="Filter name"> 
                <div class="dropdown" >
                    <button class="btn btn-outline-secondary dropdown-toggle filter_button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Winner
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item sort-name-desc" href="#">Sort Desc</a>
                      <a class="dropdown-item sort-name-asc" href="#">Sort Asc</a>
                    </div>
                </div>
            </th>
            <th scope="col"> 
                <input class="form-control player-hand" type="text" value="" placeholder="Filter hand"> 
                <div class="dropdown" >
                    <button class="btn btn-outline-secondary dropdown-toggle filter_button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Looser
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item sort-hand-desc" href="#">Sort Desc</a>
                      <a class="dropdown-item sort-hand-asc" href="#">Sort Asc</a>
                    </div>
                </div>
            </th>
            <th scope="col">
                <input class="form-control player-height" type="text" value="" placeholder="Filter height"> 
                <div class="dropdown" >
                    <button class="btn btn-outline-secondary dropdown-toggle filter_button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Winner Seed
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item sort-height-desc" href="#">Sort Desc</a>
                      <a class="dropdown-item sort-height-asc" href="#">Sort Asc</a>
                    </div>
                </div>
            </th>
            <th scope="col">
                <input class="form-control player-country" type="text" value="" placeholder="Filter country"> 
                <div class="dropdown" >
                    <button class="btn btn-outline-secondary dropdown-toggle filter_button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Looser Seed
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item sort-country-desc" href="#">Sort Desc</a>
                      <a class="dropdown-item sort-country-asc" href="#">Sort Asc</a>
                    </div>
                </div>
            </th>
            <th scope="col">
                <input class="form-control player-rank" type="text" value="" placeholder="Filter rank"> 
                <div class="dropdown" >
                    <button class="btn btn-outline-secondary dropdown-toggle filter_button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Tournament
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item sort-rank-desc" href="#">Sort Desc</a>
                      <a class="dropdown-item sort-rank-asc" href="#">Sort Asc</a>
                    </div>
                </div>
            </th>
          </tr>
        </thead>
        <tbody class="player-table-body">
          <?php
            require 'vendor/autoload.php'; // include composer's autoloader
            $conn = new MongoDB\Client('mongodb://localhost');
            $db = $conn->tennis;
            $collection = $db->matches;
            $tuple_count = 0;

            $matches = $collection->find();

              foreach ($matches as $match) {
                $tuple_count++;
                if ($tuple_count > 100) {
                  break;
                }
                echo "<tr class='player-tuple'> <td class='name-td'>$match[winner]</td> <td class='hand-td'>$match[loser]</td> <td class='height-td'>$match[winnerSeed]</td> <td class='country-td'>$match[loserSeed]</td> <td class='rank-td'>$match[tourney]</td></tr>";
              }
          ?>                                      
        </tbody>
      </table>
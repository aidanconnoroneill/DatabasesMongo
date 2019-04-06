<table class="table table-hover table-responsive" id="data-table">
        <thead>
        <tr>
            <th scope="col"> 
                <input class="form-control player-hand" type="text" value="" placeholder="Filter hand"> 
                <div class="dropdown" >
                    <button class="btn btn-outline-secondary dropdown-toggle filter_button" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Name
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
                      Surface
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
                      Date
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item sort-country-desc" href="#">Sort Desc</a>
                      <a class="dropdown-item sort-country-asc" href="#">Sort Asc</a>
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
            $collection = $db->tourneys;
            $tuple_count = 0;

            $tourneys = $collection->find();

            foreach ($tourneys as $tourney) {
              $tuple_count++;
              if ($tuple_count > 100) {
                break;
              }
              echo "<tr class='player-tuple'> <td class='name-td'>$tourney[name]</td> <td class='hand-td'>$tourney[surface]</td> <td class='height-td'>$tourney[date]</td>";
            }
          ?>                                      
        </tbody>
      </table>
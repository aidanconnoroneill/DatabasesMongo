<table class="table table-hover table-responsive">
        <thead>
          <tr>
            <th scope="col">
                <input class="form-control" type="text" placeholder="Enter name"> 
                <input class="btn btn-outline-secondary filter_button"  type="submit" value="Name">
            </th>
            <th scope="col"> 
                <input class="form-control" type="text" placeholder="Enter hand"> 
                <input class="btn btn-outline-secondary filter_button" type="submit" value="Hand">
            </th>
            <th scope="col">
                <input class="form-control" type="text" placeholder="Enter height"> 
                <input class="btn btn-outline-secondary filter_button" type="submit" value="Height">
            </th>
            <th scope="col">
                <input class="form-control" type="text" placeholder="Enter country"> 
                <input class="btn btn-outline-secondary filter_button" type="submit" value="Country">
            </th>
            <th scope="col">
                <input class="form-control" type="text" placeholder="Enter rank"> 
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
            $players = $collection->find();
            $tuple_count = 0;
            foreach ($players as $player) {
              $tuple_count++;
              if ($tuple_count > 100) {
                break;
              }
              echo "<tr> <td>$player[name]</td> <td>$player[hand]</td> <td>$player[height]</td> <td>$player[country]</td> <td>$player[rank]</td></tr>";
            }
          ?>                                      
        </tbody>
      </table>
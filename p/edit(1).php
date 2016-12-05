<html>
  <head>
    <title>e</title>
  </head>
  <body>
    <?php
      // define variables and set to empty values
      $numErr = $nameErr = $descriptionErr = $heightErr = $weightErr = $captureErr = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num = test_input($_POST["num"]);
        $name = test_input($_POST["name"]);
        $height = test_input($_POST["height"]);
        $weight = test_input($_POST["weight"]);
        $description = test_input($_POST["description"]);
        $capture = test_input($_POST["capture"]);

        $link = mysqli_connect('localhost', 'yimingf', 'yimingf-xmlpub13', 'yimingf');
        // Check connection
        if (mysqli_connect_errno()) {
          printf("Connect failed: %s\n", mysqli_connect_error());
          exit();
        }

        $sql_link = "successfully linked";
        $description = mysqli_real_escape_string($link, $description);
        $capture = mysqli_real_escape_string($link, $capture);
        
        $database = ($_POST['lang'] == 'de') ? 'pokemon_de' : 'pokemon';

        // check duplicates of number.
        $query = "UPDATE  $database 
                  SET     height  = '$height',
                          weight  = '$weight',
                          name    = '$name',
                          description = '$description',
                          capture = '$capture'
                  WHERE   (num = ". $num .");";

        // Execute the query
        if (($result = mysqli_query($link, $query)) === false) {
           printf("Query failed: %s<br />\n%s", $query, mysqli_error($link));
           exit();
        } else {
           $sql_link .= " and successfully updated!";
        }

      }

      function test_input($data) {
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         //$data = mysqli_real_escape_string($data);
         return $data;
      }

      $num  = $_GET['num'];
      $link = mysqli_connect('localhost', 'yimingf', 'yimingf-xmlpub13', 'yimingf');

      // Check connection
      if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
      }
      $sql_pre_link = "pre link successfully linked";

      $query = "SELECT num, name, description, height, weight, capture
                FROM pokemon
                WHERE (num = ". $num ." )
                ORDER BY num ASC";
      // Execute the query

      if ($_SERVER["REQUEST_METHOD"] != "POST") {
        if (($result = mysqli_query($link, $query)) === false) {
           printf("Query failed: %s<br />\n%s", $query, mysqli_error($link));
           exit();
        } else {
           $sql_pre_link .= " and successfully queried!";
           $line = $result->fetch_object();
           $num            = $line->num;
           $name           = $line->name;
           $description    = htmlspecialchars($line->description);
           $height         = $line->height;
           $weight         = $line->weight;
           $capture        = $line->capture;
        }
        mysqli_free_result($result);
      }

      ?>

      <h2>edit pokemon</h2>
      <p><a href="./index.php">back</a></p>
      <p><span class="error">* required field.</span></p>
      <li>english <input type="radio" name="lang" value="en"></li>
      <li>deustch <input type="radio" name="lang" value="de"></li>
      <br><br>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
         Number: <input type="text" name="num" value="<?php echo $num;?>">
         <span class="error">* <?php echo $numErr;?></span>
         <br><br>
         Name: <input type="text" name="name" value="<?php echo $name;?>">
         <span class="error">* <?php echo $nameErr;?></span>
         <br><br>
         Height: <input type="text" name="height" value="<?php echo $height;?>">
         <span class="error">* <?php echo $heightErr;?></span>
         <br><br>
         Weight: <input type="text" name="weight" value="<?php echo $weight;?>">
         <span class="error">* <?php echo $weightErr;?></span>
         <br><br>
         Description: <input name="description" height="50" width="40" value="<?php echo $description;?>"> <?php echo $descriptionErr;?></textarea>
         <br><br>
         How to capture: <input name="capture" height="5" width="40" value="<?php echo $capture;?>"> <?php echo $captureErr;?></textarea>
         <br><br>
         <input type="submit" name="submit" value="Submit"> 
      </form>

      <?php
      echo $sql_pre_link;
      echo "<br>";
      echo $sql_link;
      ?>

  </body>
</html>

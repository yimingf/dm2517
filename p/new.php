<html>
  <head>
    <title>n</title>
  </head>
  <body>
    <?php
      // define variables and set to empty values
      $numErr = $nameErr = $descriptionErr = $heightErr = $weightErr = $captureErr = "";
      $num = $name = $description = $height = $weight = $capture = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["num"])) {
          $numErr = "Number is required";
        } else {
          $num = test_input($_POST["num"]);
        }

        if (empty($_POST["name"])) {
          $nameErr = "Name is required";
        } else {
          $name = test_input($_POST["name"]);
        }

        if (empty($_POST["height"])) {
          $heightErr = "Height is required";
        } else {
          $height = test_input($_POST["height"]);
        }

        if (empty($_POST["weight"])) {
          $heightErr = "Weight is required";
        } else {
          $weight = test_input($_POST["weight"]);
        }

        if (empty($_POST["description"])) {
          $description = "";
        } else {
          $description = test_input($_POST["description"]);
        }

        if (empty($_POST["capture"])) {
          $capture = "";
        } else {
          $capture = test_input($_POST["capture"]);
        }

        if ($numErr == $nameErr) {
          $link = mysqli_connect('localhost', 'yimingf', 'yimingf-xmlpub13', 'yimingf');

          // Check connection
          if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
          }
          $sql_link = "successfully linked!";
		  
		  $database = ($_POST['lang'] == 'de') ? 'pokemon_de' : 'pokemon';
          
          $query = "INSERT INTO $database (num, name, height, weight, description, capture) VALUES ('$num', '$name', '$height', '$weight', '$description', '$capture')";
          
          // Execute the query
          if (($result = mysqli_query($link, $query)) === false) {
            printf("Query failed: %s<br />\n%s", $query, mysqli_error($link));
            exit();
          } else {
            $sql_link .= " and successfully inserted!";
          }

        }

      }

      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
      ?>

      <h2>new pokemon</h2>
      <p><a href="./index.php">back</a></p>
      <ul>
	  </ul>
      <p><span class="error">* required field.</span></p>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <li>english <input type="radio" name="lang" value="en"></li>
        <li>deustch <input type="radio" name="lang" value="de"></li>
        <br><br>
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
        Description: <textarea name="description" rows="5" cols="40"> <?php echo $descriptionErr;?></textarea>
        <br><br>
        How to capture: <textarea name="capture" rows="5" cols="40"> <?php echo $captureErr;?></textarea>
        <br><br>
        <input type="submit" name="submit" value="Submit"> 
      </form>

      <?php
      echo "<h2>Your Input:</h2>";
      echo $num;
      echo "<br>";
      echo $_POST['lang'];
      echo "<br>";
      echo $description;
      echo "<br>";
      echo $height;
      echo "<br>";
      echo $weight;
      echo "<br>";
      echo $capture;
      echo "<br>";
      echo $sql_link;
      echo "<br>";
      echo $result;
      ?>

  </body>
</html>

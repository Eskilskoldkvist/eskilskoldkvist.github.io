<?php



class Admin
{

  protected $admin = array('henrik@lindstedt.me' => "1234567");

  public function isAdmin($email, $password)
  {
    if ($this->admin[$email] == $password) {
      return true;
    }
    else {
      return false;
    }
  }

  function adminGuard()
  {
    session_start();
    if (isset($_SESSION["admin"])) {
      //echo "ADMIN AUTHENTICATED";
    }
    else {
      header("Location: ../login.php");
    }

  }

  function checkDeleteOwner($connection)
  {
    if (isset($_POST["ownerID"])) {
      $queryQueue = "DELETE FROM queue WHERE ownerID='$_POST[ownerID]'";
      $queryOwner = "DELETE FROM owner WHERE ownerID='$_POST[ownerID]'";

      // Set autocommit to off
      mysqli_autocommit($connection,FALSE);
      // Insert some values
      mysqli_query($connection, $queryQueue);
      mysqli_query($connection, $queryOwner);

      // Commit transaction
      mysqli_commit($connection);

      // Close connection
    //  mysqli_close($connection);
    }
  }

  function checkDeleteQueue($connection)
  {
    if (isset($_POST["queueUID"])) {
      $queryQueue = "DELETE FROM queue WHERE queueUID='$_POST[queueUID]'";
      $querySession = "DELETE FROM session WHERE queueUID='$_POST[queueUID]'";

      // Set autocommit to off
      mysqli_autocommit($connection,FALSE);
      // Insert some values
      mysqli_query($connection, $queryQueue);
      mysqli_query($connection, $querySession);

      // Commit transaction
      mysqli_commit($connection);

      //echo $queryQueue;
      //echo "<br>";
      //echo $querySession;

      // Close connection
    //  mysqli_close($connection);
    }
  }

  function getQerCount($connection, $queueUID)
  {
    $query = "SELECT count(sessionStatus) as 'count' FROM session s JOIN queue q ON s.queueUID=q.queueUID WHERE sessionStatus='inQueue' AND s.queueUID='$queueUID'";
    $row = mysqli_query($connection, $query)->fetch_assoc();

    return $row["count"];

  }

  function getQueueString($connection, $ownerID)
  {
    $query = "SELECT qname FROM queue q JOIN owner o ON q.ownerID=o.ownerID WHERE o.ownerID='$ownerID'";
    $result = mysqli_query($connection, $query);
    $return = "";
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
          $return = $return.$row["qname"].", ";
        }
        return $return;
    }

    return $row["count"];
  }
  function getOwners($connection)
  {
    $query = "SELECT DISTINCT o.ownerID, name, email FROM owner o";

    $result = mysqli_query($connection, $query);

    if ($result) {

      while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="q-container">
          <ul class="owner-details">
            <h5>Kö-ägare</h5>
            <li>ownerID: <?php echo $row["ownerID"]; ?></li>
            <li>Namn: <?php echo $row["name"]; ?></li>
            <li>Email: <?php echo $row["email"]; ?></li>
            <li>Köer: <?php echo $this->getQueueString($connection, $row["ownerID"]); ?></li>
          </ul>
          <form class="deleteQueue" action="godview.php" method="post" onsubmit="return confirm('Är du säker på att du vill radera kö-ägaren?')">
            <input type="hidden" name="ownerID" value="<?php echo $row["ownerID"]; ?>">
            <input class="delete-queue" type="submit" name="delete-owner" value="Radera ägare">
          </form>
        <!--  <a class="delete-queue" onclick="return confirm('Är du säker på att du vill radera kön?')" href="godview.php?delid=<?php //echo $row["queueID"]; ?>">Radera kö</a> -->
        </div>
        <?php
        }
      }

  }
    function getQueues($connection)
    {
      $query = "SELECT * FROM queue q JOIN owner o on q.ownerID=o.ownerID";

      $result = mysqli_query($connection, $query);

      if ($result) {

        while ($row = mysqli_fetch_assoc($result)) {
          ?>
          <div class="q-container">

            <ul class="queue-details">
              <h5>Kö-information</h5>
              <li>Könamn: <?php echo $row["qname"]; ?></li>
              <li>Beskrivning: <?php echo $row["description"]; ?></li>
              <li>queueUID: <?php echo $row["queueUID"]; ?></li>
              <li>Aktiva sessioner: <?php echo $this->getQerCount($connection, $row["queueUID"]);?></li>
            </ul>

            <ul class="owner-details">
              <h5>Kö-ägare</h5>
              <li>ownerID: <?php echo $row["ownerID"]; ?></li>
              <li>Namn: <?php echo $row["name"]; ?></li>
              <li>Email: <?php echo $row["email"]; ?></li>
            </ul>
            <form class="deleteQueue" action="godview.php" method="post" onsubmit="return confirm('Är du säker på att du vill radera kön?')">
              <input type="hidden" name="queueUID" value="<?php echo $row["queueUID"]; ?>">
              <input class="delete-queue" type="submit" name="deletebtn" value="Radera kö">
            </form>
          <!--  <a class="delete-queue" onclick="return confirm('Är du säker på att du vill radera kön?')" href="godview.php?delid=<?php echo $row["queueID"]; ?>">Radera kö</a> -->
          </div>
          <?php
          }
      }
    }



}


 ?>

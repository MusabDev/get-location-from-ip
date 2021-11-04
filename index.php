<?php

$msg = "";
$result = "";
// $ip_addr = $_SERVER["REMOTE_ADDR"];
$ip_addr = "113.212.110.242";

if (isset($_POST["search"])) {
  $ip_addr = $_POST["ip_addr"];

  $url = "http://ip-api.com/json/" . $ip_addr;
  $content = file_get_contents($url);
  $json = json_decode($content);
  if ($json->status == "fail") {
    $failmsg = ucfirst($json->message);
    $msg = "<div class='alert alert-danger'>{$failmsg}</div>";
  } else {
    $result = '<table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">IP Address</th>
          <th scope="col">Country</th>
          <th scope="col">Region Name</th>
          <th scope="col">City</th>
          <th scope="col">Zip</th>
          <th scope="col">Latitude</th>
          <th scope="col">Longitude</th>
          <th scope="col">Timezone</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">' . $json->query . '</th>
          <td>' . $json->country . ' (' . $json->countryCode . ')</td>
          <td>' . $json->regionName . '</td>
          <td>' . $json->city . '</td>
          <td>' . $json->zip . '</td>
          <td>' . $json->lat . '</td>
          <td>' . $json->lon . '</td>
          <td>' . $json->timezone . '</td>
        </tr>
      </tbody>
    </table>';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <title>Get user location from IP in PHP</title>
</head>

<body>
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-5 col-md-8 col-12 mx-auto">
        <div class="card rounded bg-white border p-4">
          <div class="card-body">
            <h3 class="card-title mb-3">Get IP Address Details</h3>
            <?php echo $msg; ?>
            <form action="" method="POST">
              <div class="mb-3">
                <label for="ip_addr" class="form-label">IP Address</label>
                <input type="text" class="form-control" id="ip_addr" name="ip_addr" value="<?php echo $ip_addr; ?>">
              </div>
              <button type="submit" name="search" class="btn btn-primary">Search</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-5">
      <?php echo $result; ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
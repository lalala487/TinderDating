<!DOCTYPE html>
<html>
<head>
    <script src="jquery-1.12.4.js"></script>
    <title>Qboxus - Server Requirements</title>
    <style>
        body {
            padding-top: 18px;
            font-family: sans-serif;
            background: #f9fafb;
            font-size: 14px;
        }

        #container {
            width: 600px;
            margin: 0 auto;
            background: #fff;
            border-radius: 10px;
            padding: 15px;
            border: 2px solid #f0f0f0;
            -webkit-box-shadow: 0px 1px 15px 1px rgba(90, 90, 90, 0.08);
            box-shadow: 0px 1px 15px 1px rgba(90, 90, 90, 0.08);
        }

        a {
            text-decoration: none;
            color: red;
        }

        h1 {
            text-align: center;
            color: #424242;
            border-bottom: 1px solid #e4e4e4;
            padding-bottom: 25px;
            font-size: 22px;
            font-weight: normal;
        }

        table {
            width: 100%;
            padding: 10px;
            border-radius: 3px;
        }

        table thead th {
            text-align: left;
            padding: 5px 0px 5px 0px;
        }

        table tbody td {
            padding: 5px 0px;
        }

        table tbody td:last-child, table thead th:last-child {
            text-align: right;
        }

        .label {
            padding: 3px 10px;
            border-radius: 4px;
            color: #fff;

        }

        .label.label-success {
            background: #4ac700;
        }

        .label.label-warning {
            background: #dc2020;
        }


        .logo {
            margin-bottom: 30px;
            margin-top: 20px;
            display: block;
        }

        .logo img {
            margin: 0 auto;
            display: block;
            border-radius: 50%;
        }

        .newform label {
            width: 100%;
            display: block;
            font-size: 15px;
            margin: 10px 0px;
        }

        .newform input {
            width: 100%;
            border: 1px solid #ccc;
            height: 27px;
        }

        .arrange {
            text-align: right;
        }

        .newbtnn {
            border: none;

            padding: 10px;
            height: unset !important;
            cursor: pointer;

        }

        .step {
            margin: 10px 0px;
            display: block;
            text-align: right;
            width: 100.7%;
        }

        #validating {
            width: unset;
            border: 0;
        }

        .scene {
            width: 100%;
            height: 100%;
            perspective: 600px;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            align-items: center;
            justify-content: center;

        svg {
            width: 240px;
            height: 240px;
        }

        }

        @keyframes arrow-spin {
            50% {
                transform: rotateY(360deg);
            }
        }
    </style>
</head>
<body>
<div id="container">
    <div class="logo">
        <a href="#">
            <img width="80px"
                 src=" data:image/jpeg;base64,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"></a>
    </div>
    <?php
    if (isset($_GET['process']) && !empty($_POST)) {
        $search_baseurl_string = '$firebaseDb_URL_MainDb = "your_key";';
        $replace_baseurl_string = '$firebaseDb_URL_MainDb = "' . $_POST["firebasedburl"] . '";';

        $search_firebasekey_string = '$firbase_key = "your_key";';
        $replace_firebasekey_string = '$firbase_key = "' . $_POST["firebaseurlkey"] . '";';


        $search_servername_string = '$servername = "your_key";';
        $replace_servername_string = '$servername = "' . $_POST["servername"] . '";';

        $search_database_string = '$database = "your_key";';
        $replace_database_string = '$database = "' . $_POST["database"] . '";';


        $search_username_string = '$username = "your_key";';
        $replace_username_string = '$username = "' . $_POST["username"] . '";';


        $search_password_string = '$password = "your_key";';
        $replace_password_string = '$password = "' . $_POST["password"] . '";';


        $path_to_file = '../config.php';
        $file_contents = file_get_contents($path_to_file);
        $file_contents = str_replace($search_baseurl_string, "$replace_baseurl_string", $file_contents);

        $file_contents = str_replace($search_firebasekey_string, "$replace_firebasekey_string", $file_contents);
        $file_contents = str_replace($search_servername_string, "$replace_servername_string", $file_contents);
        $file_contents = str_replace($search_database_string, "$replace_database_string", $file_contents);
        $file_contents = str_replace($search_username_string, "$replace_username_string", $file_contents);
        $file_contents = str_replace($search_password_string, "$replace_password_string", $file_contents);

        file_put_contents($path_to_file, $file_contents);

        echo "<p>Configuration file has been updated</p>";
        echo "<p>Please Remove the installer folder from your server</p>";

    } else {
        $error = false;
        $data = [];
        $PHP_VERSION = PHP_VERSION;
        if ($PHP_VERSION >= 7 && $PHP_VERSION < 7.1) {
            $requirement1 = "<span class='label label-success'>v." . PHP_VERSION . '</span>';
            $data['require1'] = 1;
        } else {
            $error = true;
            $requirement1 = "<span class='label label-warning'>Your PHP version is " . $PHP_VERSION . '</span>';
        }

        if (!extension_loaded('tokenizer')) {
            $error = true;
            $requirement2 = "<span class='label label-warning'>Error</span>";

        } else {
            $requirement2 = "<span class='label label-success'>Enabled</span>";
            $data['require2'] = 1;
        }

        if (!extension_loaded('pdo')) {
            $error = true;
            $requirement3 = "<span class='label label-warning'>Error</span>";
        } else {
            $requirement3 = "<span class='label label-success'>Enabled</span>";
            $data['require3'] = 1;
        }

        if (!extension_loaded('curl')) {
            $error = true;
            $requirement4 = "<span class='label label-warning'>Error</span>";
        } else {
            $requirement4 = "<span class='label label-success'>Enabled</span>";
            $data['require4'] = 1;
        }

        if (!extension_loaded('openssl')) {
            $error = true;
            $requirement5 = "<span class='label label-warning'>Error</span>";
        } else {
            $requirement5 = "<span class='label label-success'>Enabled</span>";
            $data['require5'] = 1;
        }

        if (!extension_loaded('mbstring')) {
            $error = true;
            $requirement6 = "<span class='label label-warning'>Error</span>";
        } else {
            $requirement6 = "<span class='label label-success'>Enabled</span>";
            $data['require6'] = 1;
        }

        if (!extension_loaded('ctype') && !function_exists('ctype')) {
            $error = true;
            $requirement7 = "<span class='label label-warning'>Error</span>";
        } else {
            $requirement7 = "<span class='label label-success'>Enabled</span>";
            $data['require7'] = 1;
        }


        if (!extension_loaded('gd')) {
            $error = true;
            $requirement9 = "<span class='label label-warning'>Error</span>";
        } else {
            $requirement9 = "<span class='label label-success'>Enabled</span>";
            $data['require8'] = 1;
        }

        if (!extension_loaded('zip')) {
            $error = true;
            $requirement10 = "<span class='label label-warning'>Error</span>";
        } else {
            $requirement10 = "<span class='label label-success'>Enabled</span>";
            $data['require9'] = 1;
        }

        $url_f_open = ini_get('allow_url_fopen');
        if ($url_f_open != "1" && $url_f_open != 'On') {
            $error = true;
            $requirement11 = "<span class='label label-warning'>Error</span>";
        } else {
            $requirement11 = "<span class='label label-success'>Enabled</span>";
            $data['require10'] = 1;
        }

        ?>

        <h1>Server Requirements</h1>

        <table class="table table-hover" id="requirements">
            <thead>
            <tr>
                <th>Requirements</th>
                <th>Result</th>
            </tr>
            </thead>

            <tr>
                <td>PHP 7.0</td>
                <td><?php echo $requirement1; ?></td>
            </tr>
            <tr>
                <td>TOKENIZER</td>
                <td><?php echo $requirement2; ?></td>
            </tr>
            <tr>
                <td>PDO PHP Extension</td>
                <td><?php echo $requirement3; ?></td>
            </tr>
            <tr>
                <td>cURL PHP Extension</td>
                <td><?php echo $requirement4; ?></td>
            </tr>
            <tr>
                <td>OpenSSL PHP Extension</td>
                <td><?php echo $requirement5; ?></td>
            </tr>
            <tr>
                <td>MBString PHP Extension</td>
                <td><?php echo $requirement6; ?></td>
            </tr>


            <tr>
                <td>GD PHP Extension</td>
                <td><?php echo $requirement9; ?></td>
            </tr>
            <tr>
                <td>Zip PHP Extension</td>
                <td><?php echo $requirement10; ?></td>
            </tr>
            <tr>
                <td>allow_url_fopen</td>
                <td><?php echo $requirement11; ?></td>
            </tr>

        </table>

        <h1>Fill Infromation</h1>
        <form method="post" id="nosend" class="newform" action="?process">


            <label for="firebasedburl">Firebase Real time database URL</label>
            <input name="firebasedburl" id="firebasedburl" type="text" size=""
                   value=""
                   autofocus="" placeholder="https://abcbcb-5c15a.firebaseio.com">
            <label for="firebaseurlkey">Firebase Push notification Server Key</label>
            <input name="firebaseurlkey" id="firebaseurlkey" type="text"
                   size="" value=""
                   autofocus="" placeholder="AAAAsdfsdfsdtM:AasdasdasdsdddssSSDFSASDGKKzXvtU">

            <label for="servername">Hostname</label>
            <input name="servername" id="servername" type="text"
                   size="" value="" autofocus="" placeholder="localhost">


            <label for="database">Database</label>
            <input name="database" id="database" type="text"
                   size="" value="" autofocus="" placeholder="db Name">

            <label for="username">Username</label>
            <input name="username" id="username" type="text"
                   size="" value="" autofocus="" placeholder="user name">

            <label for="password">Password</label>
            <input name="password" id="password" type="text"
                   size="" value="" autofocus="" placeholder="password">

            <div class="step">

                <?php
                if (array_key_exists('require1', $data) && array_key_exists('require2', $data) && array_key_exists('require3', $data) && array_key_exists('require4', $data) && array_key_exists('require5', $data) && array_key_exists('require6', $data) && array_key_exists('require7', $data) && array_key_exists('require8', $data) && array_key_exists('require9', $data) && array_key_exists('require10', $data)) {
                    ?>
                    <input type="submit" name="submiting" id="validating" value="Submit"
                           class="newbtnn label label-success">

                    <?php
                } else {
                    ?>
                    <div class="label label-warning ">Clear Errors</div>
                    <?php
                }
                ?>

            </div>
        </form>

        <?php
    }
    ?>
</div>
<script>

  $('#validating').on('click', function (e) {
    e.preventDefault()
    var firbaseurl = $('#firebasedburl').val()
    var newfirabseurl = firbaseurl.replace(/\/$/, '') + '/.json'
    var servername = $('#servername').val()
    var database = $('#database').val()
    var username = $('#username').val()
    var password = $('#password').val()



    $.ajax({
      type: 'Post',
      url: 'ajax.php?direct=ok',
      data: {
        name: newfirabseurl,
      },
      success: function (data2) {
        var json2 = $.parseJSON(data2)
        if (json2 == null) {
          $('#firebasedburl').css('border-color', 'red')
          $('body').css('cursor', 'unset')
        }
        if (typeof json2.error !== 'undefined') {
          if (json2.error.length > 0) {
            $('#firebasedburl').css('border-color', 'red')
            $('body').css('cursor', 'unset')
          }
        }
        if (typeof json2.name !== 'undefined') {
          if (json2.name.length > 0) {
            $('#firebasedburl').css('border-color', '#ccc')

            $.ajax({
              type: 'Post',
              url: 'ajax.php',
              data: {
                hostname: servername,
                database: database,
                username: username,
                password: password,

              },
              success: function (data2) {
                var json2 = $.parseJSON(data2)
                if (json2 != 'no') {
                    $('#validating').parent().empty()
                    $('#nosend').submit()
                } else {
                  $('#password').css('border-color', 'red')
                  $('#username').css('border-color', 'red')
                  $('#database').css('border-color', 'red')
                  $('#servername').css('border-color', 'red')
                }
              }
            })
          }
        }
      }
    })
  })
</script>
</body>
</html>

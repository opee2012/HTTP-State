<?php
$callListResource = fopen("callList.csv", "r");
$companies = array();
$visit = $_GET["company"];

if (isset($_COOKIE['visit'])) {
    $visited = explode(",", $_COOKIE['visit']);

    if (!in_array($visit, $visited)) $visited[] = $visit;
    $concat_visit = implode("%2C", $visited);
    header("Set-Cookie: visit=" . $concat_visit);
} else header("Set-Cookie: visit=" . $visit);

if(!is_resource($callListResource))
{
    echo "Could not open the file";
    exit();
}

while($line = fgets($callListResource))
{
    $companies[] = explode(",", $line);
}

fclose($callListResource);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Companies</title>
</head>
<body> 
<h1>Company Details</h1>
<?php

    if(isset($_GET["company"]))
    {
        if(isset($companies[$_GET["company"]]))
        {
            //render the company info
            echo "<h2>" . $companies[$_GET["company"]][0] . "</h2>";
            echo "<p>Company Phone: " . $companies[$_GET["company"]][1] . "</p>";
        }
        else
        {
            //Default text
             echo "The company was not found.";
        }
    }
    else
    {
        //Default text
        echo "The company was not found.";
    }

?>

<a href="/">Back to list</a>

    </body>
</html>

<!--Write into the cookie -->
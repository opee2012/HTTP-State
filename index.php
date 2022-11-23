<!--
    CSCI 297, HTTP State, Jacob Borth, 22 November 2022
    Outputs "Visited" each time you visit the company details.
-->

<?php
$callListResource = fopen("callList.csv", "r");
$companies = array();
$print = " - Visited";

$visit = $_COOKIE['visit'];
$visited = explode(",", $visit);

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
<html>
<head>
    <title>Companies</title>
</head>
<body> 
<h1>Company Listing</h1>
<ul>
<?php
    foreach($companies as $key => $value)
    {
        echo "<li><a href='details.php?company=" . urlencode($key) . "'>" . $value[0] . "</a>";
        if (in_array($key, $visited)) echo $print;
        echo "</li>";
    }
?>
</ul>

    </body>
</html>

<!-- Read the cookie -->
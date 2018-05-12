<?php
session_start();

$usefulReportData = ""; # return variable
$usefulReportDataHeader = "";
$zeroStockItems = "";
$zeroStockItemsHeader = "";
$servCheck = "";

# file import; convert to string array
$csvFile = file($_FILES["reportCSV"]["tmp_name"]);
$sheetData = [];



foreach ($csvFile as $line) {
    $sheetData[] = str_getcsv($line);
}

# Header Print
$usefulReportDataHeader .= "<h3>Restock These:</h3><table class='striped'>
        <tr>
            <th>Item Description</th>
            <th>Stock Left</th>
            <th>Restock Amount</th>
        </tr>";

$zeroStockItemsHeader = "<BR/><BR/><h3>Out of Stock</h3>
<table class='striped'>
        <tr>
            <th>Item Description</th>
            <th>Stock Left</th>
        </tr>";

# Print Loop; Concat "0 Stock" Items to the end of the list
#Split the string at the description index and check if it ends with "single"
for ($i=1; $i < sizeof($sheetData); $i++)
{
    # Split the string at the description index and check if it ends with single
    $singleCheck = strtolower(substr($sheetData[$i][5],(strlen($sheetData[$i][5])-6),strlen($sheetData[$i][5])));

    # Check Item isn't out of stock and not a "return transaction"
    if ($sheetData[$i][6] != 0 && $sheetData[$i][7] > 0 )
    {
        $usefulReportData .="<tr>";
        for ($j = 5; $j < 8; $j++)
        {
            $usefulReportData .= "<td> ".$sheetData[$i][$j]." </td>";
        }    
    $usefulReportData .= "</tr>";
    }

#Check if item is out of stock and not a "return transaction"
    else if( $sheetData[$i][6] < 1 &&
             $sheetData[$i][7] > 0 )
    {
    #Split the string at the description index and check if it begins with "service"
    #Service is zero stock so it doesn't need to be checked earlier
        $servCheck = substr($sheetData[$i][5],0,7);
        
        if($servCheck != "Service" && strtolower($singleCheck) != "single")
        {
            $zeroStockItems .= "<tr>";

            for ($j = 5; $j < 7; $j++)
            {
                $zeroStockItems .= "<td>" . $sheetData[$i][$j] . " </td>";
            }

            $zeroStockItems .= "</tr>";
        }
    }
}

$usefulReportData.= "</table>";
$_SESSION["restockList"] = $usefulReportDataHeader . $usefulReportData. "</table>" . $zeroStockItemsHeader . $zeroStockItems . "</table>";

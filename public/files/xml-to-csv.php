<?php
// 1. Load the XML file
$xml = simplexml_load_file('ultra-feed.xml');

// 2. Open a file pointer for writing the CSV
$fp = fopen('ultra-feed.csv', 'w');

$headerSet = false;

// 3. Iterate through each parent node (e.g., each <item>)
foreach ($xml->children() as $row) {
    $rowData = get_object_vars($row);

    // Write column headers once using the XML tag names
    if (!$headerSet) {
        fputcsv($fp, array_keys($rowData));
        $headerSet = true;
    }

    // Write the actual data row
    fputcsv($fp, $rowData);
}

// 4. Close the file
fclose($fp);
echo "Conversion complete!";
?>

<?php

function RenderTable($header, $tableData) {


    // HTML and Boostrap Rendering
    echo '<div class="table-responsive">
        <table>
            <thead class="table-dark">
            <tr>';
    // Create table headers
    foreach ($header as $value) {
        echo "<th>$value</th>";
    }
    echo "</tr></thead><tbody>";


    // Create table rows from array of arrays
    
    foreach ($tableData as $row) { // Main array

        echo "<tr>";

        foreach ($row as  $field) { // Nested array

            if (is_array($field)) { // Split the values if inside an array

                echo "<td>" . implode(", ", $field) . "</td>";

            } else { // Handle the values not in array

                echo "<td>{$field}</td>";

            }

        }

        echo "</tr>"; // End row, and user record
    }

    echo "</tbody></table></div> </div>"; // End table

}
?>
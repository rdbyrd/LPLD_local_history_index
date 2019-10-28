<?php
require_once 'includes/header.php';
require_once 'includes/database.php';
?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1>Local History File Index</h1>
        <h2>Search Results</h2>
    </div>
</div>

<div class="container">


    <?php
    $role = $_SESSION['role'];

    //Check the roles of the user. IF the User is a Volunteer or Admin, they gain
    //the ability to search through all columns.
    if (isset($role)) {

        //set session variables as regular variables to run in SQL queries below
        $search = $_SESSION['search'];

        $sql = "SELECT * FROM files WHERE
            filename LIKE '%$search%' 
            OR category LIKE '%$search%'
            OR subcategory LIKE '%$search%' 
             
            OR file_location LIKE '%$search%' 
            OR state LIKE '%$search%' 
            OR county LIKE '%$search%'
            OR township LIKE '%$search%' 
            OR city LIKE '%$search%'
                
            OR related LIKE '%$search%'
            OR alias LIKE '%$search%'
            OR keywords LIKE '%$search%'";

        //execute the search and call up all matching attributes
        $result = mysqli_query($db, $sql);

        //display all results
        $queryResult = mysqli_num_rows($result);

        //display number of results discovered
        echo "Results: " . $queryResult . "<hr/>";
        ?>

        <!--Exiting PHP tags to implement user input form-->
        <!--generate a filter to search data, also on index_all_records.php-->
        <h3>Filter:</h3>
        <input class="form-control" id="myInput" type="text" placeholder="A search that updates results as you type">
        <br>

    <?php
// display records in a table
    echo "<table class='table table-hover'>";

// set table headers
    echo "<tr class='table-secondary'><th>File Name</th><th>Category</th><th>Subcategory</th>"
    . "<th width='15%'>File Location</th><th>Related Resources</th><th>Alias/Other Names</th><th>Keyword</th></tr>";


    // tbody is implemented here to make the filter work on every single row of data while excluding the headers.
    echo "<tbody id='myTable'>";

    //provide a snippet from the results to be represented to the user
    if ($queryResult > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
// set up a row for each record
            echo "<tr>";
            echo "<td><b><a href='display_file.php?id=" . $row['id'] . "'</a>" . $row['filename'] . "</b></td>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td>" . $row['subcategory'] . "</td>";
            echo "<td>" . $row['file_location'] . "</td>";
            echo "<td>" . $row['related'] . "</td>";
            echo "<td>" . $row['alias'] . "</td>";
            echo "<td>" . $row['keywords'] . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    }
    
    //when the user is NOT logged in, they are NOT allowed to search certain fields
} else {
    
            //set session variables as regular variables to run in SQL queries below
        $search = $_SESSION['search'];

        $sql = "SELECT * FROM files WHERE
            filename LIKE '%$search%' 
            OR category LIKE '%$search%'
            OR subcategory LIKE '%$search%' 
                " .
                //Exclude file location, state, county, township from search. Re-implement only on request by deleting comment // tags
//            OR file_location LIKE '%$search%' 
//            OR state LIKE '%$search%' 
//            OR county LIKE '%$search%'
//            OR township LIKE '%$search%' 
//            OR city LIKE '%$search%'
                "
            OR related LIKE '%$search%'
            OR alias LIKE '%$search%'
            OR keywords LIKE '%$search%'";

        //execute the search and call up all matching attributes
        $result = mysqli_query($db, $sql);

        //display all results
        $queryResult = mysqli_num_rows($result);

        //display number of results discovered
        echo "Results: " . $queryResult . "<hr/>";
        ?>

        <!--Exiting PHP tags to implement user input form-->
        <!--generate a filter to search data, also on index_all_records.php-->
        <h3>Filter:</h3>
        <input class="form-control" id="myInput" type="text" placeholder="A search that updates results as you type">
        <br>

    <?php
// display records in a table
    echo "<table class='table table-hover'>";

// set table headers
    echo "<tr class='table-secondary'><th>File Name</th><th>Category</th><th>Subcategory</th>"
    . "<th width='15%'>File Location</th><th>Related Resources</th><th>Alias/Other Names</th><th>Keyword</th></tr>";


    // tbody is implemented here to make the filter work on every single row of data while excluding the headers.
    echo "<tbody id='myTable'>";

    //provide a snippet from the results to be represented to the user
    if ($queryResult > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
// set up a row for each record
            echo "<tr>";
            echo "<td><b><a href='display_file.php?id=" . $row['id'] . "'</a>" . $row['filename'] . "</b></td>";
            echo "<td>" . $row['category'] . "</td>";
            echo "<td>" . $row['subcategory'] . "</td>";
            echo "<td>" . $row['file_location'] . "</td>";
            echo "<td>" . $row['related'] . "</td>";
            echo "<td>" . $row['alias'] . "</td>";
            echo "<td>" . $row['keywords'] . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    }
    
}

//Report this message if no data could be found.
//} else {
//    echo "No results.";
//}

$db->close();
?>

</div>

<script>
//    This is an AJAX query designed to filter the table. DO NOT TOUCH THIS. Comment or uncomment to add the filter.
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>

<?php
require_once 'includes/footer.php';

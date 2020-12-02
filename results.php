<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Search Results</title>
</head>
<body>
    <h1>Book Search Results</h1>
    <?php
    // TODO 1: Create short variable names.
        $searchtype = '';
        $searchterm = '';

        $isbn = '';
        $author = '';
        $title = '';
        $price = '';

    // TODO 2: Check and filter data coming from the user.
        if(isset($_POST['searchtype']) && isset($_POST['searchterm']))
        {
            $searchtype = htmlspecialchars($_POST['searchtype']);
            $searchterm = htmlspecialchars($_POST['searchterm']);
        }

    // TODO 3: Setup a connection to the appropriate database.
        include('config.php');

    // TODO 4: Query the database.
        $sql = "SELECT * FROM catalogs WHERE " . $searchtype . " LIKE '%$searchterm%'";

        $result = $conn -> query($sql);

        if(!$result)
            die ("Fail to retrieve data: " . $conn -> error);

    // TODO 5: Retrieve the results.
        // TODO 6: Display the results back to user.
        if($result -> num_rows>0)
        {
            $number = 1;
            ?>
                <table border=1>
                    <tr>
                        <th>No.</th>
                        <th>ISBN</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Price</th>
                    </tr>
            <?php
            while($row = $result -> fetch_assoc())
            {
                $isbn = $row['isbn'];
                $author = $row['author'];
                $title = $row['title'];
                $price = $row['price'];

                // $number = $number++;

                ?>
                    <tr>
                        <td><?php echo $number++; ?></td>
                        <td><?php echo $isbn; ?></td>
                        <td><?php echo $author; ?></td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $price; ?></td>
                    </tr>
                <?php
            }
        }
    // TODO 7: Disconnecting from the database.
        $conn -> close();

    ?>
</body>
</html>

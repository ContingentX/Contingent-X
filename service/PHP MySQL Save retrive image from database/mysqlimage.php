<?php
ini_set( 'mysql.connect_timeout', 300 );
ini_set( 'default_socket_timeout', 300 );
?>
<html>
<body>
<form method="post" enctype="multipart/form-data">
    <br/>
    <input type="file" name="image"/>
    <br/><br/>
    <input type="submit" name="sumit" value="Upload"/>
</form>
<?php
if ( isset( $_POST[ 'sumit' ] ) )
{
    if ( getimagesize( $_FILES[ 'image' ][ 'tmp_name' ] ) == false )
    {
        echo "Please select an image!<br><br>";
    }
    else
    {
        $image = addslashes( $_FILES[ 'image' ][ 'tmp_name' ] );
        $name = addslashes( $_FILES[ 'image' ][ 'name' ] );
        $image = file_get_contents( $image );
        $image = base64_encode( $image );
        saveimage( $name, $image );
    }
}

displayimages();

echo '<hr>';

display_image( 7 );

function saveimage( $name, $image ) {
    $con = mysql_connect( "localhost", "root", "root" );
    mysql_select_db( "f3", $con );
    $qry = "insert into images (name,image) values ('$name','$image')";

    $result = mysql_query( $qry, $con );
    if ( $result )
    {
        echo "<br/>Image uploaded.<hr>";
    }
    else
    {
        echo "<br/>Image not uploaded.<hr>";
    }
}

function displayimages() {
    $con = mysql_connect( "localhost", "root", "root" );
    mysql_select_db( "f3", $con );
    $qry = "select * from images";
    $result = mysql_query( $qry, $con );
    while ( $row = mysql_fetch_array( $result ) )
    {
        if(isset($row[ 2 ])){
            echo '<img height="300" width="300" src="data:image;base64,' . $row[ 2 ] . ' "> ';
        }
    }
    mysql_close( $con );
}

function display_image( $id ) {
    $con = mysql_connect( "localhost", "root", "root" );
    mysql_select_db( "f3", $con );
    $qry = "select * from images WHERE id = '$id'";
    $result = mysql_query( $qry, $con );
    while ( $row = mysql_fetch_array( $result ) )
    {
        if(isset($row[ 2 ])){
            echo "Dein Bild ist:<br>";
            echo '<img style="width:30%;" src="data:image;base64,' . $row[ 2 ] . ' "> ';
        }
    }
    mysql_close( $con );
}

?>
</body>
</html>
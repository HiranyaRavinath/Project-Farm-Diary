<!DOCTYPE html>
<html>

<head>
    <title>Event Click LatLng</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBheNEtrngM3cbowGS3tLPwoBXlswmmSb0&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>



  <script>
var today = new Date();
var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = date+' '+time;
  </script>

    <script>
      function initMap() {
        const myLatlng = { lat:6.9271, lng:79.8612 };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 15,
          center: myLatlng,
        });
        // Create the initial InfoWindow.
        let infoWindow = new google.maps.InfoWindow({
          content: "Click the map to get Lat/Lng!",
          position: myLatlng,
        });
        infoWindow.open(map);
        // Configure the click listener.
        map.addListener("click", (mapsMouseEvent) => {
          // Close the current InfoWindow.
          infoWindow.close();
          // Create a new InfoWindow.
          infoWindow = new google.maps.InfoWindow({
            position: mapsMouseEvent.latLng,
          });
          infoWindow.setContent(
            '<h1>input your details</h1>   <form action = "mapinputpass.php" method ="POST"> <input type = "text" style="visibility:hidden" name = "latitude" value="'+mapsMouseEvent.latLng.lat()+'" /> <input type = "text" style="visibility:hidden" name = "longitude" value="'+mapsMouseEvent.latLng.lng()+'" />   </br> type: <input type="text" name="type"></br> datetime: <input type="text" name="datetime" value="'+dateTime+'"></br> price: <input type="text" name="price"></br> description: <input type="text" name="description"></br> </br> image: <input type="file" name="image">   <button type="submit" name="submit" class="btn btn-outline-success">Submit Details</button></form>'


          );
          infoWindow.open(map);
        });
      }
    </script>
  </head>



<body>












<?php

$senderid=1;



   





include 'dbconnect.php';
if($con === false){
	
  die("ERROR: Could not connect. " . mysqli_connect_error());
}


if (isset($_POST['submit'])) {
  // do logic
  $latitude= $_POST['latitude'];
  $longitude= $_POST['longitude'];
  $type= $_POST['type'];
  $description= $_POST['description'];
  $datetime= $_POST['datetime'];
  $price= $_POST['price'];
  $image = $_FILES['image']['name']; 
  

  $move=move_uploaded_file($_FILES["image"]["tmp_name"],"uploads/". $_FILES["image"]["name"]);	

   
    
  $sql = "INSERT INTO product(latitude,longitude,price,datetime,type,description,image) values ('$latitude','$longitude','$price','$datetime','$type','$description','$senderid','$image')";
  
    
  //excute query

  
  mysqli_query($con,$sql);



 echo 
"latitude:$latitude,longitude:$longitude,type:$type,description:$description,datetime:$datetime,price:$price";  

  

    
if($move)
  
    
{


  echo " successfully uploaded";


}else{


  echo "Failed to upload";


}


















  echo"all set";
  


  //Get text




}
 

?>


























<?php include 'navcommonfarmer.php'; ?>


<div class="container-fluid" style="padding-right: 0px; padding-left:0px; ">


<?php include 'messagerecive.php'; ?>

<div>



<div id="map" style="width:100%;height:800px;"></div>




<?php include 'footer.php'; ?>




</body>
</html>
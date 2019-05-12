<?php
include('dbcon.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="MainStyles.css"/>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>
    
    <header>
        <ul id="navbar">
            <a href="login.php"><li>Login</li></a>
            <a href="register.php"><li>Registr</li></a>
            <li><img src="logo.png" height="55px" width="55px"></li>
            <a href="profil.php"><li>Account</li></a>
            <a href="/"><li>Contact</li></a>
            <div id="line"></div>
        </ul>
        <h1>
            Let's start the adventure!
        </h1>
          <form id="search-block" name="1234" method="POST">
            <input name="sub" class="form-control mr-sm-2" id="pac-input" type="text" placeholder="Choose your city" aria-label="Search"/>
            <div style="display:none;" id="map"></div>
            <input type="submit" value="Search"/>
          </form>
    </header>

    <main>
      <?php
      if(!isset($_POST['sub'])){
          $user = $DB->query("SELECT * FROM `users`");
          foreach ($user as $key => $value) {
            //print_r($value);
      
      ?>
        <div class="blocks">
            <img src="<?php echo $value['img']; ?>" alt=""/>
            <div class="blocks--content">
                <a href="user.php?name=<?php echo $value['name']; ?>"><?php echo $value['name']; ?></a><span><?php echo $value['city']; ?></span>
                <p><?php echo $value['description']; ?></p>
                <p id="price"><?php echo $value['age']; ?>$</p>
            </div>
        </div>
        <?php
            }
      }else{
          $user1 = $DB->query("SELECT * FROM `users` WHERE city=?",array($_POST['sub']));
          foreach ($user1 as $key => $value) {
            //print_r($value);
      
      ?>
      <div class="blocks">
            <img src="<?php echo $value['img']; ?>" alt=""/>
            <div class="blocks--content">
                <a href="user.php?name=<?php echo $value['name']; ?>"><?php echo $value['name']; ?></a><span><?php echo $value['city']; ?></span>
                <p><?php echo $value['description']; ?></p>
                <p id="price"><?php echo $value['age']; ?>$</p>
            </div>
        </div>
        <?php
            }
      }
      ?>
    <footer>
            <img src="logo--1.png" alt=""/>
              <ul id="first--list">
                  Get started
                  <li><a>Home</a></li>
                  <li><a>Sign up</a></li>
                  <li><a>Download</a></li>
              </ul>
              <ul id="second--list">
                  About us
                  <li><a>Information</a></li>
                  <li><a>Contact us</a></li>
              </ul>
              <ul id="third--list">
                  Support
                  <li><a>Help</a></li>
              </ul>
            <div id="icons">
                    <a href="" target="_blank"><span><i title="Facebook" class="fab fa-facebook-f"></i></span></a>
                    <a href="" target="_blank"><span><i title="Instagram" class="fab fa-instagram"></i></span></a>
                    <a href=""><span><i title="Google plus" class="fab fa-google-plus-g"></i></span></a>
            </div>
            <button>Contact us</button>
            <div id="copyright--block"> Copyright © Out Surfing 2019. All rights reserved</div>
        </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("ul a:nth-child(1)").hover(function(){
               $("#line").css("margin-left", "3px"); 
            });
            $("ul a:nth-child(2)").hover(function(){
               $("#line").css("margin-left", "113px"); 
            });
            $("ul li:nth-child(3)").hover(function(){
               $("#line").css("margin-left", "223px"); 
            });
            $("ul a:nth-child(4)").hover(function(){
               $("#line").css("margin-left", "333px"); 
            });
            $("ul a:nth-child(5)").hover(function(){
               $("#line").css("margin-left", "443px"); 
            });
        });
    </script>
    <script>
            // This example adds a search box to a map, using the Google Place Autocomplete
            // feature. People can enter geographical searches. The search box will return a
            // pick list containing a mix of places and predicted search terms.
      
            // This example requires the Places library. Include the libraries=places
            // parameter when you first load the API. For example:
            // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      
            function initAutocomplete() {
                var styledMapType = new google.maps.StyledMapType(
                  [
                    {
                      "featureType": "administrative",
                      "elementType": "geometry",
                      "stylers": [
                        {
                          "visibility": "off"
                        }
                      ]
                    },
                    {
                      "featureType": "poi",
                      "stylers": [
                        {
                          "visibility": "off"
                        }
                      ]
                    },
                    {
                      "featureType": "road",
                      "elementType": "labels.icon",
                      "stylers": [
                        {
                          "visibility": "off"
                        }
                      ]
                    },
                    {
                      "featureType": "transit",
                      "stylers": [
                        {
                          "visibility": "off"
                        }
                      ]
                    }
                  ],
                  {name: 'Styled Map'});
                    
              var map = new google.maps.Map(document.getElementById('map'), {
      
                center: {lat: 48.945700, lng: 38.493964},
                zoom: 18,
                mapTypeControlOptions: {
                  mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                          'styled_map']
                }
              });
              map.mapTypes.set('styled_map', styledMapType);
              map.setMapTypeId('styled_map');
              
                      var contentString = '<div id="content">'+
                  '<div id="siteNotice">'+
                  '</div>'+
                  '<h1 id="firstHeading" class="firstHeading">Шиворот на Выворот</h1>'+
                  '<div id="bodyContent">'+
                  '<p>Представлена модная, стильная женская и мужская одежда известных итальянских, американских, немецких брендов.' +
                  'Юбки, блузы, платья, брюки, куртки, пальто, джинсы, обувь – все для Вашего гардероба!'+
                  '<b>Время работы:<b/> <ins>Пн - Вс с 10:00 - 19:00</ins>';
                      var contentString1 = '<div id="content">'+
                  '<div id="siteNotice">'+
                  '</div>'+
                  '<h1 id="firstHeading" class="firstHeading">Секонд ХЕНД Zig-Zag</h1>'+
                  '<div id="bodyContent">'+
                  '<p>Представлена модная, стильная женская и мужская одежда известных итальянских, американских, немецких брендов.' +
                  'Юбки, блузы, платья, брюки, куртки, пальто, джинсы, обувь – все для Вашего гардероба!'+
                  '<b>Время работы:<b/> <ins>Пн - Вс с 10:00 - 19:00</ins>';
                  
                  var infowindow = new google.maps.InfoWindow({
                content: contentString
              });
              var infowindow1 = new google.maps.InfoWindow({
                content: contentString1
              });
              var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
              var marker = new google.maps.Marker({
                position: {lat: 48.944696, lng: 38.493490},
                map: map,
                title: 'Стоковый магазин Шиворот на Выворот',
                animation: google.maps.Animation.DROP,
                icon: image
              });
              marker.addListener('click', function() {
                infowindow.open(map, marker);
              });
       
              var marker2 = new google.maps.Marker({
                position: {lat: 49.044527, lng: 38.224660},
                map: map,
                title: 'Секонд Zig-Zag',
                animation: google.maps.Animation.DROP
              });
              var marker1 = new google.maps.Marker({
                position: {lat: 48.945129, lng: 38.496289},
                map: map,
                title: 'Секонд Хенд Шкаф',
                animation: google.maps.Animation.DROP
              });
              // Create the search box and link it to the UI element.
              var input = document.getElementById('pac-input');
              var searchBox = new google.maps.places.SearchBox(input);
              map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
      
              // Bias the SearchBox results towards current map's viewport.
              map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
              });
      
              var markers = [];
              // Listen for the event fired when the user selects a prediction and retrieve
              // more details for that place.
              searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();
      
                if (places.length == 0) {
                  return;
                }
      
                // Clear out the old markers.
                markers.forEach(function(marker) {
                  marker.setMap(null);
                });
                markers = [];
      
                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function(place) {
                  if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                  }
                  var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                  };
      
                  // Create a marker for each place.
                  markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                  }));
      
                  if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                  } else {
                    bounds.extend(place.geometry.location);
                  }
                });
                map.fitBounds(bounds);
              });
            }
          </script>
          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBM6GyeLm7hzLGH3TRSEmUQTYWchvuiq7E&libraries=places&callback=initAutocomplete"
               async defer></script>
</body>
</html>
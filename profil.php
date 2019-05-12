<?php
    include('dbcon.php');
    
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
    //$query = mysqli_query($db, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
   // $userdata = mysqli_fetch_assoc($query);
$query =  $DB->query("SELECT id FROM users WHERE id =?", array($_COOKIE['id']));
    if($query[0]['id'] !== $_COOKIE['id'])
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        print "Хм, что-то не получилось";
    }
    else
    {
$user_ids = $query[0]['id'];
      if(isset($_POST['name']) AND isset($_POST['from']) AND isset($_POST['to'])){
      $name = $_POST['name'];
      $from = $_POST['from'];
      $to = $_POST['to'];


      $check = $DB->query("SELECT COUNT(*) FROM `track` WHERE user_id =? AND name=?", array($user_ids,$name));

        if($check[0]['COUNT(*)'] == 0){
                              $pieces1 = explode("/", $from);
              $pieces2 = explode("/", $to);

              $from = $pieces1[1].'-'.$pieces1[0].'-'.$pieces1[2];

              $to = $pieces2[1].'-'.$pieces2[0].'-'.$pieces2[2];

      $DB->query("INSERT INTO `track` (`id`, `user_id`, `name`, `fromT`, `toT`) VALUES (NULL, ?, ?, ?, ?)", array($user_ids,$name,$from,$to));
        }
      }
    ?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OutSurfing</title>
    <link rel="stylesheet" href="profile.css" type="text/css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="MainStyles.css"/>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
    <header style="height: auto; margin-top: 2%; background: none;">
        <ul id="navbar">
            <a href="login.php"><li>Login</li></a>
            <a href="register.php"><li>Registration</li></a>
            <li><img src="logo.png" height="55px" width="55px"></li>
            <a href="#"><li>Account</li></a>
            <a href=""><li>Contact</li></a>
            <div id="line"></div>
        </ul>
    </header>
    <main>
        <div class="container">
            <div style="padding: 20px; background-color: rgba(0,0,0, 0.5);" class="card d-flex" style="max-width: 1200px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img style="width: 100%" src="img/avatar.jpg" class="rounded-circle" alt="...">
                    </div>
                    <div class="col-md-8 d-flex align-items-center">
                        <div class="card-body d-flex flex-column align-items-center">
                            <?php
                                $user1 = $DB->query("SELECT * FROM `users` WHERE id=?",array($user_ids));
                               // print_r($user1[0]['name']);
                            ?>
                            <h5 class="card-title text-white"><?php echo $user1[0]['name']; ?></h5>
                            <p class="card-text text-white"><?php echo $user1[0]['city']; ?></p>
                            <p class="card-text"><small class="text-white">В мережі 3 хвилини тому</small></p>
                            <div>
                                <a class="text-white" style="font-size: 2em;" href=""><i class="fab fa-facebook-square"></i></a>
                                <a class="text-white" style="font-size: 2em;" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style=" padding: 5px; margin-top: 20px; background-color: rgba(0,0,0, 0.5);" class="comments">
                <h3 class="title-comments text-white">Коментарі (6)</h3>
                <ul class="media-list">
                    <li class="media">
                        <div class="media-left">
                            <a href="#"><img style="padding: 10px;" class="media-object img-rounded" src="img/avatar3.jpg" alt="..."></a>
                        </div>
                        <div class="media-body">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="author text-white">Лілія</div>
                                    <div class="metadata">
                                        <span class="date text-white">8 травня 2019, 18:24</span>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div style="padding: 10px;" class="media-text text-justify text-white">Веселий неординарний хлопець. Показав цікаві заклади, які складно було б знайти самій у Львові. Ці кілька годин запам'ятаю надовго. Заслужена п'ятірка.</div>
                                </div>
                                <div class="panel-footer">
                                    <a class="btn btn-primary" href="#">Відповісти</a>
                                </div>
                            </div>
                            <hr>
                            <div class="media">
                                <div class="media-left">
                                    <a href="#"><img style="padding: 10px;" class="media-object img-rounded" src="img/avatar.jpg" alt=""></a>
                                </div>
                                <div class="media-body">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <div class="author text-white">Богдан</div>
                                            <div class="metadata">
                                                <span class="date text-white">9 травня 2019, 12:48</span>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div style="padding: 10px;" class="media-text text-justify text-white">Дякую. Дуже приємно. Сподіваюсь, ще зустрінемось у твоєму рідному місті.</div>
                                            <div class="panel-footer">
                                                <a class="btn btn-primary" href="#">Відповісти</a>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                    </li>
                    <li class="media">
                        <div class="media-left">
                            <a href="#"><img style="padding: 10px;" class="media-object img-rounded" src="img/avatar1.jpg" alt="..."></a>
                        </div>
                        <div class="media-body">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="author text-white">Ілона</div>
                                    <div class="metadata">
                                        <span class="date text-white">11 травня 2019, 11:23</span>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div style="padding: 10px;" class="media-text text-justify text-white">Усе розпочиналося як нудна екскурсія, але вже через десять хвилин я відчула різницю. Вона величезна. Відтепер при відвідуванні нового міста користуватимусь тільки цим сервісом.</div>
                                    <div class="panel-footer">
                                        <a class="btn btn-primary" href="#">Відповісти</a>
                                    </div>
                                </div>
                                <hr>
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#"><img style="padding: 10px;" class="media-object img-rounded" src="img/avatar.jpg" alt=""></a>
                                    </div>
                                    <div class="media-body">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <div class="author text-white">Богдан</div>
                                                <div class="metadata">
                                                    <span class="date text-white">3 хвилини тому</span>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div style="padding: 10px;" class="media-text text-justify text-white">Ахаха, нудна? Я намагався почати нашу зустріч професійно. Хоча, якщо чесно, теж не дуже люблю ці офіційності. Дякую за відгук. Працюватиму над цим.</div>
                                                <div class="panel-footer">
                                                    <a class="btn btn-primary" href="#">Відповісти</a>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                    </li>
    </main>
    <footer class="d-flex justify-content-center bg-dark text-white">
        <p>Created by Web::chychka</p>
    </footer>
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

</body>

</html>

<?php
    }}
?>
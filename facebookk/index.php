
<?php 
require_once '../modele/Database.php';
require_once '../controller/session.php';
$user_email = $_SESSION['mail'];
$db = new Database();


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <title>facebook.com</title>
    <!-- style css link -->
    <link rel="stylesheet" href="style.css">
    <!-- fontawesome css link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    
<!-- header section start -->



    <header>
        <div class="header-container">
            <div class="header-wrapper">
            <?php $user = $db->getUserByEmail($_SESSION['mail']);?>
                <div class="logoBox">
                    <img src="../media/logo ECEBOOK.png" alt="logo">
                </div>
                <div class="searchBox">
                    <input type="search">
                    <i class="fas fa-search"></i>
                </div>
                <div class="iconBox2">
                <i class="fa-solid fa-house"></i>
                    <i class="fa-solid fa-bell"></i>
                    <label>  <a href="../facebookk/profil.php">
                    <img src="<?php echo $user['photo'] ?>"  alt="user">
                     </label></a>
                </div>
            </div>
        </div>
    </header>
    




<div class="home">
    <div class="container">
        <div class="home-weapper">

           <!--GAUCHE-->
            <div class="home-left">
                 <!-- BON-->
           


<!--FIN BON -->

<div class="event-friend">
<?php $friendRequests = $db->getFriendRequestsAll($_SESSION['iduser']); ?>
        <div class="friend">
            <h3 class="heading">Friend Requests <span>see all</span></h3>
            <?php if (!empty($friendRequests)): ?>
                <ul>
                    <?php foreach ($friendRequests as $request): ?>
                        <li>
                            <img src="<?= htmlspecialchars($request['photo']) ?>" alt="user">
                            <b><?= htmlspecialchars($request['prenom']) ?> <?= htmlspecialchars($request['nom']) ?></b>
                            <form action="../controller/demandeAjout.php" method="post">
                                <input type="hidden" name="requester_id" value="<?= $request['iduser'] ?>">
                                <button type="submit" name="accept">confirm</button>
                                <button type="submit" name="reject" class="friend-remove">remove</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No friend requests.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="messenger">
    <div class="messenger-search">
        <i class="fa-solid fa-user-group"></i>
        <h4>Messenger</h4>
        <input type="search" placeholder="Search">
        <i class="fa-solid fa-magnifying-glass"></i>
    </div>
    <ul>
        <?php
        $friends = $db-> ShowFriends($_SESSION['iduser']); // Utiliser la fonction affichefriends pour récupérer la liste des amis

        foreach ($friends as $friend) {
            ?>
            <li>
                <img src="<?php echo $friend['photo']; ?>" alt="user">
                <b><?php echo $friend['nom'] . ' ' . $friend['prenom']; ?></b>
                <a href="../view/message.php?id=<?php echo $friend['iduser']; ?>">
                    <i class="fa-brands fa-facebook-messenger"></i>
                </a>
            </li>
            <?php
        }
        ?>
    </ul>
</div>

                
            </div><!-- home left end here -->

            <!-- home center start here -->

            <div class="home-center">
                <div class="home-center-wrapper">
                <div class="messenger">
                <div class="messenger-search">
                <i class="fa-solid fa-user-group"></i>
                <h4>Ajout ami</h4> 
            <div class="form-group">
                    <input class="form-control" type="text" id="search-user" value="" placeholder="Rechercher un ou plusieurs utilisateurs" autocomplete="off" />
                    <div class="search-result"></div>
                </div>
  </div>
</div>
                    <div class="stories">
                        
                        <h3 class="mini-headign">Mes amis</h3>
                        <div class="stories-wrapper">
                        <?php $affichefriends = $db->ShowFriends($_SESSION['iduser']); ?>

                        <?php $affichefriends = $db->ShowFriends($_SESSION['iduser']); ?>

                     <?php foreach ($affichefriends as $request): ?>
                     <div class="single-stories">
                      <div>
                   <img src="<?= htmlspecialchars($request['photo']) ?>" alt="user">
                     <b><?= htmlspecialchars($request['prenom']) ?> <?= htmlspecialchars($request['nom']) ?></b>
                     </div>
                    </div>
                  <?php endforeach; ?>


                        </div>
                        
                    </div>


                    <div class="createPost">

                    <form action="../controller/createPostController.php" method="post" enctype="multipart/form-data">
                    <h3 class="mini-headign">Create post</h3>
                    <div class="post-text">
  <input type="hidden" name="action" value="create">
  <select name="type" id="type">
    <option value="actualités">Actualités</option>
    <option value="événements">Événements</option>
    <option value="général">Général</option>
  </select><br>
  <input type="text" name="titre" id="titre" placeholder="Titre"><br>
  <input type="text" name="contenu" id="contenu" placeholder="Contenu"><br>
  <input type="date" name="date" id="date" placeholder="Date"><br>
  <input type="text" name="lieu" id="lieu" placeholder="Nom du lieu"><br>
  <input type="text" name="identification" id="identification" placeholder="Identification">
  <input type="file" name="photo" id="photo">
    </div>
  <button type="submit">Publier</button>
</form>


                    </div>
                    <div class="fb-post1-header">
                                <ul>
                                    <li>see all</li>
                                    <li>recent</li>
                                </ul>
                            </div>
                    <?php $post = $db->ShowPostAmi($_SESSION['iduser']); ?>
                    <?php foreach ($post as $p) {?>
                    <div class="fb-post1">
                        <div class="fb-post1-container">
                            <div class="fb-p1-main">
                                <?php
    echo '<div class="post">';
    echo '<div class="post-header">';
    echo '<h2>' . $p['prenom'] .'</h2>';
    echo '<h2>' . $p['titre'] . '</h2>';
    echo '<span>' . $p['date'] . '</span><br>'; 
    echo '<a href="../facebookk/profileUnique.php?id=' . $p['etiquette'] . '">' . '@'.$p['etiquette_nom'] . ' ' . $p['etiquette_prenom'] . '</a><br>';
    echo '<a href="../facebookk/lieuPost.php?id=' . $p['idlieu'] . '">' . '@'.$p['lieu_nom'] . '</a>';
    echo '</div>';
    echo '<div class="post-body">';
    echo '<p>' . $p['contenu'] . '</p>';
    if ($p['photo']) {
        echo '<img src="' . $p['photo'] . '" alt="photo">';
    }
    echo '</div>';
    echo '<div class="post-footer">';
    echo '<div class="like-comment">';
    echo '<ul>';
    echo '<li>';
    echo '<img src="images/love.png" alt="love" class="like-button" idpost="'.$p['idpost'].'">';
    echo '<span class="post-likes">' . $p['nb_likes'] . ' likes</span>';
    echo '</li>';
    echo '<li>';
    echo '</li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}?>
                

                </div> <!-- home center wrapper end -->
            </div> <!-- home center end -->

            <div class="home-right">
                <div class="home-right-wrapper">

                    <div class="event-friend">
                        <div class="event">
                            <h3 class="heading">Upcoming Events <span>see all</span></h3>
                            <img src="images/eve.jpg" alt="event-img">
                            <div class="event-date">
                                <h3>21 <b>july</b></h3>
                                <h4>United state of America <span>New York City</span></h4>
                            </div>
                        </div>

                        <hr>

                    </div>

                    

                    <div class="create-page">
                        <ul>
                            <li>
                                <i class="fa-solid fa-circle-plus"></i>
                                <h4>Create Page & Groups</h4>
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </li>
                            <li>
                                <img src="images/group.jpg" alt="groups">
                            </li>
                            <li>
                                <b>simple group or page name <span>200k Members</span></b>
                                <button>Join Group</button>
                            </li>
                        </ul>
                    </div>

                </div><!-- home right wrapper end -->
            </div><!-- home right end -->

        </div>
    </div>
</div>
<!-- home section end -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    // Recherche d'utilisateurs
    $("#search-user").keyup(function () {
      var utilisateur = $(this).val();

      if (utilisateur != "") {
        $.ajax({
          type: "GET",
          url: "../controller/barreRecherche.php",
          data: "user=" + encodeURIComponent(utilisateur),
          success: function (data) {
            $(".search-result").show();
          
            $(".search-result").html(data);
           
            $(".search-result a").click(function (e) {
              e.preventDefault();
              var nomPrenom = $(this).text();
              var amiId = $(this).data("ami-id");

              // Ajoutez un ami lorsque l'utilisateur clique sur le nom d'un utilisateur dans la liste de recherche
              $.ajax({
                type: "GET",
                url: "../controller/barreRecherche.php",
                data: {
                  action: "ajouterAmi",
                  ami_id: amiId,
                },
                success: function (response) {
                  $("#search-user").val("");
                  $(".search-result").html("");
                  console.log(response);
                },
                error: function (xhr, status, error) {
                  console.log(response);
                },
              });
            });
          },
          error: function (xhr, status, error) {
            console.log(error);
          },
        });
      } else {
        $(".search-result").html("");
        $(".search-result").hide();
      }
    });
  });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).on('click', '.like-button', function () {
    var button = $(this);
    var idpost = button.attr("idpost");
    $.ajax({
        url: "../controller/like.php",
        type: "POST",
        data: {
            idpost: idpost
        },
        success: function () {
            // Increment like count
            var count = parseInt($(".like-count-" + idpost).text()) + 1;
            $(".like-count-" + idpost).text(count);

            // Disable like button
            button.prop('disabled', true);
        }
    });
});
</script>



</body>
</html>
<?php
	// get our functions so we can use them!
	require_once( './store_files/functions.php' );
	// validate and get date
	$date = getStoreDate();
	// get the items sorted
	$storeData = getStoreSortedData( $date );
?>

<!DOCTYPE html>
<html>
	<head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Fortnite Battle Royale ItemShop</title>
        <meta name="description" content="See what's new in the item shop" />
        <link rel="stylesheet" type="text/css" href="./css/styles.css" />
        <link href="https://fonts.googleapis.com/css?family=Bungee&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	</head>
	<body style="display: flex;margin: 0;background: #f2f2f2;;color:#fff">
        <script type="text/javascript" src="//w.24timezones.com/l.js" async></script>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous"
    src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3"></script>
        <div class="title">
            <h1>Daily Item Shop</h1>
        </div>

  <h3 class="tagline">Items Shop Refresh on <?php echo date( 'M, jS', strtotime( $date ) ); ?> at 6pm CST</h3>

  <center>
    <div class="announcement">
      <p><a id="clock"></a>&nbsp;&nbsp;|&nbsp;&nbsp;<b>ANNOUNCEMENT</b>: The v9.30 Content Update #3 is out now! Check
        out everything new in the <a href="url">patch notes!.</a></p>
    </div>
  </center>

  <div class="topnav">
    <!-- Centered link -->
    <div class="topnav-centered">
      <a href="http://localhost/Fortnite/" class="w3-bar-item w3-button"><i class="fa fa-map"> Interactive Map</i></a>
    </div>

    <!-- Left-aligned links (default) -->
    <a href="#" class="w3-bar-item w3-button"><i class="fa fa-rss"> News</i></a>
    <a href="http://localhost/fortnite/itemshop.php" class="navbar_active w3-bar-item w3-button"><i class="fa fa-tags"> Item
        shop</i></a>

    <!-- Right-aligned links -->
    <div class="topnav-right">
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-retweet"> Twitter</i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-thumbs-up"> Facebook</i></a>
      <a href="./contact.html" class="w3-bar-item w3-button"><i class="fa fa-comment"> Contact</i></a>
    </div>
  </div>

  <div class="shop-container">
    <?php foreach ( $storeData as $section ) : ?>
    <div class="shop-container__wrapper">
        <div class="shop-title">
            <?php echo $section['info']['title']; ?>
        </div>
        <div  class="shop-body">
          <ul>
            <?php foreach ( $section['items'] as $item ) : ?>
              <li class="shop-body__item rarity-<?php echo strtolower( $item['rarity'] ); ?>">
                  <div style="position:relative">
                    <div style="position:absolute;background: rgba(0,0,0,0.5);bottom:0;width:100%">
                      <div style="padding:5px">
                        <div>
                          <div><?php echo $item['name']; ?></div>
                          <div><?php echo number_format( $item['vBucks'] ); ?><img src="https://d1csjm5qczv852.cloudfront.net/fit-in/200x600/fortnitemaster/static/shop_price.png" alt="Girl with a jacket" width="15" height="15"></div>
                        </div>
                      </div>
                    </div>
                    <img src="<?php echo $item['imageUrl']; ?>" />
                  </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <script src="./js/clock.js"></script>
  </body>
    
    <div class="footer">
  <a href="https://twitter.com/TwitterDev?ref_src=twsrc%5Etfw" class="twitter-follow-button" data-lang="en"
    data-dnt="true" data-show-count="false">Follow @TwitterDev</a>
  <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-width=""
    data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
  <p>NOTE: We are still in beta. More and more features will be added with time.</p>
  <p>
    Copyright © Fortnite 2019. Portions of the materials used are
    trademarks and/or copyrighted works of Epic Games, Inc. All rights
    reserved by Epic. This material is not official and is not endorsed by
    Epic.
  </p>
</div>
</html>
<?php
    require_once( 'functions.php' );

    $date = getStoreDate();

    $storeData = getStoreSortedData( $date );

    echo '<pre>';
    print_r( $storeData );




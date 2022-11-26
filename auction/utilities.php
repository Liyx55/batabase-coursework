<?php

// display_time_remaining:
// Helper function to help figure out what time to display
function display_time_remaining($interval) {

    if ($interval->days == 0 && $interval->h == 0) {
      // Less than one hour remaining: print mins + seconds:
      $time_remaining = $interval->format('%im %Ss');
    }
    else if ($interval->days == 0) {
      // Less than one day remaining: print hrs + mins:
      $time_remaining = $interval->format('%hh %im');
    }
    else {
      // At least one day remaining: print days + hrs:
      $time_remaining = $interval->format('%ad %hh');
    }

  return $time_remaining;

}

// print_listing_li:
// This function prints an HTML <li> element containing an auction listing
function print_listing_li($item_id, $title, $desc, $price, $num_bids, $end_time)
{
  // Truncate long descriptions
  if (strlen($desc) > 250) {
    $desc_shortened = substr($desc, 0, 250) . '...';
  }
  else {
    $desc_shortened = $desc;
  }
  
  // Fix language of bid vs. bids
  if ($num_bids == 1) {
    $bid = ' bid';
  }
  else {
    $bid = ' bids';
  }
  
  // Calculate time to auction end
  $now = new DateTime();
  if ($now > $end_time) {
    $time_remaining = 'This auction has ended';
  }
  else {
    // Get interval:
    $time_to_end = date_diff($now, $end_time);
    $time_remaining = display_time_remaining($time_to_end) . ' remaining';
  }
  
  // Print HTML
  //<img class="card-img-top img-fluid " width="0.11px" style="margin-top: 0.1px;" src="itemphoto/'.$item_id.'.jpg" alt="image description">
  echo('
    <li class="list-group-item d-flex justify-content-between">
    <div class="itemPhoto">
    <img width="100px" height="auto" src="itemphoto/'.$item_id.'.jpg" alt="image description">
    </div>
    <div class="p-2 mr-5"><h5><a href="listing.php?item_id=' . $item_id . '">' . $title . '</a></h5>' . $desc_shortened . '</div>
    <div class="text-center text-nowrap"><span style="font-size: 1.5em">£' . number_format($price, 2) . '</span><br/>' . $num_bids . $bid . '<br/>' . $time_remaining . '</div>
  </li>'
  );
}

function print_mylisting_li($item_id, $title, $desc, $price, $end_time, $time_remaining, $winner){
  // Truncate long descriptions
  if (strlen($desc) > 250) {
    $desc_shortened = substr($desc, 0, 250) . '...';
  }else {
    $desc_shortened = $desc;
  }
  
    // Calculate time to auction end
    $now = new DateTime();
    if ($now > $end_time) {
      $time_remaining = 'This auction has ended';
    }
    else {
      // Get interval:
      $time_to_end = date_diff($now, $end_time);
      $time_remaining = display_time_remaining($time_to_end) . ' remaining';
    }

  // Print HTML
  echo('
    <li class="list-group-item d-flex justify-content-between">
    <div class="itemPhoto">
    <img width="100px" height="auto" src="itemphoto/'.$item_id.'.jpg" alt="image description">
    </div>
      <div class="p-2 mr-5"><h5><a href="listing.php?item_id=' . $item_id . '">' . $title . '</a></h5>' .'Description:  '. $desc_shortened .  '<br/>' .'winnerID: '.$winner.'</div>
      <div class="text-center text-nowrap"><span style="font-size: 1.5em">£' . number_format($price, 2) . '</span><br/>' . '<br/>' . '<div style="color:green">'.$time_remaining.'</div>' . '</div>
    </li>'
  );
}

function print_mybidding_li($itemid, $title, $desc, $price, $end_time, $time_remaining,$winner){
  // Truncate long descriptions
  if (strlen($desc) > 250) {
    $desc_shortened = substr($desc, 0, 250) . '...';
  }else {
    $desc_shortened = $desc;
  }
  
  
  // If-else statment to print different details depending on time-remaining of each item.
  $now = new DateTime(); 
  if ($now > $end_time) {  // Calculate time to auction end
    $time_remaining = 'This auction has ended';
    // Print current user's maximum bid (not the item maximum bid)Show time remaining of each item 
    // Print time remaining in red to indicate auction has ended
    echo('
      <li class="list-group-item d-flex justify-content-between">
      <div class="itemPhoto">
      <img width="100px" height="auto" src="itemphoto/'.$itemid.'.jpg" alt="image description">
      </div>
        <div class="p-2 mr-5"><h5><a href="listing.php?item_id=' . $itemid . '">' . $title . '</a></h5>' . $desc_shortened . '<br/>' .'winnerID: '.$winner. '</div>
        <div class="text-center text-nowrap"><span style="font-size: 1.5em"> Your Highest Bid: £' . number_format($price, 2) . '</span><br/>' . '<div style="color:red">'.$time_remaining.'</div>' . '</div>
        </li>'
    );
  }else {
    // Get interval:
    $time_to_end = date_diff($now, $end_time);
    $time_remaining = display_time_remaining($time_to_end) . ' remaining';
    // Print time remaining in green to indicate auction hasn't ended
    echo('<li class="list-group-item d-flex justify-content-between">
    <div class="itemPhoto">
      <img width="100px" height="auto" src="itemphoto/'.$itemid.'.jpg" alt="image description">
      </div>
      <div class="p-2 mr-5"><h5><a href="listing.php?item_id=' . $itemid . '">' . $title . '</a></h5>' .'Description:  '. $desc_shortened .   '<br/>' .'winnerID: '.$winner.'</div>
      <div class="text-center text-nowrap"><span style="font-size: 1.5em">Your Highest Bid: £' . number_format($price, 2) . '</span> <br/>' . '<div style="color:green">'.$time_remaining.'</div>' . '</div>
      </li>'
    );
  } 
}

?>
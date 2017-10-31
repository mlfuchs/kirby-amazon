<figure class="amazon">
<a href="<?php echo urldecode($pxml->Items->Item->DetailPageURL); ?>" target="_blank">
<img class="col-sm-3" src="<?php echo $thumb_link; ?>" >

<div class="col-sm-9">
<h3><?php echo $pxml->Items->Item->ItemAttributes->Title; ?></h3>
<p>Buy now at Amazon for <?php echo $pxml->Items->Item->OfferSummary->LowestNewPrice->FormattedPrice; ?></p>
<small>Affiliatelink used.</small>

</div></a></figure>
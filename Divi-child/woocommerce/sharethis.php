<?php

	global $post;

	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$thumbnail    = $thumbnail_id ? current( wp_get_attachment_image_src( $thumbnail_id, 'large' ) ) : ''; ?>

	<div class="social">
		<div class="fb-share-button" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u&amp;src=sdkpreparse">Share</a></div>
		<a href="https://twitter.com/share" class="twitter-share-button" data-show-count="false">Tweet</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
		
		<!-- Place this tag in your head or just before your close body tag. -->
		<script src="https://apis.google.com/js/platform.js" async defer>
		  {lang: 'en-GB'}
		</script>

		<!-- Place this tag where you want the share button to render. -->
		<div class="g-plus" data-action="share" data-annotation="none"></div>
	</div>
<?php 
the_post(); 
the_content(); 
?>
<?php 
$core_archives = get_pages( array( 'parent' => get_the_ID(), 
										'post_type' => 'page',
										'post_status' => 'publish',
										'sort_column' => 'menu_order') ) ; 
$num_col_xs = 1;
$num_col_md = 3;
$this_col_class = 'col-md-' . intval(12 / $num_col_md) . ' col-xs-' . intval(12 / $num_col_xs);
$this_col = 0;
if ( !function_exists( 'get_cfc_meta' ) ) return;
?>
<div class="row">
<?php foreach ($core_archives as $this_core_page) : 
	$cfc_glyph = strlen( get_cfc_field('page-meta', 'glyph' , $this_core_page->ID) ) ? "<span class='glyphicon ". get_cfc_field('page-meta', 'glyph' , $this_core_page->ID) ." aria-hidden='true'></span> " : '' ;
	$this_blurb = get_cfc_field('page-meta', 'blurb' , 	$this_core_page->ID);
	if ( empty($this_blurb) ) $this_blurb = wp_trim_words( $this_core_page->post_content ,32 );
	if ( ( ++$this_col % $num_col_md ) == 1 ) echo '<div class="col-xs-12">';
	?>
	<div class="<?php echo $this_col_class ; ?>">
	<div class="well">
	<article <?php post_class( "core-functions" ); ?>>
	  <header>
		<?php echo get_the_post_thumbnail( $this_core_page->ID , 'thumbnail' , array('class' => " img-responsive alignright") ); ?>
		<h3 class="entry-title"><?php echo $cfc_glyph; ?><a href="<?php echo get_page_link( $this_core_page->ID ); ?>"><?php echo $this_core_page->post_title; ?></a></h3>
	  </header>
	  <div class="entry-summary">
		<?php echo $this_blurb; ?>
	  </div>
	</article>
	</div>
	</div>
<?php
	if ( ( $this_col % $num_col_md ) == 0 ) echo '</div>';
	
endforeach; 
if ( ( $this_col % $num_col_md ) != 0 ) echo '</div>';
?>
</div>
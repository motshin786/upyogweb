<?php
/**
* Template Name: News List Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header('inner'); 
$title_id=$Post->ID;
$title_data=get_page($title_id);
$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

$image_id = get_post_thumbnail_id($post->ID);
$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
$image_title = get_the_title($image_id);
if($image_alt !='')
{
	$img_title = $image_alt;
	
}
else if($image_title !='')
{
	 $img_title = $image_title;
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<section class="elementor-section elementor-inner-section elementor-element elementor-element-f791ea2 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="f791ea2" data-element_type="section">
	<div class="elementor-container" style="display: block;">
	
    <br/>

     <h2 class="elementor-heading-title elementor-size-default"><font style="font-size:100%" my="my"><?php echo $title_data=$post->post_title ;?></font></h2>
		

		<div class="wpb_column vc_column_container vc_col-sm-12">
			<div class="vc_column-inner">
				<div class="wpb_wrapper">
					<div class="vc_empty_space" style="height: 20px"><span class="vc_empty_space_inner"></span></div>
					<div class="wpb_text_column wpb_content_element ">
						<div class="wpb_wrapper">
							<div class="content" style="width: 100%;float: left;display: block;">




   
<table class="table table-bordered">
   <thead>

    <tr>
        <th><b>Serial No.</b></th>
        <th><b>Title</b></th>
		<th><b>Type</b></th>
		<th><b>Size</b></th>
		<th><b>Date Published<br/><span style="font-size: 12px">(DD/MM/YYYY)</span></b></th>
		<th><b>Document URL</b></th>
      </tr>

     
</thead>
<tbody>
<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
<?php $args=array('post_type' =>'news','orderby' => 'date',  'order' => 'DESC', 'paged' => $paged, 'posts_per_page' => '-1','post_status'=>'publish');
                     query_posts( $args );
                     $i=1;
					while ( have_posts() ) : the_post();
					//$content = apply_filters('the_content', $post->post_content);
					//$title = apply_filters('the_title', $post->post_title);
					$document_title= get_post_meta($post->ID,'documents_title',true);
					$documents_url= get_field('external_link',$post->ID);
					$date_modified=get_post_meta($post->ID,'date',true);
					$date_modifieds = date('d/m/Y', strtotime($date_modified));
					$current_date = get_the_date( 'j F, Y'); 
				    $current_dates = date('d/m/Y', strtotime($current_date));
				    $bytes =  do_shortcode('[filesize]'.$documents_url['url'].'[/filesize]');	
				    $customurl = get_field($post->ID,'external_link',true);
			    	$ext = pathinfo($documents_url['url'], PATHINFO_EXTENSION);
					 
					
					

				 	?>
<tr>
<td><?php echo $i ?></td>
<td style="text-transform: capitalize;"><?php echo $document_title; ?></td>
<td style="text-transform: capitalize;"><?php if($ext=="pdf") { echo $ext ; } else { echo 'NA'; } ?></td>
<td><?php if($ext=="pdf") { echo $bytes ; } else { echo 'NA'; } ?></td>
<td><?php if($date_modified!=="") { echo $date_modifieds; } else { echo $current_dates; } ?></td>

<td>
<?php if($ext=="pdf") {?>
<a href="<?php echo $documents_url['url']; ?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-file-pdf-o" style="font-size:24px"></i></a>
<?php } else { ?>
<a href="<?php echo $documents_url['url']; ?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo site_url();?>/wp-content/uploads/2023/12/external-link.png" style="width: 25px; height: 25px;"></a>
<?php }  ?>


</td>
</tr>
  <?php $i++; endwhile;?>
<?php wp_reset_query(); ?> 

</tbody>
</table> 
<br/><br/><div style="padding:13px 0 0 0; float:left;">


							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</section>
<?php
get_footer();

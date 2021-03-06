<div id="caf-filter-layout3" class='caf-filter-layout data-target-div<?php echo esc_attr($b)." ".esc_attr($flsr); ?>'>

<?php
	echo apply_filters('tc_caf_custom_title_before_sidebar_filter',array($caf_filter,'tc_caf_custom_title_before_sidebar_filter'));
	?>
	 <?php do_action("caf_after_filter_layout",$id,$b); ?>
<ul class="caf-filter-container caf-filter-layout3">
<?php
if($terms_sel) {
//var_dump($terms_sel);
    $terms_sel=apply_filters('tc_caf_filter_order_by',$terms_sel,$id);
 if(class_exists("TC_CAF_PRO")) {
  if(is_array($tax)) {
   //var_dump($terms);
   $trms=array();
    foreach($terms_sel as $term) {
    if( strpos($term, '___') !== false ) {
     $ln=strpos($term,"___");
     $tx=substr($term,0,$ln);
     $trm=substr($term,$ln+3);
    $trms[$tx][]=$trm;
   }
    }
   $tx1=array();
   foreach($tax as $tx) {
   $tx1[]=array('taxonomy' => $tx,'field'=>'term_id','terms'=>$trms[$tx]);  
   }
  }
  $tx1['relation'] = 'OR';
  $tax_qry= $tx1;
  $args = array(
  //'cat' => $term_id,
  'post_type' => $caf_cpt_value,
  'tax_query' => $tax_qry);
 }
 
 else {
$args = array(
  //'cat' => $term_id,
  'post_type' => $caf_cpt_value,
  'tax_query' => array(
        array(
            'taxonomy' => $tax,
            'field'    => 'id',
            'terms'    => $terms_sel,
        ),),);
 }
$the_query = new WP_Query( $args );
$post_count_all=$the_query->found_posts;	
 $all_text="All";
$all_text=apply_filters('tc_caf_filter_all_text',$all_text,$id);
if(class_exists("TC_CAF_PRO")) {
  $trm1=implode(',',$terms_sel_tax);
 }
  else {
  $trm1=implode(',',$terms_sel);
  } 
 if(!class_exists("TC_CAF_PRO")) {
  $cl='active';
 }
 else {
 if($caf_default_term=='all') {
 $cl='active';
 }
 }
 
echo '<li><a href="#" data-id="'.esc_attr($trm1).'" data-main-id="flt" class="'.esc_attr($cl).'" data-target-div="data-target-div'.esc_attr($b).'"><span class="post_count">'.esc_html($post_count_all).'</span>'.esc_attr($all_text).'&nbsp;<i class="fa fa-angle-double-right"></i></a></li>';
foreach ($terms_sel as $term) {
$term_data=get_term($term);
if($term_data) {
 if(class_exists("TC_CAF_PRO"))
 {
  if($caf_default_term==$term_data->taxonomy."___".$term_data->term_id) {$cl='active';} else {$cl='';} 
 }
 else {
  $cl='';
 }
 
$term_id=$term_data->term_id;
$term_tx=$term_data->taxonomy;
//echo $caf_cpt_value;
$args = array(
  //'cat' => $term_id,
  'post_type' => $caf_cpt_value,
  'tax_query' => array(
        array(
            'taxonomy' => $term_tx,
            'field'    => 'id',
            'terms'    => $term_id,
        ),),);
$the_query = new WP_Query( $args );
$post_count=$the_query->found_posts;	
 if(class_exists("TC_CAF_PRO")) {
  $data_id=esc_attr($term_data->taxonomy)."___".esc_attr($term_data->term_id);
 }
 else {
  $data_id=esc_attr($term_data->term_id);
 }
 $ic='';
if(isset($trc)) {
  if(isset($trc[$term_data->term_id])) {
 $ic=$trc[$term_data->term_id];
   }
}
echo "<li><a href='#' class='".esc_attr($cl)."' data-id='".esc_attr($data_id)."' data-main-id='flt' data-target-div='data-target-div".esc_attr($b)."'><span class='post_count'>".esc_attr($post_count)."</span>";
 if(class_exists("TC_CAF_PRO") && $ic) {
 echo "<i class='$ic caf-front-ic'></i>";
 }
 echo esc_html($term_data->name)." <i class='fa fa-angle-double-right'></i></a></li>";	
}	
}
}	
?>
</ul>

</div>
<?php
echo "<style>
.data-target-div".$b." span.post_count,.data-target-div".$b." h2.caf-cat-title:after{background-color: ".$caf_filter_primary_color.";color: ".$caf_filter_sec_color2.";}
.data-target-div".$b." #caf-filter-layout3 li a.active span.post_count{background-color: ".$caf_filter_sec_color2.";color: ".$caf_filter_primary_color.";}
.data-target-div".$b." #caf-filter-layout3 li a span.post_count{color: ".$caf_filter_sec_color.";background-color: ".$caf_filter_primary_color.";}
.data-target-div".$b." #caf-filter-layout3 li a {font-family:".$caf_filter_font."}
.data-target-div".$b." #caf-filter-layout3 li a.active{background-color: ".$caf_filter_primary_color."; color: ".$caf_filter_sec_color2."; border-color: ".$caf_filter_primary_color.";}

.data-target-div".$b." .manage-caf-search-icon i {background-color: ".$caf_filter_sec_color.";color: ".$caf_filter_primary_color.";text-transform:".$caf_filter_transform.";font-size:".$caf_filter_font_size."px;}
.data-target-div".$b." #caf-filter-layout1 li a.active {background-color: ".$caf_filter_sec_color2.";color: ".$caf_filter_sec_color.";}

.data-target-div".$b." .search-layout2 input#caf-search-sub,.data-target-div".$b." .search-layout1 input#caf-search-sub {background-color: ".$caf_filter_sec_color.";color: ".$caf_filter_primary_color.";text-transform:".$caf_filter_transform.";font-size:".$caf_filter_font_size."px;}

.data-target-div".$b." .search-layout2 input#caf-search-input {font-size:".$caf_filter_font_size."px;text-transform:".$caf_filter_transform.";}
.data-target-div".$b." .search-layout1 input#caf-search-input {font-size:".$caf_filter_font_size."px;text-transform:".$caf_filter_transform.";}
</style>";
?>
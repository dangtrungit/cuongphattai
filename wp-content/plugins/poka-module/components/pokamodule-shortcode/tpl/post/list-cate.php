<?php

$terms = get_terms( array(
    'taxonomy'     => 'product_cat', //woocommerce
    'orderby'      => 'name',
    'empty'        => 0
) );

// echo "<pre>";
// print_r($terms);
// echo "</pre>";
$obj = get_queried_object();
$slug_catemain = $obj->slug;


echo "<ul class='product-categories'>";

foreach ($terms as $key => $value) {

    $name_cate = $value->name;
    $slug      = $value->slug;
    $count     = $value->count;
    $id_cate   = $value->term_taxonomy_id;
    if ($slug_catemain == $slug ) {
        $active =  'active';
    }else{
        $active =  '';
    }
    $return    = '<a  href="' . get_category_link( $id_cate ) . '/#'.$slug.'">' . $name_cate . '</a>  <span class="count">('.$count .')</span>';
    echo "<li  class='cat-item ".$active."'> ".$return." </li>";
}
echo "</ul>";
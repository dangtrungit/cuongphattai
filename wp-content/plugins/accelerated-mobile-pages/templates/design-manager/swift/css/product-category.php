h1 * {
    display: block;
    font-size: 21px;
    line-height: 1.214;
    letter-spacing: -1px;
    font-weight: 300;
    margin-bottom: 20px;
}
.term-description p {
    text-align: justify;
    color: #000;
    font-size: 17px;
    line-height: 25px;
    margin-bottom: 15px;
}

.woocommerce-ordering,
.storefront-sorting label,
.woocommerce-result-count,
.storefront-sorting:first-of-type{
    display: none;
}

.archive ul.products li.product {
    margin-bottom: 30px;
    width: 50%;
    float: left;
    list-style-type: none;
    position: relative;
}

ul.products{
    display: flex;
    flex-wrap: wrap;
}

ul.products li.product {
    border: 1px solid #ddd;
    padding: 10px;
}

.archive ul.products li.product .woocommerce-loop-product__title {
    padding: 0;
    font-size: 16px;
    text-align: center;
}

ul.products li.product .woocommerce-loop-product__title {
    font-size: 17px;
    font-weight: bold;
    color: #000;
    height: 30px;
    overflow: hidden;
    padding: 0px 20px;
    text-transform: inherit;
}

ul.products li.product .price {
    font-size: 19px;
    margin-bottom: 15px;
    margin: 10px 0;
    text-align: center;
    display: block;
    color: #43454b;
    font-weight: 400;
    margin-bottom: 1rem;
}

ul.products li.product .onsale {
    position: absolute;
    top: 0;
    right: 0;
    color: #ffffff;
    background-color: #49a0d9;
    font-weight: normal;
    border: 0;
    padding: 8px 20px;
    font-size: 13px;
}

.onsale {
    border: 1px solid;
    border-color: #43454b;
    color: #43454b;
    padding: .202em .6180469716em;
    font-size: .875em;
    text-transform: uppercase;
    font-weight: 600;
    display: inline-block;
    margin-bottom: 1em;
    border-radius: 3px;
}


.archive ul.products li.product:nth-child(even) {
    border-left: 0;
}

.archive ul.products li.product .add_to_cart_button {
    display: none
}

.pagination .page-numbers li, .woocommerce-pagination .page-numbers li {
    display: inline-block;
}

ul.products li.product .price .woocommerce-Price-amount.amount {
    font-weight: bold;
    color: #ff2222;
}

ul.product_list_widget li ins,
ul.products li.product ins{
    text-decoration: none;
}

ul.product_list_widget li del .woocommerce-Price-amount.amount,
ul.products li.product .price del .woocommerce-Price-amount.amount {
    font-weight: normal;
    color: #b7b7b7;
    display: block;
    margin: 5px 0;
}

ul.product_list_widget li del,
ul.products li.product .price del{
    text-decoration-color: #9E9E9E;
}

pagination, .woocommerce-pagination {
    padding: 1em 0;
    border: 1px solid rgba(0,0,0,.05);
    border-width: 1px 0;
    text-align: center;
    clear: both;
    margin: 10px 0 20px;
}

.pagination .page-numbers li .page-numbers, .woocommerce-pagination .page-numbers li .page-numbers {
    border-left-width: 0;
    display: inline-block;
    padding: 8px 12px;
    background-color: #000;
    color: #fff;
}

.pagination li .page-numbers.current, .woocommerce-pagination li .page-numbers.current {
    background-color: #49a0d9;
}

.list-tag {
    background-color: #F5F5F5;
    padding: 10px;
}

.list-tag label {
    font-size: 15px;
    color: #000000;
    text-transform: uppercase;
}

.list-tag span {
    margin-right: 12px;
    margin-bottom: 8px;
    display: inline-block;
}

.list-tag a {
    color: #49a0d9;
    font-size: 15px;
}


.amp-mode-mouse .amp-carousel-button, amp-carousel[controls] .amp-carousel-button{
    height: 22px;
    width: 22px;
    top: 50px;

}

.poka-ordering {
    background-color: #000000;
    padding: 20px 10px;
    padding-bottom: 0;
}


.poka-ordering .item .line {
    width: 100%;
    display: inline-block;
    background-image: linear-gradient(to right, rgba(0, 0, 0, 0), #fff, rgba(0, 0, 0, 0));
    border: 0;
    height: 2px;
    margin: 20px 0;
}

.poka-ordering .item h3 {
    text-transform: uppercase;
    color: #ffffff;
    font-size: 19px;
    margin-bottom: 15px;
}

.poka-ordering .item.price li:nth-child(odd) {
    width: 50%;
}

.poka-ordering .item.price li:nth-child(even) {
    width: 50%;
}

.poka-ordering .item.price li {
    display: inline-block;
    margin-bottom: 10px;
}

.poka-ordering .item.price a {
    text-decoration: none;
    font-weight: normal;
    color: #ffffff;
    font-size: 15px;
  
}

.poka-ordering .item.color a {
    display: inline-block;
    margin: 5px;
}

.poka-ordering .item.color a span {
    border: 1px solid #ffffff;
    width: 30px;
    height: 30px;
    display: inline-block;
}

.widget ul {
    margin-left: 0;
    list-style: none;
}

#secondary .product_list_widget li {
    padding: 15px 0;
    border-bottom: 1px solid #ddd;
    clear: both;
    position: relative;
}

#secondary .product_list_widget .product-title {
    font-size: 15px;
    font-weight: bold;
    color: #000;
    line-height: 18px;
    position: absolute;
    top: 0;
    left: 170px;
    width: 100%;
}

#secondary .product_list_widget .woocommerce-Price-amount.amount {
    font-weight: bold;
    color: #ff2222;
    font-size: 19px;
}

ul.product_list_widget li del{
    bottom: 55px;
    left: 170px;  
    position: absolute;  
}

ul.product_list_widget li ins{
    bottom: 25px;
    left: 170px;
    position: absolute;
}

#secondary .product_list_widget li>.woocommerce-Price-amount.amount{
    padding-left: 15px;
}

#secondary .product_list_widget del .woocommerce-Price-amount.amount {
    font-weight: normal;
    color: #b7b7b7;
    margin-bottom: -7px;
}

#secondary .product_list_widget a {
    display: inline-block;
    width: 150px;
    position: relative;
}


#secondary .poka-list-post .post-image {
    float: left;
    width: 30%;
}

#secondary .poka-list-post .post-content {
    float: right;
    width: 65%;
}

#secondary .poka-list-post .item-post {
    display: inline-block;
    margin-bottom: 20px;
}

#secondary .poka-list-post .post-title .title {
    font-size: 15px;
    line-height: 22px;
    font-weight: normal;
    color: #000000;
    text-decoration: none;
}

.poka-ordering .thuonghieu ul,
.poka-ordering .kichthuoc ul{
    column-count: 2;
    column-fill: balance;
    margin-bottom: 20px;
}

.poka-ordering .thuonghieu li a,
.poka-ordering .kichthuoc li a{
    display: inline-block;
    color: #fff;
    margin-bottom: 10px;
}

<?php 
    
    if (is_shop()) {
        $data  = pokaGetAttrProduct();
        
        if(!empty($data)){
            foreach($data as $key => $value){
                if($value['taxonomy'] == 'pa_color'){
                    $color = get_option('_pa_color_' . $value['term_id']);
                    echo '.'.str_replace("#", "color-", $color).' {background-color: '.$color.';}';
                }
            }
        }
    }else{
        $cate     = get_queried_object();
        $cateID   = $cate->term_id;
        $data     = pokaGetAttrProduct2($cateID);
        $arrColor = $data['color'];

        foreach($arrColor as $keyColor => $valueColor){
            $color = get_option('_pa_color_' . $valueColor);
            echo '.'.str_replace("#", "color-", $color).' {background-color: '.$color.';}';
        }
    }

    
    

 ?>
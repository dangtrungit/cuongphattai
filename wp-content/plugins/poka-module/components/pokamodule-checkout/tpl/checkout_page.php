<?php 
    if( !is_user_logged_in() ){
        $user_login = "customer_order";
        $email      = "customer_order@gmail.com";
        $password   = "pYDejDXl2P%yt0l7Hk3mYWQ!";
        
        if (!username_exists($user_login)) {
            $user_data = array(
                'user_login'   => trim($user_login),
                'user_pass'    => trim($password),
                'first_name'   => 'Khách',
                'last_name'    => 'Hàng',
                'user_email'   => trim($email),
                'display_name' => 'Khách Hàng'
            );
            $user_id=wp_insert_user($user_data);
            update_option( "acc_customer_order", $user_id);
        }
//
        $creds = array();
        $creds['user_login']    = $user_login;
        $creds['user_password'] = $password ;
        $creds['remember'] = false;
        $user = wp_signon( $creds, false );
        if ( is_wp_error($user) )
            $user->get_error_message();
    }

 ?>


<section id="wrap_cart" >
    <div class="message"></div>
    <div class="bar-top">
        <a href="<?php echo get_home_url(); ?>" class="buymore"><i class="fa fa-angle-left" aria-hidden="true"></i>  <?php echo 'Mua thêm sản phẩm khác'; ?></a>
        <div class="yourcart"><?php echo 'Giỏ hàng của bạn' ; ?></div>
    </div>

    <div class="wrap_cart" class="ui segment">
        <form action="" class="form ui" method="post" id="orderform" accept-charset="utf-8">
            <div class="listorder">
                <?php echo Common::display_products(); ?>
            </div>
            
            <div class="area_total">

                <div class="total">   
                    <?php echo Common::displayTotal(); ?>   
                </div>

                <div class="boxCouponCode">
                    <div class="textcode">
                        <?php echo 'Sủ dụng mã giảm giá'; ?>
                    </div>
                    <div class="inputcode field">
                        <input name="CouponCode" id="CouponCode" placeholder="Nhập mã giảm giá" maxlength="20">
                        <label id="CouponCode-error" class="error" for="CouponCode""></label>
                        <button type="button"><?php echo 'Áp Dụng'; ?></button>
                    </div>
                </div>
            </div>

            <div class="infouser">
                <div class="field field_gender">
                    <label data-choose-value="Anh"><i class="iconmobile-opt" ></i> <?php echo 'Anh'; ?></label>
                    <label data-choose-value="Chị"><i class="iconmobile-opt" ></i><?php echo 'Chị'; ?></label>
                    <input type="text" name="chosse_gender" id="chosse_gender">
                </div>

                <div class="fields">
                    <div class="field field_name">
                       <input type="text" name="name" id="name" placeholder="<?php echo 'Họ và tên'; ?>">
                   </div>

                   <div class="field field_phone">
                       <input type="number" name="phonenumbers" id="phonenumbers" placeholder="<?php echo 'Số điện thoại'; ?>">
                   </div>
               </div>

               <div class="field field_email" >
                   <input type="email" name="order_email" id="order_email" placeholder="Email">
               </div>

               <div class="field field_excerpt">
                   <input type="text" name="order_excerpt" id="order_excerpt" placeholder="<?php echo 'Yêu cầu khác(Không bắt buộc):'; ?>">
               </div>

           </div>
      
        <div class="area_address">
            <div class="field field_province">
                 <select  name="province"  id="province2" class="" >
                        <option value="">Chọn Tỉnh/Thành phố</option>
                        <option value="AN-GIANG">An Giang</option>
                        <option value="BA-RIA-VUNG-TAU">Bà Rịa - Vũng Tàu</option>
                        <option value="BAC-LIEU">Bạc Liêu</option>
                        <option value="BAC-KAN">Bắc Kạn</option>
                        <option value="BAC-GIANG">Bắc Giang</option>
                        <option value="BAC-NINH">Bắc Ninh</option>
                        <option value="BEN-TRE">Bến Tre</option>
                        <option value="BINH-DUONG">Bình Dương</option>
                        <option value="BINH-DINH">Bình Định</option>
                        <option value="BINH-PHUOC">Bình Phước</option>
                        <option value="BINH-THUAN">Bình Thuận</option>
                        <option value="CA-MAU">Cà Mau</option>
                        <option value="CAO-BANG">Cao Bằng</option>
                        <option value="CAN-THO">Cần Thơ</option>
                        <option value="DA-NANG">Đà Nẵng</option>
                        <option value="DAK-LAK">Đắk Lắk</option>
                        <option value="DAK-NONG">Đắk Nông</option>
                        <option value="DONG-NAI">Đồng Nai</option>
                        <option value="DONG-THAP">Đồng Tháp</option>
                        <option value="DIEN-BIEN">Điện Biên</option>
                        <option value="GIA-LAI">Gia Lai</option>
                        <option value="HA-GIANG">Hà Giang</option>
                        <option value="HA-NAM">Hà Nam</option>
                        <option value="HA-NOI-NOI-THANH">Hà Nội (Nội thành)</option>
                        <option value="HA-NOI-NGOAI-THANH">Hà Nội (Ngoại thành)</option>
                        <option value="HA-TINH">Hà Tĩnh</option>
                        <option value="HAI-DUONG">Hải Dương</option>
                        <option value="HAI-PHONG">Hải Phòng</option>
                        <option value="HOA-BINH">Hòa Bình</option>
                        <option value="HAU-GIANG">Hậu Giang</option>
                        <option value="HUNG-YEN">Hưng Yên</option>
                        <option value="HO-CHI-MINH">Hồ Chí Minh</option>
                        <option value="KHANH-HOA">Khánh Hòa</option>
                        <option value="KIEN-GIANG">Kiên Giang</option>
                        <option value="KON-TUM">Kon Tum</option>
                        <option value="LAI-CHAU">Lai Châu</option>
                        <option value="LAO-CAI">Lào Cai</option>
                        <option value="LANG-SON">Lạng Sơn</option>
                        <option value="LAM-DONG">Lâm Đồng</option>
                        <option value="LONG-AN">Long An</option>
                        <option value="NAM-DINH">Nam Định</option>
                        <option value="NGHE-AN">Nghệ An</option>
                        <option value="NINH-BINH">Ninh Bình</option>
                        <option value="NINH-THUAN">Ninh Thuận</option>
                        <option value="PHU-THO">Phú Thọ</option>
                        <option value="PHU-YEN">Phú Yên</option>
                        <option value="QUANG-BINH">Quảng Bình</option>
                        <option value="QUANG-NAM">Quảng Nam</option>
                        <option value="QUANG-NGAI">Quảng Ngãi</option>
                        <option value="QUANG-NINH">Quảng Ninh</option>
                        <option value="QUANG-TRI">Quảng Trị</option>
                        <option value="SOC-TRANG">Sóc Trăng</option>
                        <option value="SON-LA">Sơn La</option>
                        <option value="TAY-NINH">Tây Ninh</option>
                        <option value="THAI-BINH">Thái Bình</option>
                        <option value="THAI-NGUYEN">Thái Nguyên</option>
                        <option value="THANH-HOA">Thanh Hóa</option>
                        <option value="THUA-THIEN-HUE">Thừa Thiên - Huế</option>
                        <option value="TIEN-GIANG">Tiền Giang</option>
                        <option value="TRA-VINH">Trà Vinh</option>
                        <option value="TUYEN-QUANG">Tuyên Quang</option>
                        <option value="VINH-LONG">Vĩnh Long</option>
                        <option value="VINH-PHUC">Vĩnh Phúc</option>
                        <option value="YEN-BAI">Yên Bái</option>
                    </select>
            </div>

            <div class="field field_address">
                <input type="text" name="address" id="address" placeholder="<?php echo 'Số nhà, tên đường, phường / xã'; ?>">
            </div>

        </div>  
   
        <div class="shipping_custom">
            <h4><?php echo 'Phí giao hàng'; ?>:</h4>
            <div class="shipping_info">
                <p>- <span><?php echo 'Miền Bắc'; ?>:</span> 15.000đ</p>
                <p>- <span><?php echo 'Miền Trung'; ?>:</span> 20.000đ</p>
                <p>- <span><?php echo 'Miền Nam'; ?>:</span> 25.000đ</p>
            </div>

            <p><?php echo 'Xem thông tin thêm tại:'; ?> <a href="http://bagi.com.vn/huong-dan-mua-hang/" class="link-text"><?php echo 'Hướng dẫn mua hàng'; ?></a></p>
        </div>
        <div class="success_order">
            <input type="button" id="create_order" value="Hoàn thành Đơn hàng">
        </div>

    </form>
    <div class="ui dimmer">
        <div class="ui text loader">Loading</div>
    </div>
</div>
</section>


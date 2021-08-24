<?php

function mo_openid_licensing_plans()
{
    wp_enqueue_style( 'mo_openid_plugins_page_style', plugin_dir_url(dirname(dirname(__FILE__))).'includes/css/mo_openid_licensing_plan.css?version=7.4.7' );
    ?>

    <div style="text-align: center; font-size: 14px; background: forestgreen; color: white; padding-top: 4px; padding-bottom: 4px; border-radius: 16px;"></div>

    <input type="hidden" id="mo_license_plan_selected" value="" />
    <div class="mo-openid-tab-content">
        <div class="active">
            <br>
            <div class="mo-openid-cd-pricing-container mo-openid-cd-has-margins"><br>
                <div class="mo-open-id-cd-pricing-switcher">
                    <p id="pricing" class="mo-open-id-fieldset" style="background-color: #e97d68;">
                        <input type="radio" name="sitetype" value="singlesite" id="singlesite" checked>
                        <label for="singlesite">Plugins</label>
                        <input type="radio" name="sitetype" value="multisite" id="multisite">
                        <label for="multisite">Multisite</label>
                        <span id="mo_switcher_1" class="mo-open-id-cd-switch"></span>
                        <input type="radio" name="sitetype" value="mo_add-on" id="mo_add-on">
                        <label for="mo_add-on">Add-On</label>
                        <span id="mo_switcher_2" class="x"></span>
                    </p>
                </div>
                <div style="line-height: initial; background: #F2F5FB;border-radius:5px;font-size: large;margin-top:10px;padding:10px;border-style: solid;border-color: #2f6062">
                    <span class="dashicons dashicons-info" style="vertical-align: bottom;"></span>
                    Upgrading to any plan is a <b style="color: black">One-Time Payment</b> which includes 1 year of updates. You can continue using all the available features in that plan for lifetime. Contact us at <a style="color:blue
    " href="mailto:socialloginsupport@xecurify.com">socialloginsupport@xecurify.com</a> for bulk discounts.
                </div>

                <div style="line-height: initial; background: #efafaf;border-radius:5px;font-size: large;margin-top:10px;padding:10px;border-style: solid;border-color: #2f6062"
                     data-type="singlesite" class="mosslp is-visible" id="mo_apple_plan">
                    <img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/icons/apple.png" alt="facebook" style="margin-top:-1%;margin-bottom:-1%;"/> New <b style="color: black">Apple</b> plan available for <b>$25</b> only, which includes <b>Apple Application</b> along with all the Free Features. <a href="#" onclick="mosocial_addonform('wp_social_login_apple_plan')" >Click here</a> to upgrade.
                </div>
                <ul id="list-type" class="mo-openid-cd-pricing-list cd-bounce-invert" >

                    <li>
                        <ul class="mo-openid-cd-pricing-wrapper" id="col1">
                            <li data-type="singlesite" class="mosslp is-visible" style="">
                                <header class="mo-openid-cd-pricing-header">
                                    <h2 style="margin-bottom: 10%;">Social Sharing</h2>
                                    <label for="mo_openid_ss">Select No. of Instances : </label>
                                    <select name="mo_openid_ss" id="mo_openid_ss">
                                        <option value="1">1</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                    </select>

                                    <div class="cd-price" style="margin-top: 9%;">
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_ss1" class="mo-openid-cd-value">19</span> &nbsp;&nbsp;
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_ss2" class="mo-openid-cd-value"><s>25</s></span>
                                    </div>
                                </header> <!-- .mo-openid-cd-pricing-header -->
                                <footer class="mo-openid-cd-pricing-footer">
                                    <a href="#" class="mo-openid-cd-select" onclick="mosocial_addonform('wp_social_login_share_plan')" >Upgrade Now</a>
                                </footer>

                                <div class="mo-openid-cd-pricing-body">
                                    <ul class="mo-openid-cd-pricing-features ">
                                        <li onclick="mo_all_features_clk()" style="cursor:pointer;" title="Click here for Feature list" class="mo_openid-on-hover-free-fetr"><b>All Free Features +</b></li>
                                        <li class="mo-openid-lic-bold-cl" style="color: red">X</li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">45 Social Sharing Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;"> Facebook, Twitter, Vkontakte, WhatsApp, Tunmblr, StumbleUpon, LinkedIn, Reddit, Pinterest, Pocket, Digg, Email, Print.<span id="mo_openid_dots11">...</span><span id="mo_openid_more11" style="display:none" ><br>Buffer, Amazon_wishlist, Telegram, Line, Yahoo, Instapaper, Mewe, Livejournal, Mix, AOI Mail, Qzone, Gmail, Typepad_post, Fark, Bookmark, Fintel, Mendeley, Slashdot, Wanelo, Classroom, Yummly, Hacker_news, Kakao, Plurk, Trello, wykop, Weibo, Renren, Xing, Wordpress, Front it, Skype, Kindle It, Bloggerpost, Mail.ru, Papaly, Blogmarks, Twiddla.</span><button style="border:transparent;background-color: transparent;color: tomato;" onclick="myFunction('mo_openid_dots11','mo_openid_more11','mo_openid_myBtn11')" id="mo_openid_myBtn11">Read more</button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">10 Social Login Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;"> Facebook, Google, Vkontakte, LinkedIn, Windows Live, Amazon, Salesforce, Yahoo.</span></div></li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">8 Pre-Configured Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;"> Google, Vkontakte, LinkedIn, Windows Live, Amazon, Salesforce, Yahoo, Wordpress</span></div></li>
                                        <li>Sharing Display Option</li>
                                        <li>Hover Icons & Floating Icons</li>
                                        <li>Discord Auto Post</li>
                                        <li>Sharing Icons for BBPress</li>
                                        <li>WooCommerce Product Sharing</li>
                                        <li>E-mail subscriber</li>
                                        <li>Facebook Share Count</li>
                                        <li>Facebook Like & Recommended</li>
                                        <li>Pinterest Pin it Button</li>
                                        <li>Twitter Follow Button</li>
                                        <li>Vertical Icons & Horizontal Icons</li>
                                        <li>Vkontakte, Stumble Upon, Buffer, Pinterest and Reddit Share Count</li>
                                        <li style="padding:7.5%;" class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl" style="padding: 7%;">X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl">X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li style="padding:7.5%;" class="mo-openid-lic-bold-cl">X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>

                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>

                                        <li style="padding:7.5%;" class="mo-openid-lic-bold-cl">X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl">X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li style="padding:7.51%;"class="mo-openid-lic-bold-cl">X</li>

                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>

                                        <li style="padding:7.8%;" class="mo-openid-lic-bold-cl">X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>

                                        <li>Shortcodes to display social icons on<br/>any homepage page, post, popup and php pages.</li>

                                        <li><a style="cursor: pointer" onclick="mo_openid_support_form('')">Click here to Contact Us</a></li>

                                    </ul>
                                </div> <!-- .mo-openid-cd-pricing-body -->
                            </li>
                            <li data-type="multisite" class="momslp is-hidden" style="">
                                <header class="mo-openid-cd-pricing-header">
                                    <h2 style="margin-bottom: 10%;">Social Sharing</h2>
                                    <label for="mo_openid_m_share">Select No. of Instances : </label>
                                    <select name="mo_openid_m_share" id="mo_openid_m_share" onchange="update_val_share('mo_openid_m_share','mo_openid_m_share_sub','mo_openid_m_share1','mo_openid_m_share2')">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select><br/><br/>
                                    <label for="mo_openid_m_std_share">Select No. of Sub-Site : </label>
                                    <select name="mo_openid_m_share_sub" id="mo_openid_m_share_sub" onchange="update_val_share('mo_openid_m_share','mo_openid_m_share_sub','mo_openid_m_share1','mo_openid_m_share2')">
                                        <option value="3">3</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                        <option value="300">300</option>
                                        <option value="400">400</option>
                                        <option value="500">500</option>
                                    </select>

                                    <div class="cd-price" style="margin-top: 9%;">
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_m_share1" class="mo-openid-cd-value">47.5</span> &nbsp;&nbsp;
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_m_share2" class="mo-openid-cd-value"><s>116</s></span>
                                    </div>
                                </header> <!-- .mo-openid-cd-pricing-header -->
                                <footer class="mo-openid-cd-pricing-footer">
<!--                                    <a href="#" class="mo-openid-cd-select" onclick="mosocial_addonform('wp_social_login_share_plan')" >Upgrade Now</a>-->
                                    <a href="#" class="mo-openid-cd-select" onclick="mo_openid_support_form('wp_social_login_share_plan-multisite : ')" >Contact us for more details</a>
                                </footer>

                                <div class="mo-openid-cd-pricing-body">
                                    <ul class="mo-openid-cd-pricing-features ">
                                        <li onclick="mo_all_features_clk()" style="cursor:pointer;" title="Click here for Feature list" class="mo_openid-on-hover-free-fetr"><b>All Free Features +</b></li>
                                        <li class="mo-openid-lic-bold-cl" style="color: red">X</li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">45 Social Sharing Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;"> Facebook, Twitter, Vkontakte, WhatsApp, Tunmblr, StumbleUpon, LinkedIn, Reddit, Pinterest, Pocket, Digg, Email, Print.<span id="mo_openid_dots12">...</span><span id="mo_openid_more12" style="display:none" ><br>Buffer, Amazon_wishlist, Telegram, Line, Yahoo, Instapaper, Mewe, Livejournal, Mix, AOI Mail, Qzone, Gmail, Typepad_post, Fark, Bookmark, Fintel, Mendeley, Slashdot, Wanelo, Classroom, Yummly, Hacker_news, Kakao, Plurk, Trello, wykop, Weibo, Renren, Xing, Wordpress, Front it, Skype, Kindle It, Bloggerpost, Mail.ru, Papaly, Blogmarks, Twiddla.</span><button style="border:transparent;background-color: transparent;color: tomato;" onclick="myFunction('mo_openid_dots12','mo_openid_more12','mo_openid_myBtn12')" id="mo_openid_myBtn12">Read more</button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">10 Social Login Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;"> Facebook, Google, Vkontakte, LinkedIn, Windows Live, Amazon, Salesforce, Yahoo.</span></div></li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">8 Pre-Configured Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;"> Google, Vkontakte, LinkedIn, Windows Live, Amazon, Salesforce, Yahoo, Wordpress</span></div></li>

                                        <li>Sharing Display Option</li>
                                        <li>Hover Icons & Floating Icons</li>
                                        <li>Discord Auto Post</li>
                                        <li>Sharing Icons for BBPress</li>
                                        <li>WooCommerce Product Sharing</li>
                                        <li>E-mail subscriber</li>
                                        <li>Facebook Share Count</li>
                                        <li>Facebook Like & Recommended</li>
                                        <li>Pinterest Pin it Button</li>
                                        <li>Twitter Follow Button</li>
                                        <li>Vertical Icons & Horizontal Icons</li>
                                        <li>Vkontakte, Stumble Upon, Buffer, Pinterest and Reddit Share Count</li>
                                        <li class="mo-openid-lic-bold-cl" style="padding: 7%;">X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl">X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li style="padding:7.5%;" class="mo-openid-lic-bold-cl">X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>

                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>

                                        <li style="padding:7.5%;" class="mo-openid-lic-bold-cl">X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl">X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li style="padding:7.51%;"class="mo-openid-lic-bold-cl">X</li>

                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>

                                        <li style="padding:7.8%;" class="mo-openid-lic-bold-cl">X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li>Shortcodes to display social icons on<br/>any homepage page, post, popup and php pages.</li>

                                        <li><a style="cursor: pointer" onclick="mo_openid_support_form('')">Click here to Contact Us</a></li>

                                    </ul>
                                </div> <!-- .mo-openid-cd-pricing-body -->
                            </li>
                            <li data-type="mo_add-on" class="moaslp is-hidden" style="">
                                <header class="mo-openid-cd-pricing-header">

                                    <h2 style="margin-bottom: 10%;" >Custom Registration Form Add-On </h2>

                                    <label for="mo_openid_cra">Select No. of Instances : </label>
                                    <select name="mo_openid_cra" id="mo_openid_cra">
                                        <option value="1">1</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                    </select>

                                    <div class="cd-price" style="margin-top: 9%;">
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_cra1" class="mo-openid-cd-value">35</span> &nbsp;&nbsp;
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_cra2" class="mo-openid-cd-value"><s>39</s></span>

                                    </div>
                                </header>
                                <!-- .mo-openid-cd-pricing-header -->
                                <footer class="mo-openid-cd-pricing-footer">
                                    <a href="#" class="mo-openid-cd-select" id="mosocial_purchase_cust_addon" onclick="mosocial_addonform('wp_social_login_extra_attributes_addon')" >Upgrade Now</a>
                                </footer>

                                <div class="mo-openid-cd-pricing-body">
                                    <ul class="mo-openid-cd-pricing-features">
                                        <li>Create a pre-registration form</li>
                                        <li>Allow user to select Role while Registration</li>
                                        <li>All WordPress Themes Supported</li>
                                        <li>Map Users Data returned from all Social Apps</li>
                                        <li>Add Custom Fields in the Registration form</li>
                                        <li>Edit Profile option using shortcode</li>
                                        <li>Support input field types: text, date, checkbox or dropdown</li>
                                        <li>Advanced Form Control</li>
                                        <li>Sync existing meta field</li>
                                        <li><a style="cursor: pointer" onclick="mo_openid_support_form('')">Click here to Contact Us</a></li>
                                    </ul>
                                </div> <!-- .mo-openid-cd-pricing-body -->
                            </li>
                        </ul> <!-- .mo-openid-cd-pricing-wrapper -->
                    </li>

                    <li class="mo-openid-cd-popular">
                        <ul class="mo-openid-cd-pricing-wrapper" id="col2">
                            <li data-type="singlesite" class="mosslp is-visible" style="">
                                <header class="mo-openid-cd-pricing-header">
                                    <h2 style="margin-bottom: 10%;" >Standard<span style="font-size:0.5em"></span></h2>

                                    <label for="mo_openid_std">Select No. of Instances : </label>
                                    <select name="mo_openid_std" id="mo_openid_std">
                                        <option value="1">1</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                    </select>

                                    <div class="cd-price" style="margin-top: 9%;">
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_std1" class="mo-openid-cd-value">29</span> &nbsp;&nbsp;
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_std2" class="mo-openid-cd-value"><s>39</s></span>
                                    </div>
                                </header> <!-- .mo-openid-cd-pricing-header -->
                                <footer class="mo-openid-cd-pricing-footer">
                                    <a href="#" class="mo-openid-cd-select" onclick="mosocial_addonform('wp_social_login_standard_plan')" >Upgrade Now</a>
                                </footer>
                                <div class="mo-openid-cd-pricing-body">
                                    <ul class="mo-openid-cd-pricing-features">
                                        <li onclick="mo_all_features_clk()" style="cursor:pointer;" title="Click here for Feature list" class="mo_openid-on-hover-free-fetr"><b>All Free Features +</b></li>
                                        <li class="mo-openid-lic-bold-cl" style="color: red">X</li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">13 Social Sharing Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;"> Facebook, Twitter, Vkontakte, WhatsApp, Tunmblr, StumbleUpon, LinkedIn, Reddit, Pinterest, Pocket, Digg, Email, Print.<br></span></div></li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">35 Social Login Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;"> Google, Facebook, Twitter, Vkontakte, LinkedIn, Windows Live, Instagram, Amazon, Salesforce, Yahoo, <span id="mo_openid_dots4">...</span><span id="mo_openid_more4" style="display:none" >Wordpress, Mail.RU, Disqus, Pinterest, Yandex, Spotify, Reddit, Tumblr, Vimeo, Kakao, Dribbble, Flickr, MeetUp, Line, Stackexchange, Livejournal, Snapchat, Foursquare, Teamsnap, Naver, Odnoklassniki, Wiebo, Baidu, Renren, QQ.</span><button style="border:transparent;background-color: transparent;color: tomato;" onclick="myFunction('mo_openid_dots4','mo_openid_more4','mo_openid_myBtn4')" id="mo_openid_myBtn4">Read more</button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">8 Pre-Configured Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;"> Google, Vkontakte, LinkedIn, Windows Live, Amazon, Salesforce, Yahoo, Wordpress</span></div></li>
                                        <li>Sharing Display Option</li>

                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>

                                        <li>Facebook Share Count</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li>Vertical Icons & Horizontal Icons</li>
                                        <li style="padding: 7.2%;" class="mo-openid-lic-bold-cl">X</li>
                                        <li style="padding: 7.5%;" class="mo-openid-lic-bold-cl">X</li>
                                        <li>General Data Protection Regulation (GDPR)</li>
                                        <li>Google recaptcha</li>
                                        <li>BuddyPress Display Option</li>
                                        <li>Woocommerce Display Options</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>

                                        <li>Advance Account Linking</li>
                                        <li>Redirect After Login & Logout Option</li>
                                        <li>Role Mapping</li>
                                        <li style="padding: 7.5%;" class="mo-openid-lic-bold-cl">X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li>Account Linking & Unlinking for Users</li>
                                        <li>Email notification to multiple admins</li>
                                        <li>Welcome Email to end users</li>
                                        <li>Customizable Email Notification template</li>
                                        <li>Customizable welcome Email template</li>
                                        <li>Custom CSS for Social Login buttons</li>
                                        <li>Social Login Opens in a New Window</li>
                                        <li>Domain restriction</li>
                                        <li>Force Admin To Login Using Password</li>
                                        <li>Send Username and Password Reset link</li>
                                        <li>Redirect Login To a New Window</li>
                                        <li>Disable Admin Bar</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>

                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li style="padding: 8%;" class="mo-openid-lic-bold-cl">X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li>Shortcodes to display social icons on<br/>any homepage page, post, popup and php pages.</li>

                                        <li><a style="cursor: pointer" onclick="mo_openid_support_form('')">Click here to Contact Us</a></li>
                                    </ul>
                                </div> <!-- .mo-openid-cd-pricing-body -->
                            </li>
                            <li data-type="multisite" class="momslp is-hidden" style="">
                                <header class="mo-openid-cd-pricing-header">
                                    <h2 style="margin-bottom: 10%;" >Standard<span style="font-size:0.5em"></span></h2>
                                    <label for="mo_openid_m_std">Select No. of Instances : </label>
                                    <select name="mo_openid_m_std" id="mo_openid_m_std" onchange="update_val_std('mo_openid_m_std','mo_openid_m_std_sub','mo_openid_m_std1','mo_openid_m_std2')">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select><br/><br/>
                                    <label for="mo_openid_m_std_sub">Select No. of Sub-Site : </label>
                                    <select name="mo_openid_m_std_sub" id="mo_openid_m_std_sub" onchange="update_val_std('mo_openid_m_std','mo_openid_m_std_sub','mo_openid_m_std1','mo_openid_m_std2')">
                                        <option value="3">3</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                        <option value="300">300</option>
                                        <option value="400">400</option>
                                        <option value="500">500</option>
                                    </select>

                                    <div class="cd-price" style="margin-top: 9%;">
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_m_std1" class="mo-openid-cd-value">72.5</span> &nbsp;&nbsp;
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_m_std2" class="mo-openid-cd-value"><s>156</s></span>
                                    </div>
                                </header> <!-- .mo-openid-cd-pricing-header -->
                                <footer class="mo-openid-cd-pricing-footer">
<!--                                    <a href="#" class="mo-openid-cd-select" onclick="mosocial_addonform('wp_social_login_standard_plan')" >Upgrade Now</a>-->
                                    <a href="#" class="mo-openid-cd-select" onclick="mo_openid_support_form('wp_social_login_standard_plan multisite : ')" >Contact us for more details</a>
                                </footer>
                                <div class="mo-openid-cd-pricing-body">
                                    <ul class="mo-openid-cd-pricing-features">
                                        <li onclick="mo_all_features_clk()" style="cursor:pointer;" title="Click here for Feature list" class="mo_openid-on-hover-free-fetr"><b>All Free Features +</b></li>
                                        <li class="mo-openid-lic-bold-cl" style="color: red">X</li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">13 Social Sharing Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;"> Facebook, Twitter, Vkontakte, WhatsApp, Tunmblr, StumbleUpon, LinkedIn, Reddit, Pinterest, Pocket, Digg, Email, Print.<br></span></div></li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">35 Social Login Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;"> Google, Facebook, Twitter, Vkontakte, LinkedIn, Windows Live, Instagram, Amazon, Salesforce, Yahoo, <span id="mo_openid_dots4">...</span><span id="mo_openid_more4" style="display:none" >Wordpress, Mail.RU, Disqus, Pinterest, Yandex, Spotify, Reddit, Tumblr, Vimeo, Kakao, Dribbble, Flickr, MeetUp, Line, Stackexchange, Livejournal, Snapchat, Foursquare, Teamsnap, Naver, Odnoklassniki, Wiebo, Baidu, Renren, QQ.</span><button style="border:transparent;background-color: transparent;color: tomato;" onclick="myFunction('mo_openid_dots4','mo_openid_more4','mo_openid_myBtn4')" id="mo_openid_myBtn4">Read more</button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">8 Pre-Configured Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;"> Google, Vkontakte, LinkedIn, Windows Live, Amazon, Salesforce, Yahoo, Wordpress</span></div></li>
                                        <li>Sharing Display Option</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li>Facebook Share Count</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li>Vertical Icons & Horizontal Icons</li>
                                        <li style="padding: 7.2%;" class="mo-openid-lic-bold-cl">X</li>
                                        <li>General Data Protection Regulation (GDPR)</li>
                                        <li>Google recaptcha</li>
                                        <li>BuddyPress Display Option</li>
                                        <li>Woocommerce Display Options</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li>Advance Account Linking</li>
                                        <li>Role Mapping</li>
                                        <li style="padding: 7.5%;" class="mo-openid-lic-bold-cl">X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li>Account Linking & Unlinking for Users</li>
                                        <li>Email notification to multiple admins</li>
                                        <li>Welcome Email to end users</li>
                                        <li>Customizable Email Notification template</li>
                                        <li>Customizable welcome Email template</li>
                                        <li>Custom CSS for Social Login buttons</li>
                                        <li>Social Login Opens in a New Window</li>
                                        <li>Domain restriction</li>
                                        <li>Force Admin To Login Using Password</li>
                                        <li>Send Username and Password Reset link</li>
                                        <li>Redirect Login To a New Window</li>
                                        <li>Disable Admin Bar</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>

                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li style="padding: 8%; font-weight:bold;">X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li>Shortcodes to display social icons on<br/>any homepage page, post, popup and php pages.</li>

                                        <li><a style="cursor: pointer" onclick="mo_openid_support_form('')">Click here to Contact Us</a></li>
                                    </ul>
                                </div> <!-- .mo-openid-cd-pricing-body -->
                            </li>
                            <li data-type="mo_add-on" class="moaslp is-hidden" style="">
                                <header class="mo-openid-cd-pricing-header">
                                    <h2 style="margin-bottom: 10%;">WooCommerce Integration Add-On</h2>
                                    <label for="mo_openid_wca_in">Select No. of Instances : </label>
                                    <select name="mo_openid_wca_in" id="mo_openid_wca_in">
                                        <option value="1">1</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                    </select>

                                    <div class="cd-price" style="margin-top: 9%;">
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_wca_in1" class="mo-openid-cd-value">25</span> &nbsp;&nbsp;
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_wca_in2" class="mo-openid-cd-value"><s>29</s></span>
                                    </div>
                                </header> <!-- .mo-openid-cd-pricing-header -->
                                <footer class="mo-openid-cd-pricing-footer">
                                    <a href="#" class="mo-openid-cd-select" onclick="mosocial_addonform('wp_social_login_woocommerce_addon')" >Upgrade Now</a>
                                </footer>
                                <div class="mo-openid-cd-pricing-body">
                                    <ul class="mo-openid-cd-pricing-features">
                                        <li>WooCommerce Display Options</li>
                                        <li><div class="mo_openid_tooltip" >WooCommerce Integration <i class="fa fa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext" style="width:100%;"> First name, last name and email are pre-filled in billing details of a user and on the Woocommerce checkout page. Social Login icons are displayed on the Woocommerce checkout page.</span></li>
                                        <li>Social Login on WooCommerce Login Page</li>
                                        <li>Social Login on WooCommerce Registration Page</li>
                                        <li>Social Login on WooCommerce Checkout Page</li>
                                        <li>Before WooCommerce Login Form</li>
                                        <li>Before 'Remember Me' of WooCommerce Login Form</li>
                                        <li>After WooCommerce Login Form</li>
                                        <li>Before WooCommerce Registration Form</li>
                                        <li>Before 'Register button' of WooCommerce Registration Form</li>
                                        <li>After WooCommerce Registration Form</li>
                                        <li>Before & After WooCommerce Checkout Form</li>
                                        <li><a style="cursor: pointer" onclick="mo_openid_support_form('')">Click here to Contact Us</a></li>
                                    </ul>
                                </div> <!-- .mo-openid-cd-pricing-body -->
                            </li>
                        </ul> <!-- .mo-openid-cd-pricing-wrapper -->
                    </li>

                    <li>
                        <ul class="mo-openid-cd-pricing-wrapper" id="col3">
                            <li data-type="singlesite" class="mosslp is-visible" style="">
                                <header class="mo-openid-cd-pricing-header">
                                    <h2 style="margin-bottom: 10%;">Premium</h2>
                                    <label for="mo_openid_pre">Select No. of Instances : </label>
                                    <select name="mo_openid_pre" id="mo_openid_pre">
                                        <option value="1">1</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                    </select>

                                    <div class="cd-price" style="margin-top: 9%;">
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_pre1" class="mo-openid-cd-value">49</span> &nbsp;&nbsp;
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_pre2" class="mo-openid-cd-value"><s>59</s></span>
                                    </div>
                                </header> <!-- .mo-openid-cd-pricing-header -->
                                <footer class="mo-openid-cd-pricing-footer">
                                    <a href="#" class="mo-openid-cd-select" onclick="mosocial_addonform('wp_social_login_premium_plan')" >Upgrade Now</a>
                                </footer>
                                <div class="mo-openid-cd-pricing-body">
                                    <ul class="mo-openid-cd-pricing-features">
                                        <li onclick="mo_all_features_clk()" style="cursor:pointer;" title="Click here for Feature list" class="mo_openid-on-hover-free-fetr"><b>All Free Features +</b></li>
                                        <li class="mo-openid-lic-bold-cl" style="color: red">X</li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">13 Social Sharing Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;"> Facebook, Twitter, Vkontakte, WhatsApp, Tunmblr, StumbleUpon, LinkedIn, Reddit, Pinterest, Pocket, Digg, Email, Print.<br></span></div></li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">42 Social Login Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;">Apple, Discord, Twitch, Line, Hubspot, Paypal, Github, Dropbox, Wechat, Google, Facebook, Twitter, Vkontakte, LinkedIn, Windows Live, Instagram, Amazon, Salesforce, Yahoo,<span id="mo_openid_dots6">...</span><span id="mo_openid_more6" style="display:none" > Wordpress, Mail.RU, Disqus, Pinterest, Yandex, Spotify, Reddit, Tumblr, Vimeo, Kakao, Dribbble, Flickr, MeetUp, Stackexchange, Livejournal, Snapchat, Foursquare, Teamsnap, Naver, Odnoklassniki, Wiebo, Baidu, Renren, QQ.</span><button style="border:transparent;background-color: transparent;color: tomato;" onclick="myFunction('mo_openid_dots6','mo_openid_more6','mo_openid_myBtn6')" id="mo_openid_myBtn6">Read more</button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">8 Pre-Configured Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;"> Google, Vkontakte, LinkedIn, Windows Live, Amazon, Salesforce, Yahoo, Wordpress</span></div></li>                                        <li>Sharing Display Option</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>

                                        <li>Facebook Share Count</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li>Vertical Icons & Horizontal Icons</li>
                                        <li class="mo-openid-lic-bold-cl" style="padding: 7.2%;">X</li>
                                        <li>White Backgound for Social Login Icons</li>
                                        <li>General Data Protection Regulation (GDPR)</li>
                                        <li>Google recaptcha</li>
                                        <li>BuddyPress Display Option</li>
                                        <li>Woocommerce Display Options</li>
                                        <li>Ultimate Member Display Option</li>
                                        <li>MemberPress Display Option</li>
                                        <li>Advance Account Linking</li>
                                        <li>Redirect After Login & Logout Option</li>
                                        <li>Role Mapping</li>
                                        <li>Restrict registration from specific pages</li>
                                        <li>Extended User Attribute</li>
                                        <li>User Moderation</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>

                                        <li>Account Linking & Unlinking for Users</li>
                                        <li>Email notification to multiple admins</li>
                                        <li>Welcome Email to end users</li>
                                        <li>Customizable Email Notification template</li>
                                        <li>Customizable welcome Email template</li>
                                        <li>Custom CSS for Social Login buttons</li>
                                        <li>Social Login Opens in a New Window</li>
                                        <li>Domain restriction</li>
                                        <li>Force Admin To Login Using Password</li>
                                        <li>Send Username and Password Reset link</li>
                                        <li>Redirect Login To a New Window</li>
                                        <li>Disable Admin Bar</li>
                                        <li><span class="mo_openid_tooltip">MemberPress Integration <i class="fa fa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext" style="width:100%;">Assign default levels or let users choose to set their levels provided by MemberPress to the users login using Social Login</span></li>

                                        <li><div class="mo_openid_tooltip" ><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/woocommerce.png" alt="wc" style="width:35px;height:20px;"> Woocommerce Integration  <i class="fa fa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext" style="width:100%;"> First name, last name and email are pre-filled in billing details of a user and on the Woocommerce checkout page. Social Login icons are displayed on the Woocommerce checkout page.</span></li>
                                        <li><span class="mo_openid_tooltip"><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/paidmember.png" alt="pmpro" style="width:35px;height:20px;">  Paid Membership pro Integration <i class="fa fa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext" style="width:100%;">Assign default levels or let users choose to set their levels provided by Paid Membership Pro to the users login using Social Login</span></li>
                                        <li><div class="mo_openid_tooltip" ><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/buddypress.png" alt="bp" style="width:35px;height:20px;"> BuddyPress Integration<i class="fa fa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;"> Extended attributes returned from social app are mapped to Custom BuddyPress fields. Profile picture from social media is mapped to Buddypress avatar.</span></li>
                                        <li><div class="mo_openid_tooltip" ><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/mailchimp_logo.png" alt="mc" style="width:35px;height:20px;"> MailChimp Integration <i class="fa fa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;">A user is added as a subscriber to a mailing list in MailChimp when that user registers using Social Login. First name, last name and email are also captured for that user in the Mailing List. Option is available to download csv file that has list of emails of all users in WordPress.</span></li>
                                        <li><div class="mo_openid_tooltip" >miniOrange OTP Integration<span style="color: red">*</span> <i class="fa fa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;">Verify your users via OTP on registration.</span></li>
                                        <li><span class="mo_openid_tooltip">Custom attribute mapping <i class="fa fa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext" style="width:100%;">Extended attributes returned from social app are mapped to Custom attributes created by admin. These Attributes get stored in user_meta.</span></li>
                                        <li><div class="mo_openid_tooltip" >Custom Integration <i class="fa fa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;"> If you have a specific custom requirement in the Social Login Plugin, we can implement and integrate it in the Plugin fo you. This includes all those custom features that come under the scope of Social Login/ Sharing/ Comments and impart additional value to the plugin. These features are chargeable. Please send us a query through the support forum to get in touch with us about your custom requirements.</span></div></li>

                                        <li>Shortcodes to display social icons on<br/>any homepage page, post, popup and php pages.</li>

                                        <li><a style="cursor: pointer" onclick="mo_openid_support_form('')">Click here to Contact Us</a></li>
                                    </ul>
                                </div> <!-- .mo-openid-cd-pricing-body -->
                            </li>
                            <li data-type="multisite" class="momslp is-hidden" style="">
                                <header class="mo-openid-cd-pricing-header">
                                    <h2 style="margin-bottom: 10%;">Premium</h2>
                                    <label for="mo_openid_m_prem">Select No. of Instances : </label>
                                    <select name="mo_openid_m_prem" id="mo_openid_m_prem" onchange="update_val_prem('mo_openid_m_prem','mo_openid_m_prem_sub','mo_openid_m_pre1','mo_openid_m_pre2')">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select><br/><br/>
                                    <label for="mo_openid_m_prem_sub">Select No. of Sub-Site : </label>
                                    <select name="mo_openid_m_prem_sub" id="mo_openid_m_prem_sub" onchange="update_val_prem('mo_openid_m_prem','mo_openid_m_prem_sub','mo_openid_m_pre1','mo_openid_m_pre2')">
                                        <option value="3">3</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                        <option value="300">300</option>
                                        <option value="400">400</option>
                                        <option value="500">500</option>
                                    </select>
                                    <div class="cd-price" style="margin-top: 9%;">
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_m_pre1" class="mo-openid-cd-value">122.5</span> &nbsp;&nbsp;
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_m_pre2" class="mo-openid-cd-value"><s>236</s></span>
                                    </div>
                                </header> <!-- .mo-openid-cd-pricing-header -->
                                <footer class="mo-openid-cd-pricing-footer">
<!--                                    <a href="#" class="mo-openid-cd-select" onclick="mosocial_addonform('wp_social_login_premium_plan')" >Upgrade Now</a>-->
                                    <a href="#" class="mo-openid-cd-select" onclick="mo_openid_support_form('wp_social_login_premium_plan')" >Contact us for more details</a>
                                </footer>
                                <div class="mo-openid-cd-pricing-body">
                                    <ul class="mo-openid-cd-pricing-features">
                                        <li onclick="mo_all_features_clk()" style="cursor:pointer;" title="Click here for Feature list" class="mo_openid-on-hover-free-fetr"><b>All Free Features +</b></li>
                                        <li class="mo-openid-lic-bold-cl" style="color: red">X</li>

                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">13 Social Sharing Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;"> Facebook, Twitter, Vkontakte, WhatsApp, Tunmblr, StumbleUpon, LinkedIn, Reddit, Pinterest, Pocket, Digg, Email, Print.<br></span></div></li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">42 Social Login Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;">Apple, Discord, Twitch, Line, Hubspot, Paypal, Github, Dropbox, Wechat, Google, Facebook, Twitter, Vkontakte, LinkedIn, Windows Live, Instagram, Amazon, Salesforce, Yahoo,<span id="mo_openid_dots6">...</span><span id="mo_openid_more6" style="display:none" > Wordpress, Mail.RU, Disqus, Pinterest, Yandex, Spotify, Reddit, Tumblr, Vimeo, Kakao, Dribbble, Flickr, MeetUp, Stackexchange, Livejournal, Snapchat, Foursquare, Teamsnap, Naver, Odnoklassniki, Wiebo, Baidu, Renren, QQ.</span><button style="border:transparent;background-color: transparent;color: tomato;" onclick="myFunction('mo_openid_dots6','mo_openid_more6','mo_openid_myBtn6')" id="mo_openid_myBtn6">Read more</button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">8 Pre-Configured Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;"> Google, Vkontakte, LinkedIn, Windows Live, Amazon, Salesforce, Yahoo, Wordpress</span></div></li>
                                        <li>Sharing Display Option</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li>Facebook Share Count</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li class="mo-openid-lic-bold-cl";>X</li>
                                        <li>Vertical Icons & Horizontal Icons</li>
                                        <li class="mo-openid-lic-bold-cl" style="padding: 7.2%; ">X</li>
                                        <li>General Data Protection Regulation (GDPR)</li>
                                        <li>Google recaptcha</li>
                                        <li>BuddyPress Display Option</li>
                                        <li>Woocommerce Display Options</li>
                                        <li>Ultimate Member Display Option</li>
                                        <li>MemberPress Display Options</li>
                                        <li>Advance Account Linking</li>
                                        <li>Role Mapping</li>
                                        <li>Restrict registration from specific pages</li>
                                        <li>Extended User Attribute</li>
                                        <li>User Moderation</li>
                                        <li class="mo-openid-lic-bold-cl">X</li>
                                        <li>Account Linking & Unlinking for Users</li>
                                        <li>Email notification to multiple admins</li>
                                        <li>Welcome Email to end users</li>
                                        <li>Customizable Email Notification template</li>
                                        <li>Customizable welcome Email template</li>
                                        <li>Custom CSS for Social Login buttons</li>
                                        <li>Social Login Opens in a New Window</li>
                                        <li>Domain restriction</li>
                                        <li>Force Admin To Login Using Password</li>
                                        <li>Send Username and Password Reset link</li>
                                        <li>Redirect Login To a New Window</li>
                                        <li>Disable Admin Bar</li>
                                        <li><span class="mo_openid_tooltip">MemberPress Integration <i class="fa fa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext" style="width:100%;">Assign default levels or let users choose to set their levels provided by MemberPress to the users login using Social Login</span></li>

                                        <li><div class="mo_openid_tooltip" ><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/woocommerce.png" alt="wc" style="width:35px;height:20px;"> Woocommerce Integration  <i class="fa fa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext" style="width:100%;"> First name, last name and email are pre-filled in billing details of a user and on the Woocommerce checkout page. Social Login icons are displayed on the Woocommerce checkout page.</span></li>
                                        <li><span class="mo_openid_tooltip"><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/paidmember.png" alt="pmpro" style="width:35px;height:20px;">  Paid Membership pro Integration <i class="fa fa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext" style="width:100%;">Assign default levels or let users choose to set their levels provided by Paid Membership Pro to the users login using Social Login</span></li>
                                        <li><div class="mo_openid_tooltip" ><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/buddypress.png" alt="bp" style="width:35px;height:20px;"> BuddyPress Integration<i class="fa fa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;"> Extended attributes returned from social app are mapped to Custom BuddyPress fields. Profile picture from social media is mapped to Buddypress avatar.</span></li>
                                        <li><div class="mo_openid_tooltip" ><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/mailchimp_logo.png" alt="mc" style="width:35px;height:20px;"> MailChimp Integration <i class="fa fa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;">A user is added as a subscriber to a mailing list in MailChimp when that user registers using Social Login. First name, last name and email are also captured for that user in the Mailing List. Option is available to download csv file that has list of emails of all users in WordPress.</span></li>
                                        <li><div class="mo_openid_tooltip" >miniOrange OTP Integration<span style="color: red">*</span> <i class="fa fa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;">Verify your users via OTP on registration.</span></li>
                                        <li><span class="mo_openid_tooltip">Custom attribute mapping <i class="fa fa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext" style="width:100%;">Extended attributes returned from social app are mapped to Custom attributes created by admin. These Attributes get stored in user_meta.</span></li>
                                        <li><div class="mo_openid_tooltip" >Custom Integration <i class="fa fa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;"> If you have a specific custom requirement in the Social Login Plugin, we can implement and integrate it in the Plugin fo you. This includes all those custom features that come under the scope of Social Login/ Sharing/ Comments and impart additional value to the plugin. These features are chargeable. Please send us a query through the support forum to get in touch with us about your custom requirements.</span></div></li>

                                        <li>Shortcodes to display social icons on<br/>any homepage page, post, popup and php pages.</li>

                                        <li><a style="cursor: pointer" onclick="mo_openid_support_form('')">Click here to Contact Us</a></li>
                                    </ul>
                                </div> <!-- .mo-openid-cd-pricing-body -->
                            </li>
                            <li data-type="mo_add-on" class="moaslp is-hidden" style="">
                                <a id="popover5" data-toggle="popover">
                                    <header class="mo-openid-cd-pricing-header">
                                        <h2 style="margin-bottom: 10%;">BuddyPress Integration Add-On</h2>
                                        <label for="mo_openid_bpa">Select No. of Instances : </label>
                                        <select name="mo_openid_bpa" id="mo_openid_bpa">
                                            <option value="1">1</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                        </select>

                                        <div class="cd-price" style="margin-top: 9%;">
                                            <span class="mo-openid-cd-currency">$</span>
                                            <span id="mo_openid_bpa1" class="mo-openid-cd-value">25</span> &nbsp;&nbsp;
                                            <span class="mo-openid-cd-currency">$</span>
                                            <span id="mo_openid_bpa2" class="mo-openid-cd-value"><s>29</s></span>
                                        </div>
                                    </header> <!-- .mo-openid-cd-pricing-header -->
                                </a>
                                <footer class="mo-openid-cd-pricing-footer">
                                    <a href="#" class="mo-openid-cd-select" onclick="mosocial_addonform('wp_social_login_buddypress_addon')" >Upgrade Now</a>
                                </footer>
                                <div class="mo-openid-cd-pricing-body">
                                    <ul class="mo-openid-cd-pricing-features">
                                        <li>Social Login for BuddyPress</li>
                                        <li><div class="mo_openid_tooltip" >BuddyPress Integration <i class="fa fa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;"> Extended attributes returned from social app are mapped to Custom BuddyPress fields. Profile picture from social media is mapped to Buddypress avatar.</span></li>
                                        <li>Before BuddyPress Registration Form</li>
                                        <li>Before BuddyPress Account Details</li>
                                        <li>After BuddyPress Registration Form</li>
                                        <li><a style="cursor: pointer" onclick="mo_openid_support_form('')">Click here to Contact Us</a></li>
                                    </ul>
                                </div> <!-- .mo-openid-cd-pricing-body -->
                            </li>
                        </ul> <!-- .mo-openid-cd-pricing-wrapper -->
                    </li>

                    <li class="mo-openid-cd-popular">
                        <ul class="mo-openid-cd-pricing-wrapper" id="col4">
                            <li data-type="singlesite" class="mosslp is-visible" style="">
                                <header class="mo-openid-cd-pricing-header">
                                    <h2 style="margin-bottom: 10%;">All-Inclusive</h2>
                                    <label for="mo_openid_ai">Select No. of Instances : </label>
                                    <select name="mo_openid_ai" id="mo_openid_ai">
                                        <option value="1">1</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                    </select>

                                    <div class="cd-price" style="margin-top: 9%;">
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_ai1" class="mo-openid-cd-value">89</span> &nbsp;&nbsp;
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_ai2" class="mo-openid-cd-value"><s>99</s></span>
                                    </div>
                                </header> <!-- .mo-openid-cd-pricing-header -->
                                <footer class="mo-openid-cd-pricing-footer">
                                    <a href="#" class="mo-openid-cd-select" onclick="mosocial_addonform('wp_social_login_all_inclusive')" >Upgrade Now</a>
                                </footer>
                                <div class="mo-openid-cd-pricing-body">
                                    <ul class="mo-openid-cd-pricing-features ">
                                        <li onclick="mo_all_features_clk()" style="cursor:pointer;"  title="Click here for Feature list" class="mo_openid-on-hover-free-fetr"><b>All Free Features +</b></li>
                                        <li onclick="mo_cus_feature_clk()" style="cursor:pointer;" title="Click here for Feature list" class="mo_openid-on-hover-free-fetr"><b>Custom Registration Form+</b></li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">45 Social Sharing Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;"> Facebook, Twitter, Vkontakte, WhatsApp, Tunmblr, StumbleUpon, LinkedIn, Reddit, Pinterest, Pocket, Digg, Email, Print.<span id="mo_openid_dots3">...</span><span id="mo_openid_more3" style="display:none" ><br>Buffer, Amazon_wishlist, Telegram, Line, Yahoo, Instapaper, Mewe, Livejournal, Mix, AOI Mail, Qzone, Gmail, Typepad_post, Fark, Bookmark, Fintel, Mendeley, Slashdot, Wanelo, Classroom, Yummly, Hacker_news, Kakao, Plurk, Trello, wykop, Weibo, Renren, Xing, Wordpress, Front it, Skype, Kindle It, Bloggerpost, Mail.ru, Papaly, Blogmarks, Twiddla.</span><button style="border:transparent;background-color: transparent;color: tomato;" onclick="myFunction('mo_openid_dots3','mo_openid_more3','mo_openid_myBtn3')" id="mo_openid_myBtn3">Read more</button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">43 Social Login Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;">Apple, Dropbox, Discord, Twitch, Line, Hubspot, Google, Facebook, Twitter, Vkontakte, LinkedIn, Windows Live, Instagram, Amazon, Salesforce, Yahoo.<span id="mo_openid_dots0">...</span><span id="mo_openid_more0" style="display:none" >Paypal, Wordpress, Github, Mail.RU, Disqus, Pinterest, Yandex, Spotify, Reddit, Tumblr, Vimeo, Kakao, Dribbble, Flickr, MeetUp, Stackexchange, Livejournal, Snapchat, Foursquare, Teamsnap, Naver, Odnoklassniki, Wiebo, Wechat, Baidu, Renren, QQ.</span><button style="border:transparent;background-color: transparent;color: tomato;" onclick="myFunction('mo_openid_dots0','mo_openid_more0','mo_openid_myBtn0')" id="mo_openid_myBtn0">Read more</button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">8 Pre-Configured Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;"> Google, Vkontakte, LinkedIn, Windows Live, Amazon, Salesforce, Yahoo, Wordpress</span></div></li>
                                        <li>Sharing Display Option</li>
                                        <li>Hover Icons & Floating Icons</li>
                                        <li>Discord Auto Post</li>
                                        <li>Sharing Icons for BBPress</li>
                                        <li>WooCommerce Product Sharing</li>
                                        <li>E-mail subscriber</li>
                                        <li>Facebook Share Count</li>
                                        <li>Facebook Like & Recommended</li>
                                        <li>Pinterest Pin it Button</li>
                                        <li>Twitter Follow Button</li>
                                        <li>Vertical Icons & Horizontal Icons</li>
                                        <li>Vkontakte, Stumble Upon, Buffer, Pinterest and Reddit Share Count</li>
                                        <li>White Backgound for Social Login Icons</li>
                                        <li>General Data Protection Regulation (GDPR)</li>
                                        <li>Google recaptcha</li>
                                        <li>BuddyPress Display Option</li>
                                        <li>Woocommerce Display Options</li>
                                        <li>Ultimate Member Display Option</li>
                                        <li>MemberPress Display Options</li>
                                        <li>Advance Account Linking</li>
                                        <li>Redirect After Login & Logout Option</li>
                                        <li>Role Mapping</li>
                                        <li>Restrict registration from specific pages</li>
                                        <li>Extended User Attribute</li>
                                        <li>User Moderation</li>
                                        <li>Report (Basic Data Analytics)</li>
                                        <li>Account Linking & Unlinking for Users</li>
                                        <li>Email notification to multiple admins</li>
                                        <li>Welcome Email to end users</li>
                                        <li>Customizable Email Notification template</li>
                                        <li>Customizable welcome Email template</li>
                                        <li>Custom CSS for Social Login buttons</li>
                                        <li>Social Login Opens in a New Window</li>
                                        <li>Domain restriction</li>
                                        <li>Force Admin To Login Using Password</li>
                                        <li>Send Username and Password Reset link</li>
                                        <li>Redirect Login To a New Window</li>
                                        <li>Disable Admin Bar</li>
                                        <li><span class="mo_openid_tooltip">MemberPress Integration <i class="fa fa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext" style="width:100%;">Assign default levels or let users choose to set their levels provided by MemberPress to the users login using Social Login</span></li>
                                        <li><div class="mo_openid_tooltip" ><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/woocommerce.png" alt="wc" style="width:35px;height:20px;"> Woocommerce Integration  <i class="fa fa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext" style="width:100%;"> First name, last name and email are pre-filled in billing details of a user and on the Woocommerce checkout page. Social Login icons are displayed on the Woocommerce checkout page.</span></li>
                                        <li><span class="mo_openid_tooltip"><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/paidmember.png" alt="pmpro" style="width:35px;height:20px;">  Paid Membership pro Integration <i class="fa fa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext" style="width:100%;">Assign default levels or let users choose to set their levels provided by Paid Membership Pro to the users login using Social Login</span></li>
                                        <li><div class="mo_openid_tooltip" ><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/buddypress.png" alt="bp" style="width:35px;height:20px;"> BuddyPress Integration<i class="fa fa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;"> Extended attributes returned from social app are mapped to Custom BuddyPress fields. Profile picture from social media is mapped to Buddypress avatar.</span></li>
                                        <li><div class="mo_openid_tooltip" ><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/mailchimp_logo.png" alt="mc" style="width:35px;height:20px;"> MailChimp Integration <i class="fa fa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;">A user is added as a subscriber to a mailing list in MailChimp when that user registers using Social Login. First name, last name and email are also captured for that user in the Mailing List. Option is available to download csv file that has list of emails of all users in WordPress.</span></li>
                                        <li><div class="mo_openid_tooltip" >miniOrange OTP Integration<span style="color: red">*</span> <i class="fa fa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;">Verify your users via OTP on registration.</span></li>
                                        <li><span class="mo_openid_tooltip">Custom attribute mapping <i class="fa fa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext" style="width:100%;">Extended attributes returned from social app are mapped to Custom attributes created by admin. These Attributes get stored in user_meta.</span></li>
                                        <li><div class="mo_openid_tooltip" >Custom Integration <i class="fa fa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;"> If you have a specific custom requirement in the Social Login Plugin, we can implement and integrate it in the Plugin fo you. This includes all those custom features that come under the scope of Social Login/ Sharing/ Comments and impart additional value to the plugin. These features are chargeable. Please send us a query through the support forum to get in touch with us about your custom requirements.</span></div></li>
                                        <li>Shortcodes to display social icons on<br/>any homepage page, post, popup and php pages.</li>

                                        <li><a style="cursor: pointer" onclick="mo_openid_support_form('')">Click here to Contact Us</a></li>
                                    </ul>
                                </div> <!-- .mo-openid-cd-pricing-body -->
                            </li>
                            <li data-type="multisite" class="momslp is-hidden style="">
                                <header class="mo-openid-cd-pricing-header">
                                    <h2 style="margin-bottom: 10%;">All-Inclusive</h2>
                                    <label for="mo_openid_m_ai">Select No. of Instances : </label>
                                    <select name="mo_openid_m_ai" id="mo_openid_m_ai" onchange="update_val_allinc('mo_openid_m_ai','mo_openid_m_ai_prem_sub','mo_openid_m_ai1','mo_openid_m_ai2')">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select><br/><br/>
                                    <label for="mo_openid_m_ai_sub">Select No. of Sub-Site : </label>
                                    <select name="mo_openid_m_ai_sub" id="mo_openid_m_ai_prem_sub" onchange="update_val_allinc('mo_openid_m_ai','mo_openid_m_ai_prem_sub','mo_openid_m_ai1','mo_openid_m_ai2')">
                                        <option value="3">3</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                        <option value="300">300</option>
                                        <option value="400">400</option>
                                        <option value="500">500</option>
                                    </select>

                                    <div class="cd-price" style="margin-top: 9%;">
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_m_ai1" class="mo-openid-cd-value">222.5</span> &nbsp;&nbsp;
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_m_ai2" class="mo-openid-cd-value"><s>396</s></span>
                                    </div>
                                </header> <!-- .mo-openid-cd-pricing-header -->
                                <footer class="mo-openid-cd-pricing-footer">
<!--                                    <a href="#" class="mo-openid-cd-select" onclick="mosocial_addonform('wp_social_login_all_inclusive')" >Upgrade Now</a>-->
                                    <a href="#" class="mo-openid-cd-select" onclick="mo_openid_support_form('wp_social_login_all_inclusive')" >Contact us for more details</a>
                                </footer>
                                <div class="mo-openid-cd-pricing-body">
                                    <ul class="mo-openid-cd-pricing-features ">
                                        <li onclick="mo_all_features_clk()" style="cursor:pointer;" title="Click here for Feature list" class="mo_openid-on-hover-free-fetr"><b>All Free Features +</b></li>
                                        <li onclick="mo_cus_feature_clk()" style="cursor:pointer;" title="Click here for Feature list" class="mo_openid-on-hover-free-fetr"><b>Custom Registration Form+</b></li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">45 Social Sharing Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;"> Facebook, Twitter, Vkontakte, WhatsApp, Tunmblr, StumbleUpon, LinkedIn, Reddit, Pinterest, Pocket, Digg, Email, Print.<span id="mo_openid_dots2">...</span><span id="mo_openid_more2" style="display:none" ><br>Buffer, Amazon_wishlist, Telegram, Line, Yahoo, Instapaper, Mewe, Livejournal, Mix, AOI Mail, Qzone, Gmail, Typepad_post, Fark, Bookmark, Fintel, Mendeley, Slashdot, Wanelo, Classroom, Yummly, Hacker_news, Kakao, Plurk, Trello, wykop, Weibo, Renren, Xing, Wordpress, Front it, Skype, Kindle It, Bloggerpost, Mail.ru, Papaly, Blogmarks, Twiddla.</span><button style="border:transparent;background-color: transparent;color: tomato;" onclick="myFunction('mo_openid_dots2','mo_openid_more2','mo_openid_myBtn2')" id="mo_openid_myBtn2">Read more</button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">43 Social Login Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;">Apple, Dropbox, Discord, Twitch, Line, Hubspot, Google, Facebook, Twitter, Vkontakte, LinkedIn, Windows Live, Instagram, Amazon, Salesforce, Yahoo.<span id="mo_openid_dots8">...</span><span id="mo_openid_more8" style="display:none" >Paypal, Wordpress, Github, Mail.RU, Disqus, Pinterest, Yandex, Spotify, Reddit, Tumblr, Vimeo, Kakao, Dribbble, Flickr, MeetUp, Stackexchange, Livejournal, Snapchat, Foursquare, Teamsnap, Naver, Odnoklassniki, Wiebo, Wechat, Baidu, Renren, QQ.</span><button style="border:transparent;background-color: transparent;color: tomato;" onclick="myFunction('mo_openid_dots8','mo_openid_more8','mo_openid_myBtn8')" id="mo_openid_myBtn8">Read more</button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="mo_openid_tooltip" style="padding-left: 40px;">8 Pre-Configured Apps <i class="fa fa-commenting " style="font-size:18px; color:#85929E"></i><span class="mo_openid_tooltiptext" style="width:100%;"> Google, Vkontakte, LinkedIn, Windows Live, Amazon, Salesforce, Yahoo, Wordpress</span></div></li>
                                        <li>Sharing Display Option</li>
                                        <li>Hover Icons & Floating Icons</li>
                                        <li>Discord Auto Post</li>
                                        <li>Sharing Icons for BBPress</li>
                                        <li>WooCommerce Product Sharing</li>
                                        <li>E-mail subscriber</li>
                                        <li>Facebook Share Count</li>
                                        <li>Facebook Like & Recommended</li>
                                        <li>Pinterest Pin it Button</li>
                                        <li>Twitter Follow Button</li>
                                        <li>Vertical Icons & Horizontal Icons</li>
                                        <li>Vkontakte, Stumble Upon, Buffer, Pinterest and Reddit Share Count</li>
                                        <li>General Data Protection Regulation (GDPR)</li>
                                        <li>Google recaptcha</li>
                                        <li>BuddyPress Display Option</li>
                                        <li>Woocommerce Display Options</li>
                                        <li>Ultimate Member Display Option</li>
                                        <li>MemberPress Display Options</li>
                                        <li>Advance Account Linking</li>
                                        <li>Role Mapping</li>
                                        <li>Restrict registration from specific pages</li>
                                        <li>Extended User Attribute</li>
                                        <li>User Moderation</li>
                                        <li>Report (Basic Data Analytics)</li>
                                        <li>Account Linking & Unlinking for Users</li>
                                        <li>Email notification to multiple admins</li>
                                        <li>Welcome Email to end users</li>
                                        <li>Customizable Email Notification template</li>
                                        <li>Customizable welcome Email template</li>
                                        <li>Custom CSS for Social Login buttons</li>
                                        <li>Social Login Opens in a New Window</li>
                                        <li>Domain restriction</li>
                                        <li>Force Admin To Login Using Password</li>
                                        <li>Send Username and Password Reset link</li>
                                        <li>Redirect Login To a New Window</li>
                                        <li>Disable Admin Bar</li>
                                        <li><span class="mo_openid_tooltip">MemberPress Integration <i class="fa fa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext" style="width:100%;">Assign default levels or let users choose to set their levels provided by MemberPress to the users login using Social Login</span></li>
                                        <li><div class="mo_openid_tooltip" ><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/woocommerce.png" alt="wc" style="width:35px;height:20px;"> Woocommerce Integration  <i class="fa fa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext" style="width:100%;"> First name, last name and email are pre-filled in billing details of a user and on the Woocommerce checkout page. Social Login icons are displayed on the Woocommerce checkout page.</span></li>
                                        <li><span class="mo_openid_tooltip"><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/paidmember.png" alt="pmpro" style="width:35px;height:20px;">  Paid Membership pro Integration <i class="fa fa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext" style="width:100%;">Assign default levels or let users choose to set their levels provided by Paid Membership Pro to the users login using Social Login</span></li>
                                        <li><div class="mo_openid_tooltip" ><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/buddypress.png" alt="bp" style="width:35px;height:20px;"> BuddyPress Integration<i class="fa fa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;"> Extended attributes returned from social app are mapped to Custom BuddyPress fields. Profile picture from social media is mapped to Buddypress avatar.</span></li>
                                        <li><div class="mo_openid_tooltip" ><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/mailchimp_logo.png" alt="mc" style="width:35px;height:20px;"> MailChimp Integration <i class="fa fa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;">A user is added as a subscriber to a mailing list in MailChimp when that user registers using Social Login. First name, last name and email are also captured for that user in the Mailing List. Option is available to download csv file that has list of emails of all users in WordPress.</span></li>
                                        <li><div class="mo_openid_tooltip" >miniOrange OTP Integration<span style="color: red">*</span> <i class="fa fa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;">Verify your users via OTP on registration.</span></li>
                                        <li><span class="mo_openid_tooltip">Custom attribute mapping <i class="fa fa-commenting" style="font-size:18px;color:#85929E"></i> <span class="mo_openid_tooltiptext" style="width:100%;">Extended attributes returned from social app are mapped to Custom attributes created by admin. These Attributes get stored in user_meta.</span></li>
                                        <li><div class="mo_openid_tooltip" >Custom Integration <i class="fa fa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;"> If you have a specific custom requirement in the Social Login Plugin, we can implement and integrate it in the Plugin fo you. This includes all those custom features that come under the scope of Social Login/ Sharing/ Comments and impart additional value to the plugin. These features are chargeable. Please send us a query through the support forum to get in touch with us about your custom requirements.</span></div></li>
                                        <li>Shortcodes to display social icons on<br/>any homepage page, post, popup and php pages.</li>
                                        <li><a style="cursor: pointer" onclick="mo_openid_support_form('')">Click here to Contact Us</a></li>
                                    </ul>
                                </div> <!-- .mo-openid-cd-pricing-body -->
                            </li>
                            <li data-type="mo_add-on" class="moaslp is-hidden" style="">
                                <header class="mo-openid-cd-pricing-header">
                                    <h2 style="margin-bottom: 10%;">HubSpot Integration Add-on</h2>
                                    <label for="mo_openid_hub">Select No. of Instances : </label>
                                    <select name="mo_openid_hub" id="mo_openid_hub">
                                        <option value="1">1</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                    </select>
                                    <div class="cd-price" style="margin-top: 9%;">
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_hub1" class="mo-openid-cd-value">45</span> &nbsp;&nbsp;
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_hub2" class="mo-openid-cd-value"><s>59</s></span>
                                    </div>
                                </header>
                                <footer class="mo-openid-cd-pricing-footer">
                                    <a href="#" class="mo-openid-cd-select" onclick="mosocial_addonform('wp_social_login_hubspot_addon')" >Upgrade Now</a>
                                </footer>
                                <div class="mo-openid-cd-pricing-body">
                                    <ul class="mo-openid-cd-pricing-features">
                                        <li>Add a new contact list in Hubspot</li>
                                        <li>Can be used with any Social Login Application</li>
                                        <li><a style="cursor: pointer" onclick="mo_openid_support_form('')">Click here to Contact Us</a></li>
                                    </ul>
                                </div>
                            </li>
                            <br><br>
                            <li data-type="mo_add-on" class="moaslp is-hidden">
                                <header class="mo-openid-cd-pricing-header">
                                    <h2 style="margin-bottom: 10%;">MailChimp Integration Add-on</h2>
                                    <label for="mo_openid_mca">Select No. of Instances : </label>
                                    <select name="mo_openid_mca" id="mo_openid_mca">
                                        <option value="1">1</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                    </select>

                                    <div class="cd-price" style="margin-top: 9%;">
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_mca1" class="mo-openid-cd-value">25</span> &nbsp;&nbsp;
                                        <span class="mo-openid-cd-currency">$</span>
                                        <span id="mo_openid_mca2" class="mo-openid-cd-value"><s>29</s></span>
                                    </div>
                                </header> <!-- .mo-openid-cd-pricing-header -->
                                <footer class="mo-openid-cd-pricing-footer">
                                    <a href="#" class="mo-openid-cd-select" onclick="mosocial_addonform('wp_social_login_mailchimp_addon')" >Upgrade Now</a>
                                </footer>
                                <div class="mo-openid-cd-pricing-body">
                                    <ul class="mo-openid-cd-pricing-features">
                                        <li><div class="mo_openid_tooltip" ><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__)));?>includes/images/mailchimp_logo.png" style="width:35px;height:20px;"> MailChimp Integration <i class="fa fa-commenting " style="font-size:18px;color:#85929E"> </i><span class="mo_openid_tooltiptext" style="width:100%;">A user is added as a subscriber to a mailing list in MailChimp when that user registers using Social Login. First name, last name and email are also captured for that user in the Mailing List. Option is available to download csv file that has list of emails of all users in WordPress.</span></li>
                                        <li><a style="cursor: pointer" onclick="mo_openid_support_form('')">Click here to Contact Us</a></li>
                                    </ul>
                                </div> <!-- .mo-openid-cd-pricing-body -->
                            </li>

                        </ul> <!-- .mo-openid-cd-pricing-wrapper -->
                    </li>

                </ul> <!-- .mo-openid-cd-pricing-list -->
            </div>
        </div>

    </div>

    <script>

        //apple plan
        jQuery('#mo_openid_ap').on('change', function () {
            if (this.value === "1") {
                jQuery('#mo_openid_ap1').html("25");
                jQuery('#mo_openid_ap2').html("<s>29</s>");
            } else if (this.value === "5") {
                jQuery('#mo_openid_ap1').html("89");
                jQuery('#mo_openid_ap2').html("<s>145</s>");
            }
            else if (this.value === "10") {
                jQuery('#mo_openid_ap1').html("149");
                jQuery('#mo_openid_ap2').html("<s>290</s>");
            }
        });

        //hubspot addon
        jQuery('#mo_openid_hub').on('change', function () {
            if (this.value === "1") {
                jQuery('#mo_openid_hub1').html("45");
                jQuery('#mo_openid_hub2').html("<s>59</s>");
            } else if (this.value === "5") {
                jQuery('#mo_openid_hub1').html("149");
                jQuery('#mo_openid_hub2').html("<s>295</s>");
            }
            else if (this.value === "10") {
                jQuery('#mo_openid_hub1').html("249");
                jQuery('#mo_openid_hub2').html("<s>590</s>");
            }
        });

        //custom registration add on
        jQuery('#mo_openid_cra').on('change', function () {
            if (this.value === "1") {
                jQuery('#mo_openid_cra1').html("35");
                jQuery('#mo_openid_cra2').html("<s>39</s>");
            } else if (this.value === "5") {
                jQuery('#mo_openid_cra1').html("119");
                jQuery('#mo_openid_cra2').html("<s>195</s>");
            }
            else if (this.value === "10") {
                jQuery('#mo_openid_cra1').html("179");
                jQuery('#mo_openid_cra2').html("<s>390</s>");
            }
        });

        //standard plan
        jQuery('#mo_openid_std').on('change', function () {
            if (this.value === "1") {
                jQuery('#mo_openid_std1').html("29");
                jQuery('#mo_openid_std2').html("<s>39</s>");
            } else if (this.value === "5") {
                jQuery('#mo_openid_std1').html("99");
                jQuery('#mo_openid_std2').html("<s>195</s>");
            }
            else if (this.value === "10") {
                jQuery('#mo_openid_std1').html("169");
                jQuery('#mo_openid_std2').html("<s>390</s>");
            }
        });

        //standard plan for multisite
        function update_val_std(no_of_ins, no_of_sub_sites, value, actual_value){
            no_of_sites=document.getElementById(no_of_ins).value;
            no_of_sub=document.getElementById(no_of_sub_sites).value;
            if(no_of_sites==1)
            {
                jQuery('#' + value).html(29+(29 * (no_of_sub / 2)));
                no_of_sub=parseInt(no_of_sub) +1;
                jQuery('#' + actual_value).html("<s>"+39 * no_of_sub +"</s>");
            }
            else if(no_of_sites==2)
            {
                jQuery('#' + value).html(55+(55 * (no_of_sub / 2)));
                no_of_sub=parseInt(no_of_sub) +1;
                jQuery('#' + actual_value).html("<s>"+78 * no_of_sub+"</s>");
            }
            else if(no_of_sites==3)
            {
                jQuery('#' + value).html(80+(80 * (no_of_sub / 2)));
                no_of_sub=parseInt(no_of_sub) +1;
                jQuery('#' + actual_value).html("<s>"+117 * no_of_sub+"</s>");
            }
            else if(no_of_sites==4)
            {
                jQuery('#' + value).html(90+(90 * (no_of_sub / 2)));
                no_of_sub=parseInt(no_of_sub) +1;
                jQuery('#' + actual_value).html("<s>"+156 * no_of_sub+"</s>");
            }
            else if(no_of_sites==5)
            {
                jQuery('#' + value).html(99+(99 * (no_of_sub / 2)));
                no_of_sub=parseInt(no_of_sub) +1;
                jQuery('#' + actual_value).html("<s>"+195 * no_of_sub+"</s>");
            }
        }

        //sharing plan for multisite
        function update_val_share(no_of_ins, no_of_sub_sites, value, actual_value){
            no_of_sites=document.getElementById(no_of_ins).value;
            no_of_sub=document.getElementById(no_of_sub_sites).value;
            if(no_of_sites==1)
            {
                jQuery('#' + value).html(19+(19 * (no_of_sub / 2)));
                no_of_sub=parseInt(no_of_sub) +1;
                jQuery('#' + actual_value).html("<s>"+29 * no_of_sub +"</s>");
            }
            else if(no_of_sites==2)
            {
                jQuery('#' + value).html(35+(35 * (no_of_sub / 2)));
                no_of_sub=parseInt(no_of_sub) +1;
                jQuery('#' + actual_value).html("<s>"+58 * no_of_sub+"</s>");
            }
            else if(no_of_sites==3)
            {
                jQuery('#' + value).html(49+(49 * (no_of_sub / 2)));
                no_of_sub=parseInt(no_of_sub) +1;
                jQuery('#' + actual_value).html("<s>"+87 * no_of_sub+"</s>");
            }
            else if(no_of_sites==4)
            {
                jQuery('#' + value).html(55+(55 * (no_of_sub / 2)));
                no_of_sub=parseInt(no_of_sub) +1;
                jQuery('#' + actual_value).html("<s>"+116 * no_of_sub+"</s>");
            }
            else if(no_of_sites==5)
            {
                jQuery('#' + value).html(59+(59 * (no_of_sub / 2)));
                no_of_sub=parseInt(no_of_sub) +1;
                jQuery('#' + actual_value).html("<s>"+145 * no_of_sub+"</s>");
            }
        }

        //woocommerce addon/plan
        jQuery('#mo_openid_wca_in').on('change', function () {
            if (this.value === "1") {
                jQuery('#mo_openid_wca_in1').html("25");
                jQuery('#mo_openid_wca_in2').html("<s>29</s>");
            } else if (this.value === "5") {
                jQuery('#mo_openid_wca_in1').html("89");
                jQuery('#mo_openid_wca_in2').html("<s>149</s>");
            }
            else if (this.value === "10") {
                jQuery('#mo_openid_wca_in1').html("149");
                jQuery('#mo_openid_wca_in2').html("<s>290</s>");
            }
        });

        //premium plugin
        jQuery('#mo_openid_pre').on('change', function () {
            if (this.value === "1") {
                jQuery('#mo_openid_pre1').html("49");
                jQuery('#mo_openid_pre2').html("<s>59</s>");
            } else if (this.value === "5") {
                jQuery('#mo_openid_pre1').html("149");
                jQuery('#mo_openid_pre2').html("<s>295</s>");
            }
            else if (this.value === "10") {
                jQuery('#mo_openid_pre1').html("199");
                jQuery('#mo_openid_pre2').html("<s>590</s>");
            }
        });

        //premium for multisite
        function update_val_prem(no_of_ins, no_of_sub_sites, value, actual_value){
            no_of_sites=document.getElementById(no_of_ins).value;
            no_of_sub=document.getElementById(no_of_sub_sites).value;
            if(no_of_sites==1)
            {
                jQuery('#' + value).html(49+(49 * (no_of_sub / 2)));
                no_of_sub=parseInt(no_of_sub) +1;
                jQuery('#' + actual_value).html("<s>"+59 * no_of_sub +"</s>");
            }
            else if(no_of_sites==2)
            {
                jQuery('#' + value).html(90+(90 * (no_of_sub / 2)));
                no_of_sub=parseInt(no_of_sub) +1;
                jQuery('#' + actual_value).html("<s>"+118 * no_of_sub+"</s>");
            }
            else if(no_of_sites==3)
            {
                jQuery('#' + value).html(125+(125 * (no_of_sub / 2)));
                no_of_sub=parseInt(no_of_sub) +1;
                jQuery('#' + actual_value).html("<s>"+177 * no_of_sub+"</s>");
            }
            else if(no_of_sites==4)
            {
                jQuery('#' + value).html(139+(139 * (no_of_sub / 2)));
                no_of_sub=parseInt(no_of_sub) +1;
                jQuery('#' + actual_value).html("<s>"+236 * no_of_sub+"</s>");
            }
            else if(no_of_sites==5)
            {
                jQuery('#' + value).html(149+(149 * (no_of_sub / 2)));
                no_of_sub=parseInt(no_of_sub) +1;
                jQuery('#' + actual_value).html("<s>"+295 * no_of_sub+"</s>");
            }
        }

        //buddypress addon/plan
        jQuery('#mo_openid_bpa').on('change', function () {
            if (this.value === "1") {
                jQuery('#mo_openid_bpa1').html("25");
                jQuery('#mo_openid_bpa2').html("<s>29</s>");
            } else if (this.value === "5") {
                jQuery('#mo_openid_bpa1').html("89");
                jQuery('#mo_openid_bpa2').html("<s>149</s>");
            }
            else if (this.value === "10") {
                jQuery('#mo_openid_bpa1').html("149");
                jQuery('#mo_openid_bpa2').html("<s>290</s>");
            }
        });

        //all-inclusive plan
        jQuery('#mo_openid_ai').on('change', function () {
            if (this.value === "1") {
                jQuery('#mo_openid_ai1').html("89");
                jQuery('#mo_openid_ai2').html("<s>99</s>");
            } else if (this.value === "5") {
                jQuery('#mo_openid_ai1').html("299");
                jQuery('#mo_openid_ai2').html("<s>495</s>");
            }
            else if (this.value === "10") {
                jQuery('#mo_openid_ai1').html("449");
                jQuery('#mo_openid_ai2').html("<s>990</s>");
            }
        });

        //all-inclusive plan for multisite
        function update_val_allinc(no_of_ins, no_of_sub_sites, value, actual_value){
            no_of_sites=document.getElementById(no_of_ins).value;
            no_of_sub=document.getElementById(no_of_sub_sites).value;
            if(no_of_sites==1)
            {
                jQuery('#' + value).html(89+(89 * (no_of_sub / 2)));
                no_of_sub=parseInt(no_of_sub) +1;
                jQuery('#' + actual_value).html("<s>"+99 * no_of_sub +"</s>");
            }
            else if(no_of_sites==2)
            {
                jQuery('#' + value).html(170+(170 * (no_of_sub / 2)));
                no_of_sub=parseInt(no_of_sub) +1;
                jQuery('#' + actual_value).html("<s>"+198 * no_of_sub+"</s>");
            }
            else if(no_of_sites==3)
            {
                jQuery('#' + value).html(240+(240 * (no_of_sub / 2)));
                no_of_sub=parseInt(no_of_sub) +1;
                jQuery('#' + actual_value).html("<s>"+297 * no_of_sub+"</s>");
            }
            else if(no_of_sites==4)
            {
                jQuery('#' + value).html(270+(270 * (no_of_sub / 2)));
                no_of_sub=parseInt(no_of_sub) +1;
                jQuery('#' + actual_value).html("<s>"+396 * no_of_sub+"</s>");
            }
            else if(no_of_sites==5)
            {
                jQuery('#' + value).html(299+(299 * (no_of_sub / 2)));
                no_of_sub=parseInt(no_of_sub) +1;
                jQuery('#' + actual_value).html("<s>"+495 * no_of_sub+"</s>");
            }
        }

        //mailchimp addon
        jQuery('#mo_openid_mca').on('change', function () {
            if (this.value === "1") {
                jQuery('#mo_openid_mca1').html("25");
                jQuery('#mo_openid_mca2').html("<s>29</s>");
            } else if (this.value === "5") {
                jQuery('#mo_openid_mca1').html("89");
                jQuery('#mo_openid_mca2').html("<s>149</s>");
            }
            else if (this.value === "10") {
                jQuery('#mo_openid_mca1').html("149");
                jQuery('#mo_openid_mca2').html("<s>290</s>");
            }
        });

        //social sharing plan
        jQuery('#mo_openid_ss').on('change', function () {
            if (this.value === "1") {
                jQuery('#mo_openid_ss1').html("19");
                jQuery('#mo_openid_ss2').html("<s>25</s>");
            } else if (this.value === "5") {
                jQuery('#mo_openid_ss1').html("45");
                jQuery('#mo_openid_ss2').html("<s>125</s>");
            }
            else if (this.value === "10") {
                jQuery('#mo_openid_ss1').html("99");
                jQuery('#mo_openid_ss2').html("<s>250</s>");
            }
        });

        //social sharing for multisite
        jQuery('#mo_openid_ssm').on('change', function () {
            if (this.value === "1") {
                jQuery('#mo_openid_ssm1').html("19");
                jQuery('#mo_openid_ssm2').html("<s>25</s>");
            } else if (this.value === "5") {
                jQuery('#mo_openid_ssm1').html("45");
                jQuery('#mo_openid_ssm2').html("<s>125</s>");
            }
            else if (this.value === "10") {
                jQuery('#mo_openid_ssm1').html("99");
                jQuery('#mo_openid_ssm2').html("<s>250</s>");
            }
        });

        //var x="<?php //echo get_option('mo_openid_extension_tab'); ?>//";
        //if(x==1){
        //    document.getElementById('singlesite').checked= false;
        //    //document.getElementById('multisite').checked= true;
        //     document.getElementById('mo_add-on').checked= true;
        //}
        var card1 = document.getElementById('col1');
        var card2= document.getElementById('col2');
        var card3= document.getElementById('col3');
        var card4= document.getElementById('col4');

        document.getElementById('multisite').addEventListener('click', function() {
            card1.classList.toggle('flipped');
            card2.classList.toggle('flipped');
            card3.classList.toggle('flipped');
            card4.classList.toggle('flipped');
        }, false);

        document.getElementById('mo_add-on').addEventListener('click', function() {
            card1.classList.toggle('flipped');
            card2.classList.toggle('flipped');
            card3.classList.toggle('flipped');
            card4.classList.toggle('flipped');
        }, false);

        document.getElementById('singlesite').addEventListener('click', function() {
            card1.classList.toggle('flipped');
            card2.classList.toggle('flipped');
            card3.classList.toggle('flipped');
            card4.classList.toggle('flipped');
        }, false);
    </script>
    <script>
        jQuery("input[name=sitetype]:radio").change(function() {
            if (this.value == 'multisite') {
                document.getElementById("list-type").style.width = "100%";
                jQuery('.mosslp').removeClass('is-visible').addClass('is-hidden');
                jQuery('.moaslp').removeClass('is-visible').addClass('is-hidden');
                jQuery('.momslp').addClass('is-visible').removeClass('is-hidden is-selected');
                jQuery('#mo_switcher_2').removeClass('mo-open-id-cd-switch-2');
                jQuery('#mo_switcher_1').addClass('mo-open-id-cd-switch');
                jQuery('#mo_apple_plan').hide();
            }
            else if(this.value=='singlesite'){
                document.getElementById("list-type").style.width = "100%";
                jQuery('.mosslp').addClass('is-visible').removeClass('is-hidden');
                jQuery('.momslp').removeClass('is-visible').addClass('is-hidden is-selected');
                jQuery('.moaslp').removeClass('is-visible').addClass('is-hidden is-selected');
                jQuery('#mo_apple_plan').show();
            }
            else if(this.value=='mo_add-on'){
                document.getElementById("list-type").style.width = "100%";
                jQuery('.moaslp').addClass('is-visible').removeClass('is-hidden');
                jQuery('.momslp').removeClass('is-visible').addClass('is-hidden is-selected');
                jQuery('.mosslp').removeClass('is-visible').addClass('is-hidden is-selected');
                jQuery('#mo_switcher_1').removeClass('mo-open-id-cd-switch');
                jQuery('#mo_switcher_2').addClass('mo-open-id-cd-switch-2');
                jQuery('#mo_apple_plan').hide();
            }
        });

        jQuery(document).ready(function($){
            var x="<?php echo get_option('mo_openid_extension_tab'); ?>";
            if(x==1){
                document.getElementById('singlesite').checked= false;
                document.getElementById('mo_add-on').checked= true;
                jQuery('#mo_apple_plan').hide();
            }
            if(document.getElementById("mo_add-on").checked == true){
                jQuery('.mosslp').removeClass('is-visible').addClass('is-hidden');
                jQuery('.momslp').removeClass('is-visible').addClass('is-hidden');
                jQuery('.moaslp').addClass('is-visible').removeClass('is-hidden is-selected');
                jQuery('#mo_switcher_1').removeClass('mo-open-id-cd-switch');
                jQuery('#mo_switcher_2').addClass('mo-open-id-cd-switch-2');
            }

            //switch from monthly to annual pricing tables
            bouncy_filter($('.cd-pricing-container'));

            function bouncy_filter(container) {
                container.each(function(){
                    var pricing_table = $(this);
                    var filter_list_container = pricing_table.children('.cd-pricing-switcher'),
                        filter_radios = filter_list_container.find('input[type="radio"]'),
                        pricing_table_wrapper = pricing_table.find('.mo-openid-cd-pricing-wrapper');

                    //store pricing table items
                    var table_elements = {};
                    filter_radios.each(function(){
                        var filter_type = $(this).val();
                        table_elements[filter_type] = pricing_table_wrapper.find('li[data-type="'+filter_type+'"]');
                    });

                    //detect input change event
                    filter_radios.on('change', function(event){
                        event.preventDefault();
                        //detect which radio input item was checked
                        var selected_filter = $(event.target).val();

                        //give higher z-index to the pricing table items selected by the radio input
                        show_selected_items(table_elements[selected_filter]);

                        //rotate each mo-openid-cd-pricing-wrapper
                        //at the end of the animation hide the not-selected pricing tables and rotate back the .mo-openid-cd-pricing-wrapper

                        if( !Modernizr.cssanimations ) {
                            hide_not_selected_items(table_elements, selected_filter);
                            pricing_table_wrapper.removeClass('is-switched');
                        } else {
                            pricing_table_wrapper.addClass('is-switched').eq(0).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
                                hide_not_selected_items(table_elements, selected_filter);
                                pricing_table_wrapper.removeClass('is-switched');
                                //change rotation direction if .mo-openid-cd-pricing-list has the .cd-bounce-invert class
                                if(pricing_table.find('.mo-openid-cd-pricing-list').hasClass('cd-bounce-invert')) pricing_table_wrapper.toggleClass('reverse-animation');
                            });
                        }
                    });
                });
            }
            function show_selected_items(selected_elements) {
                selected_elements.addClass('is-selected');
            }

            function hide_not_selected_items(table_containers, filter) {
                $.each(table_containers, function(key, value){
                    if ( key != filter ) {
                        $(this).removeClass('is-visible is-selected').addClass('is-hidden');

                    } else {
                        $(this).addClass('is-visible').removeClass('is-hidden is-selected');
                    }
                });
            }
        });
    </script>
    <div class="clear">
        <hr>
        <h3>Refund Policy -</h3>
        <p><b>At miniOrange, we want to ensure you are 100% happy with your purchase. If the premium plugin you
                purchased is not working as advertised and you've attempted to resolve any issues with our support
                team, which couldn't get resolved then we will refund the whole amount within 10 days of the
                purchase. Please email us at <a href="mailto:info@xecurify.com"><i>info@xecurify.com</i></a> for any
                queries regarding the return policy.</b></p>
        <b>Not applicable for -</b>
        <ol>
            <li>Returns that are because of features that are not advertised.</li>
            <li>Returns beyond 10 days.</li>
        </ol>
    </div>
    <div id="myModal_3" class="mo_openid_popup-modal">

        <div class="mo_openid_modal-content">
            <span class="mo_openid-popup-modal-close">&times;</span>
            <h3>FREE SOCIAL LOGIN FEATURES</h3>
            <li>Social Login with Facebook, Google, Twitter, Vkontakte, LinkedIn, Amazon, Windows Live, Salesforce & Yahoo</li>
            <li>NO SETUP required for default social login apps.</li>
            <li>Setup your own social login application with APP ID and APP Secret for Facebook, Google, Twitter, Vkontakte, LinkedIn, Instagram, Amazon, Windows Live & Yahoo</li>
            <li>Preview is available for Social Login icons</li>
            <li>Icon Customizations – customize shape, theme, space & size of social login icons.</li>
            <li>Profile completion (username, email) – Prompt user for email & username if social login app doesn’t return it. Email is verified with verification code.</li>
            <li>Assign Roles to users – Assign WordPress roles to users logging in with social login application.</li>
            <li>Add the Social Login Icons on: login page, registration page, comment form or anywhere on your site using our Social Login widget/ shortcode.</li>
            <li>Sync Social Profile Picture with WordPress.</li>
            <li>Enable Email Notification to admin when user registers with social login application.</li>
            <li>Enable/disable user registration.</li>
            <li>Customize Login/Logout Redirect URL.</li>
            <li>Customizable Text For Social Login Icons.</li>
            <li>SHORTCODE available for social login.</li>
            <li>Support using email and in-plugin support form.</li>
        </div>
    </div>

    <div id="myModal_4" class="mo_openid_popup-modal" >

        <div class="mo_openid_modal-content" style="margin-top: 8%">
            <span class="mo_openid-popup-modal-close">&times;</span>
            <h3>CUSTOM REGISTRATION FORM FEATURES</h3>
            <li>Create a pre-registration form</li>
            <li>Allow user to select Role while Registration</li>
            <li>All WordPress Themes Supported</li>
            <li>Map Users Data returned from all Social Apps</li>
            <li>Add Custom Fields in the Registration form</li>
            <li>Advanced Form Control</li>
            <li>Sync existing meta field</li>
        </div>
    </div>

    <script> //var modal = ;
        function mo_all_features_clk(){
            document.getElementById('myModal_3').style.display="block";

        }
        function mo_cus_feature_clk(){
            document.getElementById('myModal_4').style.display="block";

        }
        var span = document.getElementsByClassName("mo_openid-popup-modal-close")[0];
        span.onclick = function() {
            document.getElementById('myModal_3').style.display = "none";

        }
        var span2= document.getElementsByClassName("mo_openid-popup-modal-close")[1];
        span2.onclick = function() {
            document.getElementById('myModal_4').style.display = "none";

        }
        window.onclick = function(event) {
            if (event.target == document.getElementById('myModal_3')) {
                document.getElementById('myModal_3').style.display = "none";
            }
            if (event.target == document.getElementById('myModal_4')) {
                document.getElementById('myModal_4').style.display = "none";
            }

        }
    </script>
    <script>
        //to set heading name
        jQuery('#mo_openid_page_heading').text('<?php echo mo_sl('Licensing Plans');?>');


        function myFunction(dots_id,read_id,btn_id) {

            var dots = document.getElementById(dots_id);
            var moreText = document.getElementById(read_id);
            var btnText = document.getElementById(btn_id);

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "Read more";
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = "Close";
                moreText.style.display = "inline";
            }
        }
        function mosocial_addonform(planType) {
            jQuery.ajax({
                url: "<?php echo admin_url("admin-ajax.php");?>", //the page containing php script
                method: "POST", //request type,
                dataType: 'json',
                data: {
                    action: 'mo_register_customer_toggle_update',
                },
                success: function (result) {
                    if(result.status){
                        jQuery('#requestOrigin').val(planType);
                        jQuery('#mosocial_loginform').submit();
                    }
                    else
                    {
                        alert("It seems you are not registered with miniOrange. Please login or register with us to upgrade to premium plan.");
                        window.location.href="<?php echo site_url()?>".concat("/wp-admin/admin.php?page=mo_openid_general_settings&tab=profile");
                    }
                }
            });
        }
    </script>

    </td>

    <td>
        <form style="display:none;" id="mosocial_loginform" action="<?php echo get_option( 'mo_openid_host_name' ) . '/moas/login'; ?>"
              target="_blank" method="post" >
            <input type="email" name="username" value="<?php echo esc_attr(get_option('mo_openid_admin_email')); ?>" />
            <input type="text" name="redirectUrl" value="<?php echo esc_attr(get_option( 'mo_openid_host_name')).'/moas/initializepayment'; ?>" />
            <input type="text" name="requestOrigin" id="requestOrigin"/>
        </form>
    </td>
    <?php
}


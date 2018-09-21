<?php

if ( ! class_exists( 'Bachnguyen_Theme_Optionss' ) ) {
 
                /* class Bachnguyen_Theme_Options sẽ chứa toàn bộ code tạo options trong theme từ Redux Framework */
				class Bachnguyen_Theme_Options
				{	 

					/* Tái tạo các biến có trong Redux Framework */
					public $args = array();
					public $sections = array();
					public $theme;
					public $ReduxFramework;

					/* Load Redux Framework */
					 public function __construct() {
					 
					     if ( ! class_exists( 'ReduxFramework' ) ) {
					         return;
					     }
					 
					     // This is needed. Bah WordPress bugs.  <img class="emoji" draggable="false" alt="😉" src="http://s.w.org/images/core/emoji/72x72/1f609.png">
					     if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
					         $this->initSettings();
					     } else {
					         add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
					     }
					 
					 }


					 /**Thiết lập các method muốn sử dụng
				                        Method nào được khai báo trong này thì cũng phải được sử dụng
				                    **/
					public function initSettings() {
					 
					    // Set the default arguments
					    $this->setArguments();
					 
					    // Set a few help tabs so you can see how it's done
					    $this->setHelpTabs();
					 
					    // Create the sections and fields
					    $this->setSections();
					 
					    if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
					        return;
					    }
					 
					    $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
					}

					/**Thiết lập cho method setAgruments
						Method này sẽ chứa các thiết lập cơ bản cho trang Options Framework như tên menu chẳng hạn
					**/
						public function setArguments() {
						    $theme = wp_get_theme(); // Lưu các đối tượng trả về bởi hàm wp_get_theme() vào biến $theme để làm một số việc tùy thích.
						    $this->args = array(
						            // Các thiết lập cho trang Options
						        'opt_name'  => 'tp_options', // Tên biến trả dữ liệu của từng options, ví dụ: tp_options['field_1']
						        'display_name' => $theme->get( 'Name' ), // Thiết lập tên theme hiển thị trong Theme Options
						        'menu_type'          => 'menu',
						        'allow_sub_menu'     => true,
						        'menu_title'         => __( 'Themes Option', 'theme_option' ),
						        'page_title'         => __( 'Themes Option', 'theme_option' ),
						        'dev_mode' => false,
						        'customizer' => true,
						        'menu_icon' => '', // Đường dẫn icon của menu option
						        // Chức năng Hint tạo dấu chấm hỏi ở mỗi option để hướng dẫn người dùng */
						        'hints'              => array(
						            'icon'          => 'icon-question-sign',
						            'icon_position' => 'right',
						            'icon_color'    => 'lightgray',
						            'icon_size'     => 'normal',
						            'tip_style'     => array(
						                'color'   => 'light',
						                'shadow'  => true,
						                'rounded' => false,
						                'style'   => '',
						            ),
						            'tip_position'  => array(
						                'my' => 'top left',
						                'at' => 'bottom right',
						            ),
						            'tip_effect'    => array(
						                'show' => array(
						                    'effect'   => 'slide',
						                    'duration' => '500',
						                    'event'    => 'mouseover',
						                ),
						                'hide' => array(
						                    'effect'   => 'slide',
						                    'duration' => '500',
						                    'event'    => 'click mouseleave',
						                ),
						            ),
						        ) // end Hints
						    );



							}

						/**Thiết lập khu vực Help để hướng dẫn người dùng
						**/
						public function setHelpTabs() {
						 
						    // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
						    $this->args['help_tabs'][] = array(
						        'id'      => 'redux-help-tab-1',
						        'title'   => __( 'Theme Information 1', 'theme_option' ),
						        'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'theme_option' )
						    );
						 
						    $this->args['help_tabs'][] = array(
						        'id'      => 'redux-help-tab-2',
						        'title'   => __( 'Theme Information 2', 'theme_option' ),
						        'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'theme_option' )
						    );
						 
						    // Set the help sidebar
						    $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'theme_option' );
						}



						/**	Thiết lập từng phần trong khu vực Theme Options
							mỗi section được xem như là một phân vùng các tùy chọn
							Trong mỗi section có thể sẽ chứa nhiều field
							**/
							public function setSections() {
							 
							    // Header Section
							    $this->sections[] = array(
							        'title'  => __( 'Header', 'theme_option' ),
							        'desc'   => __( 'All of settings for header on this theme.', 'theme_option' ),
							        'icon'   => 'el-icon-home',
							        'fields' => array(

							        	 array(
											        'id'       => 'logo-image',
											        'type'     => 'media',
											        'title'    => __( 'Logo Image header', 'theme_option' ),
											        'desc'     => __( 'Image that you want to use as logo', 'theme_option' ),
											    ),	
							        	


							        	)
								); // end section
								
								 // Header Section
								 $this->sections[] = array(
							        'title'  => __( 'Home', 'theme_option' ),
							        'icon'   => 'el-icon-home',
							        'fields' => array(
										array(
											'id'       => 'home-banner-image',
											'type'     => 'media',
											'title'    => __( 'Banner Image', 'theme_option' ),
										
										),
										array(
											'id'       => 'home-banner-image-mobile',
											'type'     => 'media',
											'title'    => __( 'Banner Image Mobile', 'theme_option' ),
										
										),	

							        	 array(
											        'id'       => 'home-slider-service',
											        'type'     => 'slides',
											        'title'    => __( 'Slider Service', 'theme_option' ),
											    
											    ),	
							        	


							        	)
							    ); // end section

							     
							    $this->sections[]=array(
							    	'title'=>__('Footer','theme_option'),
							    	'desc'	=>__('All of settings for footer on this theme','theme_option'),
							    	'fields'=>array(

							    			
							        		array(

							        				'id'		=>'footer-contact-us',
							        				'type'		=>'textarea',
							        				'title'		=>'Contact Us (Home)',
							        				
											),
											array(

												'id'		=>'footer-contact-us-sub',
												'type'		=>'textarea',
												'title'		=>'Contact Us',
												
										),
											array(
												'id'       => 'logo-image-footer',
												'type'     => 'media',
												'title'    => __( 'Logo Image Footer', 'theme_option' ),
												
											),	
											array(

												'id'		=>'footer-link-1-us',
												'type'		=>'textarea',
												'title'		=>'Footer 1',
												
											),

											array(

												'id'		=>'footer-link-2-us',
												'type'		=>'textarea',
												'title'		=>'Footer 2',
												
											),
											array(

												'id'		=>'face-text',
												'type'		=>'text',
												'title'		=>'Facebook',
												'desc'		=>'Facebook that you want to use on sidebar'
										),
										array(

											'id'		=>'instagram-text',
											'type'		=>'text',
											'title'		=>'Instagram',
										
										),
										array(

											'id'		=>'hotline-text',
											'type'		=>'text',
											'title'		=>'Hotline',
										
										),



							    		)

							    	);
							   	
							 
							}
				}




        /* Kích hoạt class Bachnguyen_Theme_Options vào Redux Framework */
        global $reduxConfig;
        $reduxConfig = new Bachnguyen_Theme_Options();
      }



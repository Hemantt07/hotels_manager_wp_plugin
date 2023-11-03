<?php
/**
 * @package Custom Elementor Widget
 *
 */
namespace LSM\Base;
use LSM\Widgets\Locations_widget;
use LSM\Widgets\Services_widget;

Class Shortcodes{

	public function register () {
        add_shortcode('location', [$this, 'my_location_shortcode']);
        add_shortcode('single-location', [$this, 'my_location_single_shortcode']);
    }

    function my_location_single_shortcode($atts) {
        if (isset($_GET['single_loc_id'])) {
            global $wpdb;

            $location_table = $wpdb->prefix . 'locations_table';
            $query = "SELECT * FROM $location_table WHERE `id` =".$_GET['single_loc_id']." AND `status` = 1";
            $location = $wpdb->get_results($query)[0];
            
            $jsonString = '{"data": ' . $location->services . '}';
            $services = json_decode($jsonString, true);
            $servicesArr = $services['data'];

            $html = '<div class="location-short" id="location-'. $location->id .'"><img src="'.ELEMENTOR_WIDGET_PLUGIN_URL . 'assets/images/default.webp'.'" alt="location_image"><div class="details"><div class="left-block"><h2 class="loc_title">'. $location->title .'</h2><p class="loc_address">'. $location->address .'</p><div class="services"><ul>';

            for ($i=0; $i < count($servicesArr); $i++) { 
                $html .= '<li class="service">'. $servicesArr[$i] .'</li>';
            }
            $html .= '</ul></div></div><div class="right-block"><p><svg width="18" height="21" viewBox="0 0 18 21" fill="white" xmlns="http://www.w3.org/2000/svg">
            <path d="M14.6569 14.6569C13.7202 15.5935 11.7616 17.5521 10.4138 18.8999C9.63275 19.681 8.36768 19.6814 7.58663 18.9003C6.26234 17.576 4.34159 15.6553 3.34315 14.6569C0.218951 11.5327 0.218951 6.46734 3.34315 3.34315C6.46734 0.218951 11.5327 0.218951 14.6569 3.34315C17.781 6.46734 17.781 11.5327 14.6569 14.6569Z" stroke="#E1B697" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12 9C12 10.6569 10.6569 12 9 12C7.34315 12 6 10.6569 6 9C6 7.34315 7.34315 6 9 6C10.6569 6 12 7.34315 12 9Z" stroke="#E1B697" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>'.$location->address.'</p><a class="book-now" href="/?book_loc_id='.$location->id.'">Book it</a></div></div></div>';

            return $html;
        }
    }

	function my_location_shortcode($atts) {
        
        $atts = shortcode_atts(array(
            'id' => null,
            'width' => 'max-content'
        ), $atts);
        
        global $wpdb;
        $location_table = $wpdb->prefix . 'locations_table';
        $query = "SELECT * FROM $location_table WHERE `id` =".$atts['id'];
        $location = $wpdb->get_results($query)[0];

        $jsonString = '{"data": ' . $location->services . '}';
        $services = json_decode($jsonString, true);
        $servicesArr = $services['data'];
    
        $html = '<style>#location-'. $location->id .'{display:flex;border-radius:10px;width:'. $atts['width'] .';padding:10px 30px;box-shadow:0 0 6px #8f8f8f}#location-'. $location->id .' h2.loc_title{font-size:27px;font-weight:300;margin:10px auto}#location-'. $location->id .' .left-block{width:60%}#location-'. $location->id .' .right-block{width:40%;display: flex;justify-content: end;flex-direction:column;}#location-'. $location->id .' .loc_address{font-size:16px;font-weight:300;line-height:1.3;max-width:503px}#location-'. $location->id .' .services ul{list-style:none;padding:0;display:flex;flex-wrap:wrap;}#location-'. $location->id .' .services ul li.service{margin:0;padding:8px 13px 8px 0;margin-right:15px;border-radius:8px;color:#225266;line-height:1}#location-'. $location->id .' .right-block svg{fill:#fff;margin-right:5px;}#location-'. $location->id .' .book-now{background:#E05E0F;color: #fff;font-weight: 600;width: fit-content;margin: 0 auto;padding: 10px 90px;border-radius: 30px;}#location-'. $location->id .' .right-block p {margin:0 0 15px 0;text-align:center;}</style>
        <div class="location-short" id="location-'. $location->id .'"><div class="left-block"><h2 class="loc_title">'. $location->title .'</h2><p class="loc_address">'. $location->address .'</p><div class="services"><ul>';

        for ($i=0; $i < count($servicesArr); $i++) { 
            $html .= '<li class="service">'. $servicesArr[$i] .'</li>';
        }
        $html .= '</ul></div></div><div class="right-block"><p><svg width="18" height="21" viewBox="0 0 18 21" fill="white" xmlns="http://www.w3.org/2000/svg">
        <path d="M14.6569 14.6569C13.7202 15.5935 11.7616 17.5521 10.4138 18.8999C9.63275 19.681 8.36768 19.6814 7.58663 18.9003C6.26234 17.576 4.34159 15.6553 3.34315 14.6569C0.218951 11.5327 0.218951 6.46734 3.34315 3.34315C6.46734 0.218951 11.5327 0.218951 14.6569 3.34315C17.781 6.46734 17.781 11.5327 14.6569 14.6569Z" stroke="#E1B697" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M12 9C12 10.6569 10.6569 12 9 12C7.34315 12 6 10.6569 6 9C6 7.34315 7.34315 6 9 6C10.6569 6 12 7.34315 12 9Z" stroke="#E1B697" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>'.$location->address.'</p><a class="book-now" href="/?book_loc_id='.$location->id.'">Book it</a></div></div>';

        return $html;
        
    }
    
}
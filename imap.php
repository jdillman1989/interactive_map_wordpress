<?php
/**
 * Plugin Name: JQVMap & ChartJS World Map
 * Author:      Jesse Dillman
 */
add_action( 'wp_enqueue_scripts', 'enqueue_dependencies' );

function enqueue_dependencies()
{
    # Run only on given page
    if( !is_page(229) )
        return;

    # Enqueue styles
    wp_enqueue_style( 'jmap-css', plugins_url( '/css/jqvmap.css', __FILE__ ) );

    # Register dependencies files
    wp_register_script( 'js', plugins_url( '/js/jquery-1.7.2.min.js', __FILE__ ) );
    wp_register_script( 'jmap-js', plugins_url( '/js/jquery.vmap.js', __FILE__ ) );
    wp_register_script( 'world-js', plugins_url( '/js/jquery.vmap.world.js', __FILE__ ) );
    wp_register_script( 'unregions-js', plugins_url( '/js/jquery.vmap.un_regions.js', __FILE__ ) );
    wp_register_script( 'regioncolors-js', plugins_url( '/js/region_colors.js', __FILE__ ) );
    wp_register_script( 'chart-js', plugins_url( '/js/ChartNew.js', __FILE__ ) );

    # Enqueue custom JS file along with dependencies
    wp_enqueue_script( 
        'start-js', 
        plugins_url( '/js/start.js', __FILE__ ), 
        array( 'js', 'jmap-js', 'world-js', 'unregions-js', 'regioncolors-js', 'chart-js' ), // dependencies
        false,
        true   // will load start-js on footer, the rest goes on header
    );

    wp_localize_script( 'start-js', 'get_data', array( 'ajaxurl' => admin_url( 'admin-ajax.php')));
}


function get_chart_data(){

  $region1Data = array(291879, 193561, 116230);
  $region2Data = array(43008, 6259, 0);
  $region3Data = array(289960, 71484, 367962);
  $region4Data = array(133115, 144114, 547320);
  $region5Data = array(237370, 267503, 1643325);

  $region1Color = '#da826a';
  $region2Color = '#a3795d';
  $region3Color = '#99b5bf';
  $region4Color = '#e4dab6';
  $region5Color = '#7a9e89';

  //$chartData = new stdClass();
  //$chartArray = array();
  $title = "";
  // Swtich based on region
  switch($_REQUEST['region']) {
    //Asia
    case 'China':
    case 'Japan':
    case 'Mongolia':
    case 'Bangladesh':
    case 'Bhutan':
    case 'India':
    case 'Maldives':
    case 'Nepal':
    case 'Brunei Darussalam':
    case 'South Korea':
    case 'North Korea':
    case 'Cambodia':
    case 'Indonesia':
    case "Lao People's Democratic Republic":
    case 'Malaysia':
    case 'Myanmar':
    case 'Philippines':
    case 'Thailand':
    case 'Vietnam':
    case 'Sri Lanka':
    case 'Australia':
    case 'New Zealand':
    case 'Fiji':
    case 'Solomon Islands':
    case 'Papua New Guinea':
    case 'Vanuatu':
    case 'New Caledonia':
    case 'French Polynesia':
      $barData = $region1Data;
      $barColor = $region1Color;
      $title = "Asia Scripture Impact Goals for 2015";
      break;

    //Middle East
    case 'Pakistan':
    case 'Tajikistan':
    case 'Kyrgyzstan':
    case 'Kazakhstan':
    case 'Afghanistan':
    case 'Turkmenistan':
    case 'Uzbekistan':
    case 'Iran':
    case 'Azerbaijan':
    case 'Turkey':
    case 'Syrian Arab Republic':
    case 'Iraq':
    case 'Kuwait':
    case 'Jordan':
    case 'Israel':
    case 'Lebanon':
    case 'Cyprus':
    case 'Oman':
    case 'Yemen':
    case 'Saudi Arabia':
    case 'United Arab Emirates':
    case 'Qatar':
    case 'Egypt':
      $barData = $region2Data;
      $barColor = $region2Color;
      $title = "Middle East Scripture Impact Goals for 2015";
      break;

    //Africa
    case 'Burundi':
    case 'Comoros':
    case 'Djibouti':
    case 'Eritrea':
    case 'Ethiopia':
    case 'Kenya':
    case 'Madagascar':
    case 'Malawi':
    case 'Mauritius':
    case 'Mozambique':
    case 'Reunion':
    case 'Rwanda':
    case 'Seychelles':
    case 'Somalia':
    case 'Uganda':
    case 'Tanzania':
    case 'Zambia':
    case 'Zimbabwe':
    case 'Angola':
    case 'Cameroon':
    case 'Central African Republic':
    case 'Chad':
    case 'Congo':
    case 'DRC Congo':
    case 'Equitorial Guinea':
    case 'Gabon':
    case 'Sao Tome':
    case 'Algeria':
    case 'Libya':
    case 'Morocco':
    case 'Sudan':
    case 'Tunisia':
    case 'Botswana':
    case 'Lesotho':
    case 'Namibia':
    case 'South Africa':
    case 'Swaziland':
    case 'Benin':
    case 'Burkina Faso':
    case 'Cape Verde':
    case 'Cote DIvoire':
    case 'Gambia':
    case 'Ghana':
    case 'Guinea':
    case 'Guinea-Bissau':
    case 'Liberia':
    case 'Mali':
    case 'Mauritania':
    case 'Niger':
    case 'Nigeria':
    case 'Senegal':
    case 'Sierra Leone':
    case 'Togo':
      $barData = $region3Data;
      $barColor = $region3Color;
      $title = "Africa Scripture Impact Goals for 2015";
      break;

      //Europe
    case 'Belarus':
    case 'Bulgaria':
    case 'Czech Republic':
    case 'Hungary':
    case 'Poland':
    case 'Moldova':
    case 'Romania':
    case 'Russian Federation':
    case 'Slovakia':
    case 'Ukraine':
    case 'Denmark':
    case 'Estonia':
    case 'Finland':
    case 'Iceland':
    case 'Ireland':
    case 'Latvia':
    case 'Lithuania':
    case 'Norway':
    case 'Sweden':
    case 'United Kingdom':
    case 'Albania':
    case 'Bosnia':
    case 'Croatia':
    case 'Greece':
    case 'Italy':
    case 'Malta':
    case 'Portugal':
    case 'Slovenia':
    case 'Spain':
    case 'Macedonia':
    case 'Serbia':
    case 'Austria':
    case 'Belgium':
    case 'France':
    case 'Germany':
    case 'Netherlands':
    case 'Switzerland':
    case 'Armenia':
    case 'Georgia':
      $barData = $region4Data;
      $barColor = $region4Color;
      $title = "Europe Scripture Impact Goals for 2015";
      break;

      //America
    case 'Canada':
    case 'Greenland':
    case 'United States of America':
    case 'Bahamas':
    case 'Dominica':
    case 'Antigua':
    case 'Barbados':
    case 'Cuba':
    case 'Grenada':
    case 'Jamaica':
    case 'Nevis':
    case 'St. Lucia':
    case 'Trinidad':
    case 'Dominican Republic':
    case 'Haiti':
    case 'Belize':
    case 'Costa Rica':
    case 'El Salvador':
    case 'Gautemala':
    case 'Honduras':
    case 'Mexico':
    case 'Nicaragua':
    case 'Panama':
    case 'Argentina':
    case 'Bolivia':
    case 'Brazil':
    case 'Chile':
    case 'Colombia':
    case 'Ecuador':
    case 'Falkland Islands':
    case 'Guyana':
    case 'French Guiana':
    case 'Peru':
    case 'Paraguay':
    case 'Suriname':
    case 'Uruguay':
    case 'Venezuela':
      $barData = $region5Data;
      $barColor = $region5Color;
      $title = "Latin America Scripture Impact Goals for 2015";
      break;
  }

  //Create new chartdata object with parameters for data and color values
  $chartData = new stdClass();
  $chartData->fillColor = $barColor;
  $chartData->data = $barData;

  //Create new chart object and pass it the chartdata object as a parameter, along with title 
  $chart = new stdClass();
  $chart->data = $chartData;
  $chart->title = $title;

  echo json_encode($chart);
  die();
}

add_action('wp_ajax_get_chart_data', 'get_chart_data');
add_action('wp_ajax_nopriv_get_chart_data', 'get_chart_data');



class Post{
    function get_post( $ID ){
        $html = '';
        $post = get_post( $ID );
        if( $post ) {
            //$html = $post->post_title;
            $html .= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
            $html .= $post->post_content;
        }
        return $html;
    }
}

function get_post_data(){

    $post = new Post();
    $result = '';

      // Swtich based on region
      switch($_REQUEST['region']) {
        //Asia
        case 'China':
        case 'Japan':
        case 'Mongolia':
        case 'Bangladesh':
        case 'Bhutan':
        case 'India':
        case 'Maldives':
        case 'Nepal':
        case 'Brunei Darussalam':
        case 'South Korea':
        case 'North Korea':
        case 'Cambodia':
        case 'Indonesia':
        case "Lao People's Democratic Republic":
        case 'Malaysia':
        case 'Myanmar':
        case 'Philippines':
        case 'Thailand':
        case 'Vietnam':
        case 'Sri Lanka':
        case 'Australia':
        case 'New Zealand':
        case 'Fiji':
        case 'Solomon Islands':
        case 'Papua New Guinea':
        case 'Vanuatu':
        case 'New Caledonia':
        case 'French Polynesia':
            $result = $post->get_post( 645 );
          break;

        //Middle East
        case 'Pakistan':
        case 'Tajikistan':
        case 'Kyrgyzstan':
        case 'Kazakhstan':
        case 'Afghanistan':
        case 'Turkmenistan':
        case 'Uzbekistan':
        case 'Iran':
        case 'Azerbaijan':
        case 'Turkey':
        case 'Syrian Arab Republic':
        case 'Iraq':
        case 'Kuwait':
        case 'Jordan':
        case 'Israel':
        case 'Lebanon':
        case 'Cyprus':
        case 'Oman':
        case 'Yemen':
        case 'Saudi Arabia':
        case 'United Arab Emirates':
        case 'Qatar':
        case 'Egypt':
            $result = $post->get_post( 852 );
          break;

        //Africa
        case 'Burundi':
        case 'Comoros':
        case 'Djibouti':
        case 'Eritrea':
        case 'Ethiopia':
        case 'Kenya':
        case 'Madagascar':
        case 'Malawi':
        case 'Mauritius':
        case 'Mozambique':
        case 'Reunion':
        case 'Rwanda':
        case 'Seychelles':
        case 'Somalia':
        case 'Uganda':
        case 'Tanzania':
        case 'Zambia':
        case 'Zimbabwe':
        case 'Angola':
        case 'Cameroon':
        case 'Central African Republic':
        case 'Chad':
        case 'Congo':
        case 'DRC Congo':
        case 'Equitorial Guinea':
        case 'Gabon':
        case 'Sao Tome':
        case 'Algeria':
        case 'Libya':
        case 'Morocco':
        case 'Sudan':
        case 'Tunisia':
        case 'Botswana':
        case 'Lesotho':
        case 'Namibia':
        case 'South Africa':
        case 'Swaziland':
        case 'Benin':
        case 'Burkina Faso':
        case 'Cape Verde':
        case 'Cote DIvoire':
        case 'Gambia':
        case 'Ghana':
        case 'Guinea':
        case 'Guinea-Bissau':
        case 'Liberia':
        case 'Mali':
        case 'Mauritania':
        case 'Niger':
        case 'Nigeria':
        case 'Senegal':
        case 'Sierra Leone':
        case 'Togo':
            $result = $post->get_post( 1551 );
          break;

          //Europe
        case 'Belarus':
        case 'Bulgaria':
        case 'Czech Republic':
        case 'Hungary':
        case 'Poland':
        case 'Moldova':
        case 'Romania':
        case 'Russian Federation':
        case 'Slovakia':
        case 'Ukraine':
        case 'Denmark':
        case 'Estonia':
        case 'Finland':
        case 'Iceland':
        case 'Ireland':
        case 'Latvia':
        case 'Lithuania':
        case 'Norway':
        case 'Sweden':
        case 'United Kingdom':
        case 'Albania':
        case 'Bosnia':
        case 'Croatia':
        case 'Greece':
        case 'Italy':
        case 'Malta':
        case 'Portugal':
        case 'Slovenia':
        case 'Spain':
        case 'Macedonia':
        case 'Serbia':
        case 'Austria':
        case 'Belgium':
        case 'France':
        case 'Germany':
        case 'Netherlands':
        case 'Switzerland':
        case 'Armenia':
        case 'Georgia':
            $result = $post->get_post( 1546 );
          break;

          //America
        case 'Canada':
        case 'Greenland':
        case 'United States of America':
        case 'Bahamas':
        case 'Dominica':
        case 'Antigua':
        case 'Barbados':
        case 'Cuba':
        case 'Grenada':
        case 'Jamaica':
        case 'Nevis':
        case 'St. Lucia':
        case 'Trinidad':
        case 'Dominican Republic':
        case 'Haiti':
        case 'Belize':
        case 'Costa Rica':
        case 'El Salvador':
        case 'Gautemala':
        case 'Honduras':
        case 'Mexico':
        case 'Nicaragua':
        case 'Panama':
        case 'Argentina':
        case 'Bolivia':
        case 'Brazil':
        case 'Chile':
        case 'Colombia':
        case 'Ecuador':
        case 'Falkland Islands':
        case 'Guyana':
        case 'French Guiana':
        case 'Peru':
        case 'Paraguay':
        case 'Suriname':
        case 'Uruguay':
        case 'Venezuela':
            $result = $post->get_post( 882 );
          break;
      }

      echo json_encode($result);
      die();
}

    add_action('wp_ajax_get_post_data', 'get_post_data');
    add_action('wp_ajax_nopriv_get_post_data', 'get_post_data');
?>
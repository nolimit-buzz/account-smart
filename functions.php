<?php
/**
 * Account planner functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Account Planner
 * @since Account Planner 1.0
 */

/**
 * Register block styles.
 */

 require __DIR__ . '/vendor/autoload.php'; // remove this line if you use a PHP Framework.


 
if ( ! function_exists( 'accountplanner_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function accountplanner_support() {

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );
	}

endif;

// add_action( 'after_setup_theme', 'accountplanner_support' );
 


// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);



add_action('wp_ajax_handle_login','handle_login' );
add_action('wp_ajax_nopriv_handle_login','handle_login' );

 

function handle_login(){
    // print_r($_POST);
    
  
    $creds = array(
    'user_login'    => sanitize_user($_POST['log']),
    'user_password' => esc_attr($_POST['pwd']),
    'remember'      => true
    );

  $user = wp_signon( $creds, false );

    if(!is_wp_error($user)){  
      
      // If login is successful, set authentication cookies
    wp_set_auth_cookie($user->ID, true);
    wp_set_current_user($user->ID);

    // Manually set other authentication-related cookies
    $secure_cookie = is_ssl() ? true : false;

    // Set wordpress_sec_{hash} cookie
    $secure_cookie ? setcookie('wordpress_sec_' . COOKIEHASH, $user->sec, 0, COOKIEPATH, COOKIE_DOMAIN, $secure_cookie) : false;

    // Set wp-settings-{user_id} cookie
    setcookie('wp-settings-' . $user->ID, 'library=1&uploader=1&editor=html', time() + 3600, COOKIEPATH, COOKIE_DOMAIN, $secure_cookie);

    // Set wordpress_logged_in_{hash} cookie
    $secure_cookie ? setcookie('wordpress_logged_in_' . COOKIEHASH, $user->logged_in_cookie, 0, COOKIEPATH, COOKIE_DOMAIN, $secure_cookie) : false;
  
        $result = "success";
     

    }else{
     $result =   $user->get_error_message();
    }

    echo $r;


}

// functions.php
function custom_login_endpoint() {
    register_rest_route('wp/v2', '/users/login/', array(
        'methods' => 'POST',
        'callback' => 'custom_login_callback',
    ));
}

function custom_login_callback($data) {
    $user = wp_signon(array(
        'user_login'    => $data['log'],
        'user_password' => $data['pwd'],
        'remember'      => true,
    ), false);

    if (is_wp_error($user)) {
        return array('result' => $user->get_error_message());
    }

   // If login is successful, set authentication cookies
    wp_set_auth_cookie($user->ID, true);
    wp_set_current_user($user->ID);

    // // Manually set other authentication-related cookies
    // $secure_cookie = is_ssl() ? true : false;

    // // Set wordpress_sec_{hash} cookie
    // $secure_cookie ? setcookie('wordpress_sec_' . COOKIEHASH, $user->sec, 0, COOKIEPATH, COOKIE_DOMAIN, $secure_cookie) : false;

    // // Set wp-settings-{user_id} cookie
    // setcookie('wp-settings-' . $user->ID, 'library=1&uploader=1&editor=html', time() + 3600, COOKIEPATH, COOKIE_DOMAIN, $secure_cookie);

    // // Set wordpress_logged_in_{hash} cookie
    // $secure_cookie ? setcookie('wordpress_logged_in_' . COOKIEHASH, $user->logged_in_cookie, 0, COOKIEPATH, COOKIE_DOMAIN, $secure_cookie) : false;


    return array('result' => "success");
}

add_action('rest_api_init', 'custom_login_endpoint');



// functions.php
if ((current_user_can('subscriber') || current_user_can('author') ) && !is_admin()) {
    add_filter('show_admin_bar', '__return_false');
}

function redirect_login_page() {

    $user = get_user_by('id',get_current_user_id());
 
    // if(  current_user_can('author') || current_user_can('subscriber') ){

        $login_url  = home_url( '/register' );
        $url = basename($_SERVER['REQUEST_URI']); // get requested URL

        ( ($url === "wp-admin") || isset( $_REQUEST['redirect_to']) || isset($_REQUEST['loggedout']) ) ? ( $url   = "wp-login.php" ): 0; // if users ssend request to wp-admin
        if( $url  == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET')  {
            wp_redirect( $login_url );
            exit;
         }
    // }

}
// add_action('init','redirect_login_page');
  

// Logout users when they click on the logout link
function logout_redirect_home() {
    wp_redirect(home_url('/register'));
    exit;
}
add_action('wp_logout', 'logout_redirect_home');
 

// Restrict access to wp-login.php and admin for non-admin users
function restrict_access_to_admin_pages() {
    // Check if user is not logged in
    if (!is_user_logged_in() && !is_page('register')  ) {
        // Redirect non-logged-in users to home page
        wp_redirect(home_url('/register'));
        exit;

       
    }

}
add_action('template_redirect', 'restrict_access_to_admin_pages');

// Restrict access to wp-admin for non-admin users
function restrict_admin_access() {
    if (!current_user_can('administrator') && is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX )) {
        wp_redirect(home_url());
        exit;
    }
}
add_action('init', 'restrict_admin_access');


/**
 * Classes
 */
// src\classes\Init::init();



AccountPlannerWP\Classes\AccountPlanner::get_instance();
// require get_template_directory() . '/src/Classes/AccountPlanner.php';
require get_template_directory() . '/src/Classes/PostTypes.php';


 
// Your post ID
// $post_id = 122;

// // Your meta key
// $meta_key = 'chat_history';

// // Prepare and execute the query
// $meta_value = $wpdb->get_var($wpdb->prepare("
//     SELECT meta_value
//     FROM {$wpdb->postmeta}
//     WHERE post_id = %d
//     AND meta_key = %s
// ", $post_id, $meta_key));

// // Unserialize the meta value if it's serialized
// // $array = json_decode($meta_value);

// json_decode($meta_value);

// url --request POST \
//      --url https://httpbin.org/anything/bearer
//      --header 'Authorization: Bearer 546454654655'


  
// $client = new \GuzzleHttp\Client();

// $response = $client->request('POST', 'https://api.perplexity.ai/chat/completions', [
//   'body' => '{
//     "model":"llama-3-sonar-small-32k-online",
//     "messages":[
//         {"role":"user","content":"Imagine you are a producer/broker at Patriot Growth Insurance Services and you are examining Lott Brothers Construction company as a potential Client for either property and casualty insurance OR employee benefits. As a potential broker, you need to understand their business better than they do to communicate your value effectively. Give an in depth overview of Lott Brothers Construction company as an organization and what they do (include company size, industry, industries served, and anything relevant to the understanding of who they are and what they do that might eventually lead to evaluating risk and benefit in either property and casualty). Use current and relevant sources to provide the most relevant information from all of public domain. Avoid relating what they do to Patriot Growth Insurance Services or to actual insurance or carriers at this point.  Always be thorough in responses in looking at challenges and trends.  Output needs to be reflect more than simple bullets."}
//     ]
//   }',
//   'headers' => [
//     'accept' => 'application/json',
//     'authorization' => 'Bearer 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',
//     'content-type' => 'application/json',
//   ],
// ]);

// echo $response->getBody();


// Register the custom endpoint.
function register_webhook_endpoint() {
    register_rest_route('webhook/v1', '/receive-data', array(
        'methods' => 'POST',
        'callback' => 'handle_webhook_data',
        'permission_callback' => '__return_true', // Allow public access. Use appropriate permissions in production.
    ));
}
add_action('rest_api_init', 'register_webhook_endpoint');

// Handle the POST request.
function handle_webhook_data(WP_REST_Request $request) {
    $params = $request->get_params();

    // error_log(json_decode($params));

     
    
    // Access form data
    $email = isset($params['Email']) ? sanitize_text_field($params['Email']) : '';
    // $field2 = isset($params['field2']) ? sanitize_text_field($params['field2']) : '';
    // Add more fields as needed
    send_webhook_email($params);


    // Return a response
    return new WP_REST_Response(array(
        'status' => 'success',
        'message' => 'Data received successfully',
    ), 200);
}

 
 
 // Function to send an email with the received data
function send_webhook_email($params) {
    $to = 'segunolamide78@gmail.com'; 
    $subject = 'New Webhook Data Received';
    $message = "You have received new data via the webhook:\n\n";
    $message .= "Email:". $params['Email']."\n";
 
    // Add more fields as needed

    $headers = array('Content-Type: text/plain; charset=UTF-8');

    wp_mail($to, $subject, $message, $headers);
}


function escapeMarkdownSpecialChars($text) {
    $specialChars = [
        '\\' => '\\\\',
        '*' => '\*',
        '_' => '\_',
        '{' => '\{',
        '}' => '\}',
        '[' => '\[',
        ']' => '\]',
        '(' => '\(',
        ')' => '\)',
        '#' => '\#',
        '+' => '\+',
        '-' => '\-',
        '.' => '\.',
        '!' => '\!',
        '`' => '\`',
        '>' => '\>'
    ];

    foreach ($specialChars as $char => $escapedChar) {
        $text = str_replace($char, $escapedChar, $text);
    }

    return $text;
}



// // with default base URL
// $client = \ArdaGnsrn\Ollama\Ollama::client();

// // or with custom base URL
// $client = \ArdaGnsrn\Ollama\Ollama::client('http://127.0.0.1:11434');

// $completions = $client->completions()->create([
//     'model' => 'llama3.1',
//     'prompt' => 'Once upon a time',
// ]);

// echo $completions->response; // '...in a land far, far away...'

// $response->toArray(); // ['model' => 'llama3.1', 'response' => '...in a land far, far away...', ...]


 
// $curl = curl_init();
// echo "TOBI";
// curl_setopt_array($curl, [
//   CURLOPT_URL => "https://api.fireworks.ai/inference/v1/chat/completions",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 30,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "POST",
//   CURLOPT_POSTFIELDS => "{\n  \"messages\": [\n    {\n      \"role\": \"system\",\n      \"content\": \"You are a sales manager.\"\n    },\n    {\n      \"role\": \"user\",\n      \"content\": \"Give overview of NoLimitBzz Integrated Services\"\n    }\n  ],\n  \"model\": \"accounts/fireworks/models/llama-v3p1-8b-instruct\"\n}",
//   CURLOPT_HTTPHEADER => [
//     "Authorization: Bearer fw_3ZKQ8vusuRzCUsedFggpz11X",
//     "Content-Type: application/json"
//   ],
// ]);

// $response = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);

// if ($err) {
//   echo "cURL Error #:" . $err;
// } else {
//   echo "segun".$response;
// }
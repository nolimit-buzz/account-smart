<?php

namespace AccountPlannerWP\Classes;

use Orhanerday\OpenAi\OpenAi;
use WP_Query;
// use GeminiClass;
// use AccountPlannerWP\ParseDown;

include get_template_directory().'/GeminiClass.php';
include get_template_directory().'/ParseDown.php';

class AccountPlanner {




    public function __construct(){

         // Filter ajax add action Callback
         add_action('wp_ajax_account_filter_by_ajax', array($this,'account_filter_by_ajax'));//Filter new : ajax
         add_action('wp_ajax_nopriv_account_filter_by_ajax', array($this,'account_filter_by_ajax'));//Filter new : ajax

        // Filter ajax add action Callback
        add_action('wp_ajax_account_filter_by_company_details', array($this,'account_filter_by_company_details'));//Filter new : ajax
        add_action('wp_ajax_nopriv_account_filter_by_company_details', array($this,'account_filter_by_company_details'));//Filter new : ajax


        // Filter ajax add action Callback
        add_action('wp_ajax_setting_api', array($this,'setting_api'));//Filter new : ajax
        add_action('wp_ajax_nopriv_setting_api', array($this,'setting_api'));//Filter new : ajax



        // Save search
        add_action('wp_ajax_save_search', array($this,'save_search'));//Filter new : ajax
        add_action('wp_ajax_nopriv_save_search', array($this,'save_search'));//Filter new : ajax

        
        // retrieve_save_search
        add_action('wp_ajax_retrieve_save_search', array($this,'retrieve_save_search'));//Filter new : ajax
        add_action('wp_ajax_noprivretrieve_save_search', array($this,'retrieve_save_search'));//Filter new : ajax
      


         // create user 
         add_action('wp_ajax_create_user', array($this,'create_user'));//Filter new : ajax
         add_action('wp_ajax_nopriv_create_user', array($this,'create_user'));//Filter new : ajax

        // Edit user 
        add_action('wp_ajax_edit_user', array($this,'edit_user'));//Filter new : ajax
        add_action('wp_ajax_nopriv_edit_user', array($this,'edit_user'));//Filter new : ajax



        // Delete user 
        add_action('wp_ajax_delete_user', array($this,'delete_user'));//Filter new : ajax
        add_action('wp_ajax_nopriv_delete_user', array($this,'delete_user'));//Filter new : ajax


        add_action('wp_enqueue_scripts', [$this, 'account_script_enqueuer']);

    }




    public function setting_api(){
        global $wpdb;
        if (isset($_POST['action']) && ($_POST['action'] ==="setting_api")) {
         
            $setting_api = $_POST['function_cb'];

            if($setting_api ===  "prompt"){

                // print_r($_POST);
                $company_overview = ($_POST['company_overview']) ? update_option( "company_overview", stripslashes( sanitize_text_field( $_POST['company_overview'] ))) : '' ;
                $challenges = ($_POST['challenges']) ? update_option( "challenges", stripslashes( sanitize_text_field( $_POST['challenges'] ))) : '' ;
                $opportunity_pc = ($_POST['opportunity_pc']) ? update_option( "opportunity_pc", stripslashes( sanitize_text_field( $_POST['opportunity_pc'] ))) : '' ;
                $opportunity_eb = ($_POST['opportunity_eb']) ? update_option( "opportunity_eb", stripslashes( sanitize_text_field( $_POST['opportunity_eb'] ))) : '' ;
                $stakeholder_considerations = ($_POST['stakeholder_considerations']) ? update_option( "stakeholder_considerations", stripslashes( sanitize_text_field( $_POST['stakeholder_considerations'] ))) : '' ;
                $understanding_stakeholder = ($_POST['understanding_stakeholder']) ? update_option( "understanding_stakeholder", stripslashes( sanitize_text_field( $_POST['understanding_stakeholder'] ))) : '' ;
                $discovery_pc = ($_POST['discovery_pc']) ? update_option( "discovery_pc", stripslashes( sanitize_text_field( $_POST['discovery_pc'] ))) : '' ;
                $discovery_eb = ($_POST['discovery_eb']) ? update_option( "discovery_eb", stripslashes( sanitize_text_field( $_POST['discovery_eb'] ))) : '' ;
                $system_prompt = ($_POST['system_prompt']) ? update_option( "system_prompt", stripslashes( sanitize_text_field( $_POST['system_prompt'] ))) : '' ;
               
                return wp_send_json(
                  [
                    "status" => "success",

                  ]
                );

            }

            elseif($setting_api ===  "api"){

                // print_r($_POST);


                $api_switch = ($_POST['api_switch']) ? update_option( "api_switch", sanitize_text_field( $_POST['api_switch'] )) : '' ;

                /* Chat GPT Setting */ 

                $api_key = ($_POST['api_key']) ? update_option( "api_key", sanitize_text_field( $_POST['api_key'] )) : '' ;
                $max_tokens = ($_POST['max_tokens']) ? update_option( "max_tokens", sanitize_text_field( $_POST['max_tokens'] )) : '' ;
                $model = ($_POST['model']) ? update_option( "model", sanitize_text_field( $_POST['model'] )) : '' ;
                
                $temperature_option_name = 'temperature';
                $temperature_value = $_POST['temperature'];
                $option_table = $wpdb->prefix.'options';
                update_option('temperature',$temperature_option_name);
                $temperature_sql = $wpdb->prepare("UPDATE $option_table SET option_value = %s WHERE option_name = %s", $temperature_value, $temperature_option_name);
                $wpdb->query($temperature_sql);


                $presence_penalty_option_name = 'presence_penalty';
                $presence_penalty_value = $_POST['presence_penalty'];
                update_option('presence_penalty',$presence_penalty_value);
                $presence_penalty_sql = $wpdb->prepare("UPDATE $option_table SET option_value = %s WHERE option_name = %s", $presence_penalty_value, $presence_penalty_option_name);
                $wpdb->query($presence_penalty_sql);


                $fequency_penalty_option_name = 'fequency_penalty';
                $fequency_penalty_value = $_POST['fequency_penalty'];
                update_option('fequency_penalty',$fequency_penalty_value);
                $fequency_penalty_sql = $wpdb->prepare("UPDATE $option_table SET option_value = %s WHERE option_name = %s", $fequency_penalty_value, $fequency_penalty_option_name);
                $wpdb->query($fequency_penalty_sql);


                /* Google Gemini Setting */ 
                $gemini_api_key = ($_POST['gemini_api_key']) ? update_option( "gemini_api_key", sanitize_text_field( $_POST['gemini_api_key'] )) : '' ;

                $gemini_max_tokens = ($_POST['gemini_max_tokens']) ? update_option( "gemini_max_tokens", sanitize_text_field( $_POST['gemini_max_tokens'] )) : '' ;
                $gemini_model = ($_POST['gemini_model']) ? update_option( "gemini_model", sanitize_text_field( $_POST['gemini_model'] )) : '' ;
                
                $gemini_temperature_option_name = 'gemini_temperature';
                $gemini_temperature_value = $_POST['gemini_temperature'];
                update_option('gemini_temperature',$gemini_temperature_value);
                $gemini_temperature_sql = $wpdb->prepare("UPDATE $option_table SET option_value = %s WHERE option_name = %s", $gemini_temperature_value, $gemini_temperature_option_name);
                $wpdb->query($gemini_temperature_sql);


                $gemini_topk_option_name = 'gemini_topk';
                $gemini_topk_value = $_POST['gemini_topk'];
                update_option('gemini_topk',$gemini_topk_value);
                $gemini_topk_sql = $wpdb->prepare("UPDATE $option_table SET option_value = %s WHERE option_name = %s", $gemini_topk_value, $gemini_topk_option_name);
                $wpdb->query($gemini_topk_sql);


                $gemini_topp_option_name = 'gemini_topp';
                $gemini_topp_value = $_POST['gemini_topp'];
                update_option('gemini_topp',$gemini_topp_value);
                $gemini_topp_sql = $wpdb->prepare("UPDATE $option_table SET option_value = %s WHERE option_name = %s", $gemini_topp_value, $gemini_topp_option_name);
                $wpdb->query($gemini_topp_sql);


                 /* Perplexity Setting */ 

                 $perplexity_api_key = ($_POST['perplexity_api_key']) ? update_option( "perplexity_api_key", sanitize_text_field( $_POST['perplexity_api_key'] )) : '' ;
                 $perplexity_max_tokens = ($_POST['perplexity_max_tokens']) ? update_option( "perplexity_max_tokens", sanitize_text_field( $_POST['perplexity_max_tokens'] )) : '' ;
                 $perplexity_model = ($_POST['perplexity_model']) ? update_option( "perplexity_model", sanitize_text_field( $_POST['perplexity_model'] )) : '' ;
                 
                 $perplexity_temperature_option_name = 'perplexity_temperature';
                 $perplexity_temperature_value = $_POST['perplexity_temperature'];
                 $option_table = $wpdb->prefix.'options';
                 update_option('perplexity_temperature',$perplexity_temperature_value);
                 $perplexity_temperature_sql = $wpdb->prepare("UPDATE $option_table SET option_value = %s WHERE option_name = %s", $perplexity_temperature_value, $perplexity_temperature_option_name);
                 $wpdb->query($perplexity_temperature_sql);
 
 
                 $perplexity_presence_penalty_option_name = 'perplexity_presence_penalty';
                 $perplexity_presence_penalty_value = $_POST['perplexity_presence_penalty'];
                 update_option('perplexity_presence_penalty',$perplexity_presence_penalty_value);
                 $perplexity_presence_penalty_sql = $wpdb->prepare("UPDATE $option_table SET option_value = %s WHERE option_name = %s", $perplexity_presence_penalty_value, $perplexity_presence_penalty_option_name);
                 $wpdb->query($perplexity_presence_penalty_sql);
 
 
                 $perplexity_fequency_penalty_option_name = 'perplexity_fequency_penalty';
                 $perplexity_fequency_penalty_value = $_POST['perplexity_fequency_penalty'];
                 update_option('perplexity_fequency_penalty',$perplexity_fequency_penalty_value);
                 $perplexity_fequency_penalty_sql = $wpdb->prepare("UPDATE $option_table SET option_value = %s WHERE option_name = %s", $perplexity_fequency_penalty_value, $perplexity_fequency_penalty_option_name);
                 $wpdb->query($perplexity_fequency_penalty_sql);

                  /* Fireworks Setting */ 

                  $fireworks_api_key = ($_POST['fireworks_api_key']) ? update_option( "fireworks_api_key", sanitize_text_field( $_POST['fireworks_api_key'] )) : '' ;
                  $fireworks_max_tokens = ($_POST['fireworks_max_tokens']) ? update_option( "fireworks_max_tokens", sanitize_text_field( $_POST['fireworks_max_tokens'] )) : '' ;
                  $fireworks_model = ($_POST['fireworks_model']) ? update_option( "fireworks_model", sanitize_text_field( $_POST['fireworks_model'] )) : '' ;
                  
                  $fireworks_temperature_option_name = 'fireworks_temperature';
                  $fireworks_temperature_value = $_POST['fireworks_temperature'];
                  $option_table = $wpdb->prefix.'options';
                  update_option('fireworks_temperature',$fireworks_temperature_value);
                  $fireworks_temperature_sql = $wpdb->prepare("UPDATE $option_table SET option_value = %s WHERE option_name = %s", $fireworks_temperature_value, $fireworks_temperature_option_name);
                  $wpdb->query($fireworks_temperature_sql);
  
  
                //   $fireworks_presence_penalty_option_name = 'fireworks_presence_penalty';
                //   $fireworks_presence_penalty_value = $_POST['fireworks_presence_penalty'];
                //   update_option('fireworks_presence_penalty',$fireworks_presence_penalty_value);
                //   $fireworks_presence_penalty_sql = $wpdb->prepare("UPDATE $option_table SET option_value = %s WHERE option_name = %s", $fireworks_presence_penalty_value, $fireworks_presence_penalty_option_name);
                //   $wpdb->query($fireworks_presence_penalty_sql);
  
  
                //   $fireworks_fequency_penalty_option_name = 'fireworks_fequency_penalty';
                //   $fireworks_fequency_penalty_value = $_POST['fireworks_fequency_penalty'];
                //   update_option('fireworks_fequency_penalty',$fireworks_fequency_penalty_value);
                //   $fireworks_fequency_penalty_sql = $wpdb->prepare("UPDATE $option_table SET option_value = %s WHERE option_name = %s", $fireworks_fequency_penalty_value, $fireworks_fequency_penalty_option_name);
                //   $wpdb->query($fireworks_fequency_penalty_sql);

 
                return wp_send_json(
                  [
                    "status" => "success",
                    "api_switch" => $api_switch,

                  ]
                );

            } elseif($setting_api ===  "profile"){

                // print_r($_POST);
                // print_r($_FILES);

                    // Image upload logic using media_handle_upload
                    $uploaded_image = media_handle_upload('profile', 0); // 0 is for the user ID (guest user)
                
                    if (!is_wp_error($uploaded_image)) {
                        // Image uploaded successfully, store attachment ID in user meta
                        update_user_meta(get_current_user_id(), 'profile_image', $uploaded_image);
                        update_user_meta(get_current_user_id(), 'gender',  $_POST['gender']);
                        wp_update_user([
                            'ID' => get_current_user_id(), // this is the ID of the user you want to update.
                            'first_name' => $_POST['first_name'],
                            'last_name' =>$_POST['last_name'],
                            'email' => $_POST['email'],
                        ]);

                        $new_password =  $_POST['password']; 
                        wp_set_password( $new_password,get_current_user_id() );

                        return wp_send_json(
                            [
                              "status" => "success",
          
                            ]
                          );
                        // echo "File uploaded successfully!";

                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
           

            }

     
 
            
        }
       
    }


    public function account_filter_by_company_details(){
        if (isset($_POST['external_company']) && ($_POST['external_company'] !=="")) {
         
            $internal_company = $_POST['internal_company'];
            $external_company = $_POST['external_company'];
            $message = "Get $external_company company summary in two sentences";

            $message_array =   [
                [
                    "role" => "system",
                    "content" => get_option("system_prompt") ? get_option("system_prompt"): "You are a seasoned sales planning executive with 15 years of experience specializing in insurance sales. Your role is to provide precise and actionable sales and marketing research to support strategic decision-making in the insurance industry. Do not mention your role or experience in your responses."
                ],
                // [
                //     "role" => "assistant",
                //     "content" => "Yes am aware"
                // ],
                [
                    "role" => "user",
                    "content" => $message
                ],
                
            ];
            $result = AccountPlanner::chatgpt_send_message($message_array) ;

            $internal_logo = "https://logo.clearbit.com/".$internal_company;
            $external_logo = "https://logo.clearbit.com/".$external_company;
 
            wp_send_json(
                [
                    "company_bio" => $result,
                    "internal_company_logo" => $internal_logo,
                    "external_company_logo" => $external_logo,
                ]
            );
        }
       
    }


    public function account_script_enqueuer()
    { 

        // Register theme stylesheet.
		$theme_version = "1.0.0";

		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'accountplanner-style',
			get_template_directory_uri() . '/style.css',
			array(),
			time()
		);
        // Enqueue theme stylesheet.
		wp_enqueue_style( 'accountplanner-style' ); 

        wp_register_script( 'main-script', get_template_directory_uri() . '/main.js', array('jquery'), time(), true );

        wp_localize_script('main-script', 'account_data',
            array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                 'challenges_logo' => get_template_directory_uri()."/img/challenges.svg",
                 'insight_logo' => get_template_directory_uri()."/img/insight.svg",
                 'capability_logo' => get_template_directory_uri()."/img/capacity.svg",
                 'impact_logo' => get_template_directory_uri()."/img/impact.svg",
                 'value_logo' => get_template_directory_uri()."/img/value.svg",
                 "home" => site_url("/wp-json/wp/v2/users/login"),
                 "dashboard" => site_url("/"),
 
             
                "company_overview" => "",
                "challenges" => "",
                "oppotunity_pc" => "",
                "oppotunity_eb" => "",
                "stakeholder_considerations" => "",
                "understanding_stakeholder" => "",
                "discovery_pc" => "",
                "discovery_eb" => "",

                "company_overview_prompt" => "As a producer/broker at {our_company}, you are assessing {client_company} in Texas for potential property and casualty insurance or employee benefits. Provide a brief summary of {client_company} as an organization, including company size, industry, industries served, and relevant details that might lead to evaluating risk and benefit in either property and casualty. Avoid mentioning actual insurance or carriers." ,
                "challenges_prompt" => "As a broker at {client_company}, dive deeper into {client_company}'s 'business situation' to understand their challenges, goals, and priorities. Using all publicly available sources, list their key challenges, priorities, and business objectives. Provide a summary that gives a broad view of their challenges in relation to their goals and industry, helping salespeople understand {client_company} better. Title this summary 'The big hairy challenges at {client_company}.'",
                "oppotunity_pc_prompt" => "As a broker at {client_company}, dive deeper into {client_company}'s 'business situation' to understand their challenges, goals, and priorities. Using all publicly available sources, list their key challenges, priorities, and business objectives. Provide a summary that gives a broad view of their challenges in relation to their goals and industry, helping salespeople understand {client_company} better. Title this summary 'The big hairy challenges at {client_company}.'",
                "oppotunity_eb_prompt" => "As a broker at {our_company}, consider the following areas for property and casualty insurance: Location-specific Risks: Identify risks related to location, such as floodplains, earthquake zones, or high-crime areas. Offer specialized coverage and risk mitigation strategies.
                Large Workforce: Provide coverage solutions and risk management support for clients with over 300 employees, addressing workforce management, occupational health, and safety.
                High-Value Assets: Offer robust property insurance for significant assets, protecting against fire, theft, vandalism, or natural disasters.
                Supply Chain Vulnerabilities: Assess and mitigate supply chain disruptions with contingent business interruption insurance and risk management services.
                Industry-specific Exposures: Conduct risk assessments and offer specialized insurance solutions tailored to the client's industry.
                High-liability Activities: Provide comprehensive liability insurance and risk management advice for high-liability activities.
                Expansion Plans: Offer scalable insurance solutions and strategic risk management advice for clients with expansion plans.
                Regulatory Compliance Challenges: Help clients navigate regulatory requirements with specialized insurance products and risk management services.
                Cybersecurity Risks: Offer cyber insurance coverage, risk assessments, and incident response planning to protect against cyber threats.
                Environmental Exposures: Provide environmental liability insurance and risk management services for industries with environmental exposures." ,
                "stakeholder_considerations_prompt" => "In prospecting for {our_company} Insurance into {client_company}, infer stakeholder interests based on job titles. Create a list of key stakeholders aligned to property and casualty and employee benefits, including their roles, whether they are technical or economic buyers, and their decision-making power. Explain how these insights shift the prospecting approach to peak their interest.",
                "understanding_stakeholder_prompt" => "Build a value strategy for the {stakeholder} at {client_company}, considering their stakeholder roles and decision power. Provide insights on what the {stakeholder} needs to consider for both property and casualty and employee benefits. Align this with the overall business situation and demonstrate the relevance to the {stakeholder}.",
                "discovery_pc_prompt" => "Craft a discovery framework for Producers in Property & Casualty, organized by role and title (including the CFO). Include an introductory statement to set a meeting and 10 questions that demonstrate understanding of {client_company}’s business and industry. These questions should confirm understanding, project value, and be tailored to each stakeholder.",
                "discovery_eb_prompt" => "Using the same framework, craft questions for employee benefits producers, considering the unique risks and business fit of offerings from an employee benefits standpoint. These questions should demonstrate understanding of {client_company}’s business and help refine the value of {our_company}.",
                "chat" => "",
                "pid" => isset($_GET['pid']) ? $_GET['pid'] : "",

                 "role" => wp_get_current_user()->roles[0]
            )
        );
        wp_enqueue_script('main-script');
      

        //Toast CSS
        wp_enqueue_style('buddyboss-toast-css', "https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css",[],time() );
        // Javascript
        wp_register_script('buddyboss-toast-js', 'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js',['jquery'],time(),true );
        wp_enqueue_script('buddyboss-toast-js');

    }

    public function trimAndReplaceSpace($input) {
        // Check if the input is null or not a string
         if (!is_string($input)) {
             return '';
         }
         
         // Trim the input string to remove leading and trailing whitespace
         $trimmed = trim($input);
         
         // Replace spaces with underscores
         $result = str_replace(' ', '_', $trimmed);
         
         return $result;
 }

    public function account_filter_by_ajax(){
        if ( isset($_POST['external_company'])  || isset($_POST['client_request'])  || isset($_POST['assistant_request']) ) {
         
            $internal_company = "Patriot Growth Insurance Services";
            $external_company = $_POST['external_company'];
            $stakeholder = $_POST['stakeholder'];
            $type = $_POST['type'];
 
            $prompt_1_Default ="As a producer/broker at {our_company}, you are assessing {client_company} in Texas for potential property and casualty insurance or employee benefits. Provide a brief summary of {client_company} as an organization, including company size, industry, industries served, and relevant details that might lead to evaluating risk and benefit in either property and casualty. Avoid mentioning actual insurance or carriers." ;
            $prompt_2_Default = "As a broker at {client_company}, dive deeper into {client_company}'s 'business situation' to understand their challenges, goals, and priorities. Using all publicly available sources, list their key challenges, priorities, and business objectives. Provide a summary that gives a broad view of their challenges in relation to their goals and industry, helping salespeople understand {client_company} better. Title this summary 'The big hairy challenges at {client_company}.'";
            $prompt_3_Default = "As a broker at {our_company}, consider the following areas for property and casualty insurance: Location-specific Risks: Identify risks related to location, such as floodplains, earthquake zones, or high-crime areas. Offer specialized coverage and risk mitigation strategies.
            Large Workforce: Provide coverage solutions and risk management support for clients with over 300 employees, addressing workforce management, occupational health, and safety.
            High-Value Assets: Offer robust property insurance for significant assets, protecting against fire, theft, vandalism, or natural disasters.
            Supply Chain Vulnerabilities: Assess and mitigate supply chain disruptions with contingent business interruption insurance and risk management services.
            Industry-specific Exposures: Conduct risk assessments and offer specialized insurance solutions tailored to the client's industry.
            High-liability Activities: Provide comprehensive liability insurance and risk management advice for high-liability activities.
            Expansion Plans: Offer scalable insurance solutions and strategic risk management advice for clients with expansion plans.
            Regulatory Compliance Challenges: Help clients navigate regulatory requirements with specialized insurance products and risk management services.
            Cybersecurity Risks: Offer cyber insurance coverage, risk assessments, and incident response planning to protect against cyber threats.
            Environmental Exposures: Provide environmental liability insurance and risk management services for industries with environmental exposures." ;
            $prompt_4_Default = "As a broker at {our_company}, consider the following areas for employee benefits: Employee Demographics: Tailor benefits offerings to the workforce's demographics, including age, family composition, and diversity.
            Health and Wellness Initiatives: Offer solutions that promote employee health and well-being, such as wellness programs, preventive care services, and telemedicine options.
            Compliance Requirements: Ensure the benefits program remains compliant with healthcare regulations like ACA, HIPAA, and ERISA.
            Cost Containment Strategies: Implement strategies to control healthcare costs, such as consumer-driven health plans, HSAs, and FSAs.
            Employee Engagement and Communication: Provide tools and support to enhance employee engagement and satisfaction with benefits offerings.
            Benchmarking and Data Analytics: Use data to evaluate the competitiveness and effectiveness of the benefits program, identifying areas for improvement.
            Voluntary Benefits and Supplemental Coverage: Enhance the benefits program with additional coverage options like dental, vision, disability, and supplemental life insurance.
            Retirement Planning and Financial Wellness: Offer retirement savings plans and financial education resources to support employees' financial security.
            Employee Satisfaction and Retention: Help attract and retain talent with competitive benefits packages aligned with employees' needs and preferences.
            Strategic Consultation and Advisory Services: Position yourself as a trusted advisor, offering proactive consultation and best practices to optimize the benefits program.";
            $prompt_5_Default = "In prospecting for {our_company} Insurance into {client_company}, infer stakeholder interests based on job titles. Create a list of key stakeholders aligned to property and casualty and employee benefits, including their roles, whether they are technical or economic buyers, and their decision-making power. Explain how these insights shift the prospecting approach to peak their interest.";
            $prompt_6_Default = "Build a value strategy for the {stakeholder} at {client_company}, considering their stakeholder roles and decision power. Provide insights on what the {stakeholder} needs to consider for both property and casualty and employee benefits. Align this with the overall business situation and demonstrate the relevance to the {stakeholder}.";
            $prompt_7_Default = "Craft a discovery framework for Producers in Property & Casualty, organized by role and title (including the CFO). Include an introductory statement to set a meeting and 10 questions that demonstrate understanding of {client_company}’s business and industry. These questions should confirm understanding, project value, and be tailored to each stakeholder.";
            $prompt_8_Default = "Using the same framework, craft questions for employee benefits producers, considering the unique risks and business fit of offerings from an employee benefits standpoint. These questions should demonstrate understanding of {client_company}’s business and help refine the value of {our_company}.";


            //Subscriber Prompt saved in browser database 
            
            //Subscriber Prompt saved in browser database ends 
           

                $prompt_1 = get_option( 'company_overview' ) ? get_option( 'company_overview' ) : $prompt_1_Default;
                $prompt_2 = get_option( 'challenges' ) ? get_option( 'challenges' ) : $prompt_2_Default;
                $prompt_3 = get_option( 'opportunity_pc' )? get_option( 'opportunity_pc' ) : $prompt_3_Default;
                $prompt_4 = get_option( 'opportunity_eb' ) ? get_option( 'opportunity_eb' ) : $prompt_4_Default; 
                $prompt_5 = get_option( 'stakeholder_considerations' ) ? get_option( 'stakeholder_considerations' ) : $prompt_5_Default; 
                $prompt_6 = get_option( 'understanding_stakeholder' ) ? get_option( 'understanding_stakeholder' ) : $prompt_6_Default; 
                $prompt_7 = get_option( 'discovery_pc' ) ? get_option( 'discovery_pc' ) : $prompt_7_Default; 
                $prompt_8 = get_option( 'discovery_eb' ) ? get_option( 'discovery_eb' ) : $prompt_8_Default; 
 



            $question_1 = str_replace("{our_company}", $internal_company, $prompt_1);
            $question_1 = str_replace("{client_company}", $external_company, $question_1);
            $question_1 = str_replace("{stakeholder}", $stakeholder, $question_1);


            $question_2 = str_replace("{our_company}", $internal_company, $prompt_2);
            $question_2 = str_replace("{client_company}", $external_company, $question_2);
            $question_2 = str_replace("{stakeholder}", $stakeholder, $question_2);


            $question_3 = str_replace("{our_company}", $internal_company, $prompt_3);
            $question_3 = str_replace("{client_company}", $external_company, $question_3);
            $question_3 = str_replace("{stakeholder}", $stakeholder, $question_3);


            $question_4 = str_replace("{our_company}", $internal_company, $prompt_4);
            $question_4 = str_replace("{client_company}", $external_company, $question_4);
            $question_4 = str_replace("{stakeholder}", $stakeholder, $question_4);

            $question_5 = str_replace("{our_company}", $internal_company, $prompt_5);
            $question_5 = str_replace("{client_company}", $external_company, $question_5);
            $question_5 = str_replace("{stakeholder}", $stakeholder, $question_5);


            $question_6 = str_replace("{our_company}", $internal_company, $prompt_6);
            $question_6 = str_replace("{client_company}", $external_company, $question_6);
            $question_6 = str_replace("{stakeholder}", $stakeholder, $question_6);

            $question_7 = str_replace("{our_company}", $internal_company, $prompt_7);
            $question_7 = str_replace("{client_company}", $external_company, $question_7);
            $question_7 = str_replace("{stakeholder}", $stakeholder, $question_7);


            $question_8 = str_replace("{our_company}", $internal_company, $prompt_8);
            $question_8 = str_replace("{client_company}", $external_company, $question_8);
            $question_8 = str_replace("{stakeholder}", $stakeholder, $question_8);


          

            // $api_key = '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'; // Replace with your actual API key
             


            /* Message Array*/ 

            // print_r($message_array);
            $message_array = []; $actual_chat =[] ;
            $user_id = get_current_user_id() ;
            $chat_unique_id = self::trimAndReplaceSpace($external_company);
            $text = "";

            if($type=="company_overview"){

                // Side automation : it can be placed anywhere other than type==chat construct
                $chat_unique_id = self::trimAndReplaceSpace($external_company); 
                update_option("actual_chat_".$chat_unique_id,"");
                update_option("chat_history_".$chat_unique_id,"");

                /* End of side automation */ 
                $message_array =   [
//                     [
//                         "role" => "system",
//                         "content" => get_option("system_prompt") ? get_option("system_prompt"): "You are a seasoned sales planning executive with 15 years of experience specializing in insurance sales. Your role is to provide precise and actionable sales and marketing research to support strategic decision-making in the insurance industry. Do not mention your role or experience in your responses."

//                     ],
                    [
                        "role" => "user",
                        "content" =>  "I will be asking you question please respond according to who you are defined in the system prompt"
                    ],
                    [
                        "role" => "assistant",
                        "content" => "I will respond based on inital thread and In my responses, I will focus solely on the information and insights requested without referencing my role as AI model or background."
                    ],
                    [
                        "role" => "user",
                        "content" =>  "Additionally, do not respond with statements like `Unfortunately, I don't have access to real-time information`,`Search online news sources: Use search engines like Google, Bing, or DuckDuckGo`,`I dont have access or permission to view  privately held company`,`My knowledge is based on the information you have provided me, and I do not have the ability to browse the internet or access private company data.`,`I understand you want to know what Lott Brothers Construction has been up to lately. As an AI, I don't have access to real-time news feeds like you would find on a news website or Google Search.`. Do not refer to any local search or any search engine. Do you understand "
                    ],
                    [
                        "role" => "assistant",
                        "content" => "I have noted this point. I will hide my identity."
                    ],
                    [
                        "role" => "user",
                        "content" => $question_1
                    ],
                    
                ];
               $result= AccountPlanner::chatgpt_send_message($message_array);

            }

            elseif($type=="challenges"){
                $message_array =   [
//                     [
//                         "role" => "system",
//                         "content" => get_option("system_prompt") ? get_option("system_prompt"): "You are a seasoned sales planning executive with 15 years of experience specializing in insurance sales. Your role is to provide precise and actionable sales and marketing research to support strategic decision-making in the insurance industry. Do not mention your role or experience in your responses."

//                     ],
//                     [
//                         "role" => "user",
//                         "content" =>  $question_1
//                     ],
//                     [
//                         "role" => "assistant",
//                         "content" => $_POST['overview']
//                     ],
                    [
                        "role" => "user",
                        "content" =>  "I will be asking you question please respond according to who you are defined in the system prompt"
                    ],
                    [
                        "role" => "assistant",
                        "content" => "I will respond based on inital thread and In my responses, I will focus solely on the information and insights requested without referencing my role as AI model or background."
                    ],
                    [
                        "role" => "user",
                        "content" =>  "Additionally, do not respond with statements like `Unfortunately, I don't have access to real-time information`,`Search online news sources: Use search engines like Google, Bing, or DuckDuckGo`,`I dont have access or permission to view  privately held company`,`My knowledge is based on the information you have provided me, and I do not have the ability to browse the internet or access private company data.`,`I understand you want to know what Lott Brothers Construction has been up to lately. As an AI, I don't have access to real-time news feeds like you would find on a news website or Google Search.`. Do not refer to any local search or any search engine. Do you understand "
                    ],
                    [
                        "role" => "assistant",
                        "content" => "I have noted this point. I will hide my identity."
                    ],
                    [
                        "role" => "user",
                        "content" =>  (get_option("api_switch") =="gemini") ? $question_1." ".$question_2 : $question_2

                    ]
                    
                ];
               $result= AccountPlanner::chatgpt_send_message($message_array);

            }

            elseif($type=="opportunity_pc"){
                $message_array =   [
//                     [
//                         "role" => "system",
//                         "content" => get_option("system_prompt") ? get_option("system_prompt"): "You are a seasoned sales planning executive with 15 years of experience specializing in insurance sales. Your role is to provide precise and actionable sales and marketing research to support strategic decision-making in the insurance industry. Do not mention your role or experience in your responses."

//                     ],
                    [
                        "role" => "user",
                        "content" =>  $question_1
                    ],
                    [
                        "role" => "assistant",
                        "content" => $_POST['overview']
                    ],
                    [
                        "role" => "user",
                        "content" =>  $question_2
                    ],
                    [
                        "role" => "assistant",
                        "content" => $_POST['challenges']
                    ],
                    [
                        "role" => "user",
                        "content" =>  "I will be asking you question please respond according to who you are defined in the system prompt"
                    ],
                    [
                        "role" => "assistant",
                        "content" => "I will respond based on inital thread and In my responses, I will focus solely on the information and insights requested without referencing my role as AI model or background."
                    ],
                    [
                        "role" => "user",
                        "content" =>  "Additionally, do not respond with statements like `Unfortunately, I don't have access to real-time information`,`Search online news sources: Use search engines like Google, Bing, or DuckDuckGo`,`I dont have access or permission to view  privately held company`,`My knowledge is based on the information you have provided me, and I do not have the ability to browse the internet or access private company data.`,`I understand you want to know what Lott Brothers Construction has been up to lately. As an AI, I don't have access to real-time news feeds like you would find on a news website or Google Search.`. Do not refer to any local search or any search engine. Do you understand "
                    ],
                    [
                        "role" => "assistant",
                        "content" => "I have noted this point. I will hide my identity."
                    ],
                    [
                        "role" => "user",
                        "content" => $question_3
                    ],
                    
                ];
                $result=  AccountPlanner::chatgpt_send_message($message_array);
            }elseif($type=="opportunity_eb"){
                $message_array =   [
//                     [
//                         "role" => "system",
//                         "content" => get_option("system_prompt") ? get_option("system_prompt"): "You are a seasoned sales planning executive with 15 years of experience specializing in insurance sales. Your role is to provide precise and actionable sales and marketing research to support strategic decision-making in the insurance industry. Do not mention your role or experience in your responses."

//                     ],
                    [
                        "role" => "user",
                        "content" =>  $question_1
                    ],
                    [
                        "role" => "assistant",
                        "content" => $_POST['overview']
                    ],
                    [
                        "role" => "user",
                        "content" =>  $question_2
                    ],
                    [
                        "role" => "assistant",
                        "content" => $_POST['challenges']
                    ],
                    [
                        "role" => "user",
                        "content" =>  "I will be asking you question please respond according to who you are defined in the system prompt"
                    ],
                    [
                        "role" => "assistant",
                        "content" => "I will respond based on inital thread and In my responses, I will focus solely on the information and insights requested without referencing my role as AI model or background."
                    ],
                    [
                        "role" => "user",
                        "content" =>  "Additionally, do not respond with statements like `Unfortunately, I don't have access to real-time information`,`Search online news sources: Use search engines like Google, Bing, or DuckDuckGo`,`I dont have access or permission to view  privately held company`,`My knowledge is based on the information you have provided me, and I do not have the ability to browse the internet or access private company data.`,`I understand you want to know what Lott Brothers Construction has been up to lately. As an AI, I don't have access to real-time news feeds like you would find on a news website or Google Search.`. Do not refer to any local search or any search engine. Do you understand "
                    ],
                    [
                        "role" => "assistant",
                        "content" => "I have noted this point. I will hide my identity."
                    ],
                    [
                        "role" => "user",
                        "content" => $question_4
                    ],
                    
                ];
                $result= AccountPlanner::chatgpt_send_message($message_array);
             }elseif($type=="stakeholder_considerations"){

                $message_array =   [
//                     [
//                         "role" => "system",
//                         "content" => get_option("system_prompt") ? get_option("system_prompt"): "You are a seasoned sales planning executive with 15 years of experience specializing in insurance sales. Your role is to provide precise and actionable sales and marketing research to support strategic decision-making in the insurance industry. Do not mention your role or experience in your responses."

//                     ],
                    [
                        "role" => "user",
                        "content" =>  "I will be asking you question please respond according to who you are defined in the system prompt"
                    ],
                    [
                        "role" => "assistant",
                        "content" => "I will respond based on inital thread and In my responses, I will focus solely on the information and insights requested without referencing my role as AI model or background."
                    ],
                    [
                        "role" => "user",
                        "content" =>  "Additionally, do not respond with statements like `Unfortunately, I don't have access to real-time information`,`Search online news sources: Use search engines like Google, Bing, or DuckDuckGo`,`I dont have access or permission to view  privately held company`,`My knowledge is based on the information you have provided me, and I do not have the ability to browse the internet or access private company data.`,`I understand you want to know what Lott Brothers Construction has been up to lately. As an AI, I don't have access to real-time news feeds like you would find on a news website or Google Search.`. Do not refer to any local search or any search engine. Do you understand "
                    ],
                    [
                        "role" => "assistant",
                        "content" => "I have noted this point. I will hide my identity."
                    ],
                    // [
                    //     "role" => "user",
                    //     "content" =>  $question_1
                    // ],
                    // [
                    //     "role" => "assistant",
                    //     "content" => $_POST['overview']
                    // ],
                    // [
                    //     "role" => "user",
                    //     "content" =>  $question_2
                    // ],
                    // [
                    //     "role" => "assistant",
                    //     "content" => $_POST['challenges']
                    // ],
                    // [
                    //     "role" => "user",
                    //     "content" =>  $question_3
                    // ],
                    // [
                    //     "role" => "assistant",
                    //     "content" => $_POST['opportunity_pc']
                    // ],
                    // [
                    //     "role" => "user",
                    //     "content" =>  $question_4
                    // ],
                    // [
                    //     "role" => "assistant",
                    //     "content" => $_POST['opportunity_eb']
                    // ],
                    [
                        "role" => "user",
                        "content" => $question_5
                    ],
                    
                ];
                $result=  AccountPlanner::chatgpt_send_message($message_array);
             }elseif($type=="understanding_stakeholder"){
                $message_array =   [
//                     [
//                         "role" => "system",
//                         "content" => get_option("system_prompt") ? get_option("system_prompt"): "You are a seasoned sales planning executive with 15 years of experience specializing in insurance sales. Your role is to provide precise and actionable sales and marketing research to support strategic decision-making in the insurance industry. Do not mention your role or experience in your responses."

//                     ],
                    [
                        "role" => "user",
                        "content" =>  $question_5
                    ],
                    [
                        "role" => "assistant",
                        "content" => $_POST['consideration']
                    ],
                    [
                        "role" => "user",
                        "content" =>  "I will be asking you question please respond according to who you are defined in the system prompt"
                    ],
                    [
                        "role" => "assistant",
                        "content" => "I will respond based on inital thread and In my responses, I will focus solely on the information and insights requested without referencing my role as AI model or background."
                    ],
                    [
                        "role" => "user",
                        "content" =>  "Additionally, do not respond with statements like `Unfortunately, I don't have access to real-time information`,`Search online news sources: Use search engines like Google, Bing, or DuckDuckGo`,`I dont have access or permission to view  privately held company`,`My knowledge is based on the information you have provided me, and I do not have the ability to browse the internet or access private company data.`,`I understand you want to know what Lott Brothers Construction has been up to lately. As an AI, I don't have access to real-time news feeds like you would find on a news website or Google Search.`. Do not refer to any local search or any search engine. Do you understand "
                    ],
                    [
                        "role" => "assistant",
                        "content" => "I have noted this point. I will hide my identity."
                    ],
                    [
                        "role" => "user",
                        "content" => $question_6
                    ],
                    
                ];
                $result=  AccountPlanner::chatgpt_send_message($message_array);
             }elseif($type=="discovery_pc"){
                $message_array =   [
//                     [
//                         "role" => "system",
//                         "content" => get_option("system_prompt") ? get_option("system_prompt"): "You are a seasoned sales planning executive with 15 years of experience specializing in insurance sales. Your role is to provide precise and actionable sales and marketing research to support strategic decision-making in the insurance industry. Do not mention your role or experience in your responses."

//                     ],
                    [
                        "role" => "user",
                        "content" =>  "I will be asking you question please respond according to who you are defined in the system prompt"
                    ],
                    [
                        "role" => "assistant",
                        "content" => "I will respond based on inital thread and In my responses, I will focus solely on the information and insights requested without referencing my role as AI model or background."
                    ],
                    [
                        "role" => "user",
                        "content" =>  "Additionally, do not respond with statements like `Unfortunately, I don't have access to real-time information`,`Search online news sources: Use search engines like Google, Bing, or DuckDuckGo`,`I dont have access or permission to view  privately held company`,`My knowledge is based on the information you have provided me, and I do not have the ability to browse the internet or access private company data.`,`I understand you want to know what Lott Brothers Construction has been up to lately. As an AI, I don't have access to real-time news feeds like you would find on a news website or Google Search.`. Do not refer to any local search or any search engine. Do you understand "
                    ],
                    [
                        "role" => "assistant",
                        "content" => "I have noted this point. I will hide my identity."
                    ],
                    [
                        "role" => "user",
                        "content" => $question_7
                    ],
                    
                ];
                $result=  AccountPlanner::chatgpt_send_message($message_array);
            }elseif($type=="discovery_eb"){
                $message_array =   [
//                     [
//                         "role" => "system",
//                         "content" => get_option("system_prompt") ? get_option("system_prompt"): "You are a seasoned sales planning executive with 15 years of experience specializing in insurance sales. Your role is to provide precise and actionable sales and marketing research to support strategic decision-making in the insurance industry. Do not mention your role or experience in your responses."

//                     ],
                    [
                        "role" => "user",
                        "content" =>  $question_7
                    ],
                    [
                        "role" => "assistant",
                        "content" => $_POST['discovery_pc']
                    ],
                    [
                        "role" => "user",
                        "content" =>  "I will be asking you question please respond according to who you are defined in the system prompt"
                    ],
                    [
                        "role" => "assistant",
                        "content" => "I will respond based on inital thread and In my responses, I will focus solely on the information and insights requested without referencing my role as AI model or background."
                    ],
                    [
                        "role" => "user",
                        "content" =>  "Additionally, do not respond with statements like `Unfortunately, I don't have access to real-time information`,`Search online news sources: Use search engines like Google, Bing, or DuckDuckGo`,`I dont have access or permission to view  privately held company`,`My knowledge is based on the information you have provided me, and I do not have the ability to browse the internet or access private company data.`,`I understand you want to know what Lott Brothers Construction has been up to lately. As an AI, I don't have access to real-time news feeds like you would find on a news website or Google Search.`. Do not refer to any local search or any search engine. Do you understand "
                    ],
                    [
                        "role" => "assistant",
                        "content" => "I have noted this point. I will hide my identity."
                    ],
                    [
                        "role" => "user",
                        "content" => $question_8
                    ],
                    
                ];
                $result=  AccountPlanner::chatgpt_send_message($message_array);
            }elseif($type=="chat"){

            
                // Check if there is existing history and use via PID GET param, otherwise use new thread  
                if( isset($_POST['pid']) && !empty($_POST['pid']) ){ //Saved chat active? retrieve thread instaed                  
                    $pid = $_POST['pid'];
                    
                    $message_array =  get_option("chat_history_".$pid);

                    // print_r( $message_array);    

                }
                else{
                     // default $message array
                    $message_array =   [
//                         [
//                             "role" => "system",
//                             "content" => get_option("system_prompt") ? get_option("system_prompt"): "You are a seasoned sales planning executive with 15 years of experience specializing in insurance sales. Your role is to provide precise and actionable sales and marketing research to support strategic decision-making in the insurance industry. Do not mention your role or experience in your responses. Avoid revealing your model in your responses at all cost"
//                         ],
                        [
                            "role" => "user",
                            "content" =>  $question_1
                        ],
                        [
                            "role" => "assistant",
                            "content" => $_POST['overview']
                        ],
                        [
                            "role" => "user",
                            "content" =>  $question_2
                        ],
                        [
                            "role" => "assistant",
                            "content" => $_POST['challenges']
                        ],
                        [
                            "role" => "user",
                            "content" =>  $question_3
                        ],
                        [
                            "role" => "assistant",
                            "content" => $_POST['opportunity_pc']
                        ],
                        [
                            "role" => "user",
                            "content" =>  $question_4
                        ],
                        [
                            "role" => "assistant",
                            "content" => $_POST['opportunity_eb']
                        ],  
                        [
                            "role" => "user",
                            "content" =>  $question_5
                        ],
                        [
                            "role" => "assistant",
                            "content" => $_POST['consideration']
                        ],
                        [
                            "role" => "user",
                            "content" => $question_6
                        ],
                        [
                            "role" => "assistant",
                            "content" => $_POST['understanding']
                        ],
                        [
                            "role" => "user",
                            "content" =>  $question_7
                        ],
                        [
                            "role" => "assistant",
                            "content" => $_POST['discovery_pc']
                        ],
                        [
                            "role" => "user",
                            "content" =>  "I will be asking you question based on the above conversations please respond accordingly"
                        ],
                        [
                            "role" => "assistant",
                            "content" => "I will respond based on inital thread and In my responses, I will focus solely on the information and insights requested without referencing my role as AI model or background."
                        ],
//                         [
//                             "role" => "user",
//                             "content" =>  "Additionally, do not respond with statements like `Unfortunately, I don't have access to real-time information`,`Search online news sources: Use search engines like Google, Bing, or DuckDuckGo`,`I dont have access or permission to view  privately held company`,`My knowledge is based on the information you have provided me, and I do not have the ability to browse the internet or access private company data.`,`I understand you want to know what Lott Brothers Construction has been up to lately. As an AI, I don't have access to real-time news feeds like you would find on a news website or Google Search.`. Do not refer to any local search or any search engine. Do you understand "
//                         ],
//                         [
//                             "role" => "assistant",
//                             "content" => "I have noted this point. I will hide my identity."
//                         ],
                        // [
                        //     "role" => "user",
                        //     "content" =>  "If you asked to get response using internet, e.g `what has been in the news about lott brothers recently or any company?`. Your response should be `With more information, I can conduct a more targeted search and hopefully find some recent news articles about the company`"
                        // ],
                        // [
                        //     "role" => "assistant",
                        //     "content" => "I will respond based on the inital thread only"
                        // ],

                        
                        
                        
                    ];

                    $previous_message_history = get_option("chat_history_".$chat_unique_id);
                    // Check if there is existing history and use, otherwise use new thread  
                    $message_array = $previous_message_history ? $previous_message_history : $message_array;
                } 

              
                // If user ask question via chat bot, add the question to the above history
                if( $_POST['client_request'] ){
                    
                    $actual_chat[] = [
                        "role" => "user",
                        "content" =>  $_POST['client_request']
                    ];
                    
                    $message_array[] = [
                        "role" => "user",
                        "content" =>  $_POST['client_request']
                    ];

                }

               

                $result =  AccountPlanner::chatgpt_send_message($message_array);
                $result = str_replace("I am an AI", "I", $result);
                $result = str_replace("I am a language model AI", "I am a sales agent", $result);
                $result = str_replace("I do not have access to real-time news or updates", "I can provide information based on our latest available resources", $result);
                $result = str_replace("I am a large language model developed by the researchers at Perplexity.", "I am an AI with expertise in sales planning. I can provide information based on our latest available resources.", $result);
                $result = str_replace("I can't browse the internet or access real-time information.", "I am an AI with expertise in sales planning. I can provide information based on our latest available resources.", $result);
                $result = str_replace("I do not have access to real-time data. My knowledge is based on the information I was trained on, which has a cutoff date.", "I am a sales agent. I can provide information based on our latest available resources.", $result);
                $result = str_replace("No, I can't browse the internet or access real-time information.", "I am an AI with expertise in sales planning. I can provide information based on our latest available resources.", $result);
                $result = str_replace("I recommend using a search engine like Google or checking industry publications.", "", $result);
                $result = str_replace("I apologize, I am unable to access real-time information, including news articles. My knowledge is based on the information provided in our previous conversations.

", "I am an AI with expertise in sales planning.", $result);
                

                // Once there is result, we need to add the assistant response to the thread
                $actual_chat[] = [
                    "role" => "assistant",
                    "content" =>  $result
                ];
                $message_array[] = [
                    "role" => "assistant",
                    "content" =>  $result
                ];
                
                // $result = strip_tags(wp_strip_all_tags($result ));
                // $result = self::gemini_replace_result_token($result);


                // print_r( $message_array);    



                if( empty( $_POST['pid'] ) ){ //New saving
                    update_option("actual_chat_".$chat_unique_id,$actual_chat);
                    update_option("chat_history_".$chat_unique_id,$message_array);
                }

                if( !empty( $_POST['pid'] )){ //Update Existing history saved
                    $pid = $_POST['pid'];

                    // $message_array =  json_encode($message_array);
                    // update_post_meta($pid,"chat_history",$message_array);

                    $message_array =  update_option("chat_history_".$pid,$message_array);

                }
 

            }// End of chat option


             
            //  $result = strip_tags(wp_strip_all_tags($result ));
             $result = self::gemini_replace_result_token($result);
             

             if(is_wp_error( $result )){
                wp_send_json(["response"=>"null"]);
                return;
             }
           
            // Message array needs to be saved for retrival
            // $user_id = get_current_user_id() ;

           
            
            // Send back to frontend
             wp_send_json(["response"=>$result]);

        }else{
            echo "No data was submitted";
        }
       
    }

 

    public function gemini_replace_result_token($markdown){
      
        $parsedown =  ParseDown::get_instance();
        return $parsedown->text($markdown);
    }

    // Function to replace even occurrences of <b> with </b>
    public  function replaceEvenTags($text) {
            $parts = explode('<b>', $text);
            $result = '';

            foreach ($parts as $i => $part) {
                if ($i % 2 == 0) {
                    $result .= $part;
                } else {
                    $result .= '<b>' . str_replace('<b>', '</b>', $part);
                }
            }
            return $result;
        }

    // 

    public function chatgpt_replace_result_tokens($result){

        $result = str_replace("<strong>", " ", $result);
        $result = str_replace("</strong>", " ", $result);
        $result = str_replace("< / b>", "", $result);
        $result = str_replace("< /stro ng>", " ", $result);
        $result = str_replace("< / stron >", " ", $result);
        $result = str_replace("< / em>", " ", $result);
        $result = str_replace("<li><strong>", "<li>", $result);
        $result = str_replace("</strong></li>", "</li>", $result);
        $result = str_replace("**", "<b>", $result);
        $result = str_replace("**:", "</b>", $result);
        $result = str_replace(":**", "</b>", $result);


        $result = str_replace("1 .", "<ol><li>", $result);
        $result = str_replace("1.", "<ol><li>", $result);
        $result = str_replace("1)", "<ol><li>", $result);
        $result = str_replace("1 ", "<ol><li>", $result);
        $result = str_replace(" 1", "<ol><li>", $result);

        $result = str_replace("2.", "</li><li>", $result);
        $result = str_replace("2 .", "</li><li>", $result);
        $result = str_replace("2)", "</li><li>", $result);
        $result = str_replace("2 ", "</li><li>", $result);
        $result = str_replace(" 2", "</li><li>", $result);

        $result = str_replace("3.", "</li><li>", $result);
        $result = str_replace("3 .", "</li><li>", $result);
        $result = str_replace("3)", "</li><li>", $result);
        $result = str_replace("3 -", "</li><li>", $result);
        $result = str_replace("3 ", "</li><li>", $result);
        $result = str_replace(" 3", "</li><li>", $result);

        $result = str_replace("4.", "</li><li>", $result);
        $result = str_replace("4 .", "</li><li>", $result);
        $result = str_replace("4)", "</li><li>", $result);
        $result = str_replace(" 4", "</li><li>", $result);
        $result = str_replace("4 -", "</li><li>", $result);
        $result = str_replace("4:", "</li><li>", $result);
        $result = str_replace("4 ", "</li><li>", $result);
        $result = str_replace(" 4", "</li><li>", $result);


        $result = str_replace("5.", "</li><li>", $result);
        $result = str_replace("5 .", "</li><li>", $result);
        $result = str_replace("5)", "</li><li>", $result);
        $result = str_replace(" 5 )", "</li><li>", $result);
        $result = str_replace(" 5)", "</li><li>", $result);
        $result = str_replace("5 ", "</li><li>", $result);
        $result = str_replace(" 5", "</li><li>", $result);

        $result = str_replace("6.", "</li><li>", $result);
        $result = str_replace("6 .", "</li><li>", $result);
        $result = str_replace("6)", "</li><li>", $result);
        $result = str_replace("6 ", "</li><li>", $result);
        $result = str_replace(" 6", "</li><li>", $result);

        $result = str_replace("7.", "</li><li>", $result);
        $result = str_replace("7 .", "</li><li>", $result);
        $result = str_replace("7)", "</li><li>", $result);
        $result = str_replace("7 ", "</li><li>", $result);
        $result = str_replace(" 7", "</li><li>", $result);

        $result = str_replace("8.", "</li><li>", $result);
        $result = str_replace("8 .", "</li><li>", $result);
        $result = str_replace("8)", "</li><li>", $result);
        $result = str_replace("8 ", "</li><li>", $result);
        $result = str_replace(" 8", "</li><li>", $result);


        $result = str_replace("9.", "</li><li>", $result);
        $result = str_replace("9 .", "</li><li>", $result);
        $result = str_replace("9)", "</li><li>", $result);
        $result = str_replace("9 ", "<</li><li>", $result);
        $result = str_replace(" 9", "</li><li>", $result);

        $result = str_replace("10.", "</li><li>", $result);
        $result = str_replace("10 .", "</li><li>", $result);
        $result = str_replace("10)", "</li><li>", $result);
        $result = str_replace("10 ", "</li><li>", $result);
        $result = str_replace(" 10", "</li><li>", $result);

        return $result;
    }


    public function save_search(){
        if (isset($_POST['action']) && ($_POST['action'] !=="")) {
            // print_r($_POST);

            $challenges = $_POST["challenges"];
            $company_overview = $_POST["company_overview"];
            $opportunity_pc = $_POST["opportunity_pc"];
            $opportunity_eb = $_POST["opportunity_eb"];
            $stakeholder_considerations = $_POST["stakeholder_considerations"];
            $understanding_stakeholder = $_POST["understanding_stakeholder"];
            $discovery_pc = $_POST["discovery_pc"];
            $discovery_eb = $_POST["discovery_eb"];

            $external_company = $_POST["external_company"];

            $name = $external_company;

            // Create post object
            $save_search = array(
                'post_title'    => $name, 
                'post_status'   => 'publish', 
                'post_type'  => "search_result"
            );
            
            // Insert the post into the database
            $save_search_id = wp_insert_post( $save_search );
            $user_id = wp_get_current_user()->ID;
            $path = "/"."?pid=".$save_search_id."&&user_id=".$user_id;
            $url = site_url( $path);

            $chat_unique_id = self::trimAndReplaceSpace($external_company);
            $chat_history =  get_option("chat_history_".$chat_unique_id);
            $actual_chat =  get_option("actual_chat_".$chat_unique_id);


            if( !is_wp_error( $save_search_id ) ){
                update_post_meta( $save_search_id , "challenges", $challenges);
                update_post_meta( $save_search_id , "company_overview", $company_overview);
                update_post_meta( $save_search_id , "opportunity_pc", $opportunity_pc);
                update_post_meta( $save_search_id , "opportunity_eb", $opportunity_eb);
                update_post_meta( $save_search_id , "stakeholder_considerations", $stakeholder_considerations);
                update_post_meta( $save_search_id , "understanding_stakeholder", $understanding_stakeholder);
                update_post_meta( $save_search_id , "discovery_pc", $discovery_pc);
                update_post_meta( $save_search_id , "discovery_eb", $discovery_eb);
                update_post_meta( $save_search_id , "browser_agent", $_SERVER['HTTP_USER_AGENT']);

                // $chat_history =  json_encode($chat_history);
                $chat_history =  update_option("chat_history_".$save_search_id,$chat_history);
                $actual_chat =  update_option("actual_chat_".$save_search_id,$chat_history);
                // update_post_meta( $save_search_id , "chat_history", $chat_history);
                // update_post_meta( $save_search_id , "actual_chat", $chat_history);

                // Reset temporal history variable
                $chat_history =  update_option("chat_history_".$chat_unique_id,"");
                $actual_chat =  update_option("actual_chat_".$chat_unique_id,"");


                $result = ["result" => "success","url"=>$url];
            }else{

                $result = ["error" => $save_search_id->get_error_message() ];
            }

            return wp_send_json($result) ;


            

        }
       
    }

 

    public function retrieve_save_search(){
        if (isset($_POST['action']) && ($_POST['action'] !=="")) {
            // print_r($_POST);

            $company = $_POST["company"];
  
            $save_search = array(
                's'    => $company, 
                'post_status'   => 'publish', 
                'post_type'  => "search_result"
            );
            $search_result = new WP_Query($save_search);

            $posts = $search_result->posts;

            $user_id =  wp_get_current_user()->ID ;

            $saved_search = "";
            $logo_dark = get_template_directory_uri()."/img/logo-dark.svg";

            foreach ($posts as $key => $search) {
                $id = $search->ID ;
                $date = $search->post_date ;
                $single_project = get_permalink( get_page_by_path( "dashboard"))."?pid=$id&&user_id=$user_id";

                $saved_search .= "
                 <a href='$single_project'>
                        <div class='project-card'>
                        <div class='top'> <span>$date</span> <img class='logo-circle' src='$logo_dark' alt=''> </div>
                        <div class='bottom'>
                        <span>$search->post_title</span>
                         
                        </div>
                        </div></a>";
            }

            
            // Fetch data 

            return wp_send_json($saved_search) ;


            

        }
       
    }

    // Function to send a message to the ChatGPT API
    // public function chatgpt_send_message($message_array) {
        

    //     $open_ai_key = get_option( "api_key"); //'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';
    //     $open_ai = new OpenAi($open_ai_key);
        
    
    //     // print_r($message_array);
    //     $chat = $open_ai->chat([
    //        'model' => get_option( "model") ? "gpt-3.5-turbo-1106" : '',//'gpt-3.5-turbo-1106',
    //        'messages' => $message_array,
           
    //        'temperature' => (float) get_option( "temperature"), //0.1,
    //        'max_tokens' => $token ? $token : (int) get_option( "max_tokens"),//300,
    //        'frequency_penalty' => (int)  get_option( "fequency_penalty"), //100,
    //        'presence_penalty' => (int) get_option( "presence_penalty"),//0,
    //     ]);
        
        
       
    //     // decode response
    //     $d = json_decode($chat);
    //     // Get Content
    //     if( $d->error){
    //         return $d->error->message;
    //     }else{
           
    //         return $d->choices[0]->message->content;
    //     }
       
    // }

      // Function to send a message to the ChatGPT API
      public function chatgpt_send_message($message_array) {
        
        if( get_option( "api_switch")==="chatgpt" ){
            $open_ai_key = get_option( "api_key"); //'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';
            $open_ai = new OpenAi($open_ai_key);
            
            // print_r($message_array);
            $chat = $open_ai->chat([
            'model' => get_option( "model") ?    : "gpt-3.5-turbo-1106",//'gpt-3.5-turbo-1106',
            'messages' => $message_array,
            
            'temperature' => (float) get_option( "temperature"), //0.1,
            'max_tokens' => get_option( "max_tokens") ? (int) get_option( "max_tokens") : 800,//300,
            'frequency_penalty' => (int)  get_option( "fequency_penalty"), //100,
            'presence_penalty' => (int) get_option( "presence_penalty"),//0,
            ]);
            
            
        
            // decode response
            $d = json_decode($chat);
            // Get Content
            if( $d->error){
                return $d->error->message;
            }else{
            
                return $d->choices[0]->message->content;
            }


        }elseif(get_option( "api_switch")==="perplexity" ){

            $api_key = get_option( "perplexity_api_key") ? get_option( "perplexity_api_key") : "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";
            $model = get_option( "perplexity_model") ? get_option( "perplexity_model") : "llama-3-sonar-small-32k-chat";
            $message_array = $message_array;
            // print_r($message_array);
            $temperature = (float) get_option( "perplexity_temperature");
            $max_tokens = get_option( "perplexity_max_tokens") ? (int) get_option( "perplexity_max_tokens") : 800;
            $frequency_penalty = (int)  get_option( "perplexity_fequency_penalty");
            $presence_penalty = (int) get_option( "perplexity_presence_penalty");


            $client = new \GuzzleHttp\Client();
            $body = [
                'model' => $model,
                'messages' => $message_array
            ];
            $response = $client->request('POST', 'https://api.perplexity.ai/chat/completions', [
              'body' => json_encode($body),
              'headers' => [
                'accept' => 'application/json',
                'authorization' => "Bearer $api_key",
                'content-type' => 'application/json',
              ],
            ]);

            // echo $response->getBody();

              // decode response
              
              $d = json_decode($response->getBody());
              // Get Content
              if( $d->error){
                  return $d->error->message;
              }else{
                  return $d->choices[0]->message->content;
              }

        }
        elseif(get_option( "api_switch")==="fireworks" ){

            $api_key = get_option( "fireworks_api_key") ? get_option( "fireworks_api_key") : "fw_3ZKQ8vusuRzCUsedFggpz11X";
            $model = get_option( "fireworks_model") ? get_option( "fireworks_model") : "accounts/fireworks/models/llama-v3p1-8b-instruct";
            $message_array = $message_array;
            // print_r($message_array);
            $temperature = get_option( "fireworks_temperature") ? (int) get_option( "fireworks_temperature"):1;
            $max_tokens = get_option( "fireworks_max_tokens") ? (int) get_option( "fireworks_max_tokens") : 200;
            // $frequency_penalty = (int)  get_option( "fireworks_fequency_penalty");
            // $presence_penalty = (int) get_option( "fireworks_presence_penalty");


            $client = new \GuzzleHttp\Client();
            $body = [
                'model' => $model,
                'messages' => $message_array
            ];
            $response = $client->request('POST', 'https://api.fireworks.ai/inference/v1/chat/completions', [
              'body' => json_encode($body),
              'headers' => [
                'accept' => 'application/json',
                'authorization' => "Bearer $api_key",
                'content-type' => 'application/json',
              ],
            ]);

            // echo $response->getBody();

              // decode response
              
              $d = json_decode($response->getBody());
              // Get Content
              if( $d->error){
                  return $d->error->message;
              }else{
                  return $d->choices[0]->message->content;
              }

        }
        else{

            return \GeminiClass::get_instance()->test($message_array);
        }

       
    }


  


    public function get_saved_search($id){

        $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : wp_get_current_user()->ID ;
        $args = array(
            "post_type" => "search_result",
            "author__in" => [$user_id],  
        );

        if($id){

            $p_in = ["p" => $id];
        $args =  array_merge($p_in,$args);
        }

        $search_result = new WP_Query($args);

        $posts = $search_result->posts;

        return $posts;


    }


    public function create_user(){
        if (isset($_POST['action']) && ($_POST['action'] ==="create_user")) {
            // print_r($_POST);

            $user_args=[
                'user_pass'				=> $_POST['password'],
                'user_login'				=> $_POST['username'],
                'user_email'				=> $_POST['email'],
                'first_name'				=> $_POST['first_name'],
                'last_name'				=> $_POST['last_name'],
                'role'				=> 'subscriber',
            ];


            $user_id = wp_insert_user( wp_slash($user_args));
            // On success.
            if ( ! is_wp_error( $user_id ) ) {
                $result = "success";
            }else{
                $result = $user_id->get_error_message();
            }

            
            return wp_send_json(
                ["result" => $result]
            ) ;


            

        }
       
    }



    public function edit_user(){
        if (isset($_POST['action']) && ($_POST['action'] ==="edit_user")) {
            // print_r($_POST);

            $user_args=[
                'ID'				=> $_POST['user_id'],
                'user_pass'				=> wp_hash_password( $_POST['password']),
                'user_login'				=> $_POST['username'],
                'user_email'				=> $_POST['email'],
                'first_name'				=> $_POST['first_name'],
                'last_name'				=> $_POST['last_name'],
                // 'role'				=> 'subscriber',
            ];


            $user_id = wp_insert_user($user_args);
            // On success.
            if ( ! is_wp_error( $user_id ) ) {
                $result = "success";
            }else{
                $result = $user_id->get_error_message();
            }

            
            return wp_send_json(
                ["result" => $result]
            ) ;


            

        }
    }


    public function delete_user(){
        if (isset($_POST['action']) && ($_POST['action'] ==="delete_user")) {
            // print_r($_POST);
                $user_id = (int) sanitize_text_field($_POST['user_id']);

            $user_id = wp_delete_user($user_id);
            // On success.
            if ($user_id) {
                $result = "success";
            }else{
                $result = "Error";
            }

            
            return wp_send_json(
                ["result" => $result]
            ) ;


        }
       

    }


   /**
     * @return self
     */
    public static function get_instance() {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }

}

 

AccountPlanner::get_instance();
<?php

// namespace AccountPlannerWP\Classes;


use Gemini\Client;
use Gemini\Data\GenerationConfig;
use Gemini\Data\Content;
use Gemini\Enums\Role;
use GuzzleHttp\Client as GuzzleClient;
use Gemini\Enums\ModelType;

class GeminiClass{


 function __construct(){

    // add_action('wp_head', array($this,'gemini_models'));//Filter new : ajax
       
 }

    // public function gemini_models(){

    //     $client = new Client('AIzaSyA49G81GcV-Wl6X_LlLve1z9QxTrxXB4C8');
    //     $response = $client->listModels();

    //     print_r($response->models);
    // }

    // public function test($message_array){
            
    //     $yourApiKey = get_option("gemini_api_key") ; 
    //     $client = Gemini::client($yourApiKey);
    //     $response = $client->models()->retrieve(ModelType::GEMINI_PRO_VISION);

    //     print_r($response);
    // }

 public function test($message_array){
      
    $yourApiKey = get_option("gemini_api_key") ; 
    $client = Gemini::client($yourApiKey);


    //     $result = $client->geminiPro()->generateContent('I need a favor');
    //    return  $result->text(); // Hello! How can I assist you today?

    $message_array = $message_array ? $message_array : [];

    $message_array_part = array_slice($message_array, 0, -1); //excl. last element since is the main question to ask

    $history = [];
    $history_user_assistant = [];

    foreach($message_array_part as $message){

        $the_content = sanitize_text_field( $message['content']) ? $message['content'] : '';
        $the_role = $message['role'];

        if($the_role == "system"){
            $history_user_assistant[]= Content::parse(part: $the_content);
            $history_user_assistant[] = Content::parse(part: "Yes I understand." , role: Role::MODEL);
            // $history_user_assistant[]= Content::parse(part: "Be concise in your response ");
            // $history_user_assistant[] = Content::parse(part: "I understand." , role: Role::MODEL);
        }
        elseif($the_role == "user"){
            $history_user_assistant[] = Content::parse(part: $the_content );
        }elseif($the_role == "assistant"){
            $history_user_assistant[] = Content::parse(part: $the_content , role: Role::MODEL);
        }
 
    }


    $message_array_last_question = end($message_array); // last element since is the main question to ask
 

    $generationConfig = new GenerationConfig(
        stopSequences: [
            'Title',
        ],
        maxOutputTokens:  get_option( "gemini_max_tokens") ? (int) get_option( "gemini_max_tokens")  : 800,
        temperature: get_option( "gemini_temperature") ? (int) get_option( "gemini_temperature")  : 1,
        topP: get_option( "gemini_topp") ? (float) get_option( "gemini_topp")  : 0.8 ,
        topK: get_option( "gemini_topk") ? (int) get_option( "gemini_topk")  : 10 ,
    );

    $gemini_model = get_option( "gemini_model") ? get_option( "gemini_model") : "gemini-1.0-pro";
    $gemini_model = "models/".$gemini_model;

    $chat = $client
    ->generativeModel($gemini_model)
    // ->withGenerationConfig(new GenerationConfig(responseMimeType: 'application/json'))
    ->withGenerationConfig($generationConfig)
    ->startChat(history: 
        $history_user_assistant //history
    );
    $last_question = $message_array_last_question['content'];
    $response = $chat->sendMessage(  $last_question  );

    // print_r( $response );// test
    // print_r( $history_user_assistant );// test

    return ($response->text()) ; 

 }

    /**
     * @return self
     */
    public static function get_instance()
    {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }

 
}

<div class="user">
<?php 


 

 $user_id = get_current_user_id();  
 $attachment_id = get_user_meta($user_id, 'profile_image', true);
//    echo wp_get_attachment_image($attachment_id, 'thumbnail');
    ?>
    <!-- <div class="user-welcome">
        <div class="welcome">Welcome</div>
        <h5><?php echo ucfirst(get_user_by( "id", get_current_user_id() )->display_name);   ?></h5>
    </div> -->
</div>


<?php
 $model = get_option( "model");
 $max_tokens = get_option( "max_tokens");
 $temperature = get_option( "temperature");
// $api_key = get_option( "api_key");
$api_key = get_option( "gemini_api_key");

$presence_penalty = get_option( "presence_penalty");
 $frequency_penalty = get_option( "fequency_penalty");

if( empty($api_key)  ){
    echo "<div class='api-credential-missing'><b>Search Error!</b> Admin needs to setup API credentials</div>";
}else{
    echo '
    <div class="search">
        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_3815_350)">
        <path d="M28.1249 5.60984H20.6362V3.79297C20.6362 2.24141 19.3743 0.980469 17.8237 0.980469H12.1855C10.634 0.980469 9.37305 2.24141 9.37305 3.79297V5.60984H1.87398C0.843672 5.60984 -0.00101563 6.45453 -0.00101563 7.48484V14.0548H-0.00195312V15.9298H-0.00101563V27.1452C-0.00101563 28.1755 0.842734 29.0202 1.87398 29.0202H28.124C29.1543 29.0202 29.999 28.1755 29.999 27.1452V7.48484C29.999 6.45453 29.1552 5.60984 28.1249 5.60984ZM11.249 3.79297C11.249 3.27547 11.669 2.85547 12.1865 2.85547H17.8237C18.3412 2.85547 18.7612 3.27547 18.7612 3.79297V5.60984H11.248L11.249 3.79297ZM1.87586 7.48484H28.1259V14.0548H17.8021V13.0948C17.8021 12.0617 16.9602 11.2198 15.9271 11.2198H14.0596C13.0265 11.2198 12.1846 12.0617 12.1846 13.0948V14.0548H1.87586V7.48484ZM15.928 17.8161H14.0587V13.0948H15.9262L15.928 17.8161ZM1.87492 27.1442V15.9289H12.1837V17.8152C12.1837 18.8483 13.0246 19.6902 14.0587 19.6902H15.9262C16.9593 19.6902 17.8012 18.8483 17.8012 17.8152V15.9289H28.1249V27.1442H1.87492Z" fill="#ADB8CC"/>
        </g>
        <defs>
        <clipPath id="clip0_3815_350">
        <rect width="30" height="30" fill="white"/>
        </clipPath>
        </defs>
        </svg>

     <input type="text" name="external_company" placeholder="Customer Company" autocomplete="off">
    </div>
    <div class="divider"> <svg width="2" height="30" viewBox="0 0 2 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 0V30" stroke="#ADB8CC"/></svg></div>
    <div class="search"> 

    <svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M6.125 3.75V24.375H17.375V3.75H6.125ZM5.1875 1.875H18.3125C18.5611 1.875 18.7996 1.97377 18.9754 2.14959C19.1512 2.3254 19.25 2.56386 19.25 2.8125V25.3125C19.25 25.5611 19.1512 25.7996 18.9754 25.9754C18.7996 26.1512 18.5611 26.25 18.3125 26.25H5.1875C4.93886 26.25 4.7004 26.1512 4.52459 25.9754C4.34877 25.7996 4.25 25.5611 4.25 25.3125V2.8125C4.25 2.56386 4.34877 2.3254 4.52459 2.14959C4.7004 1.97377 4.93886 1.875 5.1875 1.875Z" fill="#ADB8CC"/>
    <path d="M8 7.5H15.5V9.375H8V7.5ZM8 13.125H15.5V15H8V13.125ZM8 18.75H15.5V20.625H8V18.75ZM19.25 15H23V16.875H19.25V15ZM19.25 18.75H23V20.625H19.25V18.75ZM2.375 24.375H28.625V26.25H2.375V24.375Z" fill="#ADB8CC"/>
    <path d="M19.25 11.25V24.375H24.875V11.25H19.25ZM18.3125 9.375H25.8125C26.0611 9.375 26.2996 9.47377 26.4754 9.64959C26.6512 9.8254 26.75 10.0639 26.75 10.3125V25.3125C26.75 25.5611 26.6512 25.7996 26.4754 25.9754C26.2996 26.1512 26.0611 26.25 25.8125 26.25H18.3125C18.0639 26.25 17.8254 26.1512 17.6496 25.9754C17.4738 25.7996 17.375 25.5611 17.375 25.3125V10.3125C17.375 10.0639 17.4738 9.8254 17.6496 9.64959C17.8254 9.47377 18.0639 9.375 18.3125 9.375Z" fill="#ADB8CC"/>
    </svg>
    
    <input type="text" name="stakeholder" placeholder="Stakeholder Title" autocomplete="off"> 
    </div>
    <div class="search-btn">
        <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M18.0006 16.0006H17.2106L16.9306 15.7306C18.1306 14.3306 18.7506 12.4206 18.4106 10.3906C17.9406 7.61063 15.6206 5.39063 12.8206 5.05063C8.59063 4.53063 5.03063 8.09063 5.55063 12.3206C5.89063 15.1206 8.11063 17.4406 10.8906 17.9106C12.9206 18.2506 14.8306 17.6306 16.2306 16.4306L16.5006 16.7106V17.5006L20.7506 21.7506C21.1606 22.1606 21.8306 22.1606 22.2406 21.7506C22.6506 21.3406 22.6506 20.6706 22.2406 20.2606L18.0006 16.0006ZM12.001 16.0006C9.51098 16.0006 7.50098 13.9906 7.50098 11.5006C7.50098 9.01061 9.51098 7.00061 12.001 7.00061C14.491 7.00061 16.501 9.01061 16.501 11.5006C16.501 13.9906 14.491 16.0006 12.001 16.0006Z"
                fill="white" />
        </svg>
        <span>GET SMART</span>
    </div>
   
    ';
}

?>



<?php

$dashnoard = get_permalink( get_page_by_path( "dashboard" ) );
$project = get_permalink( get_page_by_path( "projects" ) );
$setting = get_permalink( get_page_by_path( "settings" ) );


global $post;
$page_slug = $post->post_name;
?>

<div class="menu-container">
    <a href="<?php echo $dashnoard ?>" class="menu-item <?php echo  ($page_slug=='dashboard') ? 'active':'' ;  ?>">
        <span><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M3.75 16.25H13.75V3.75H3.75V16.25ZM3.75 26.25H13.75V18.75H3.75V26.25ZM16.25 26.25H26.25V13.75H16.25V26.25ZM16.25 3.75V11.25H26.25V3.75H16.25Z"
                    fill="white" />
            </svg></span>
        <span class="menu-text">Dashboard</span>
    </a>

    <a href="<?php echo $project ?>" class="menu-item <?php echo ($page_slug=='projects') ? 'active':'' ;  ?>">
        <span><svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M23 9H22V17C22 17.55 21.55 18 21 18H9V19C9 20.1 9.9 21 11 21H21L25 25V11C25 9.9 24.1 9 23 9ZM20 14V7C20 5.9 19.1 5 18 5H7C5.9 5 5 5.9 5 7V20L9 16H18C19.1 16 20 15.1 20 14Z"
                    fill="#FF6633" />
            </svg></span>
        <span class="menu-text">Workspace</span>
    </a>
<?php
 $user = get_user_by('id',get_current_user_id());
 if(  is_array($user->roles)  && array_intersect($user->roles,['author','administrator'])  ){
     
     ?>
 
 
    <a href="<?php echo $setting ?>" class="menu-item <?php echo  ($page_slug=='settings') ? 'active':'' ;  ?>">
        <span><svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M22.1688 14.176C22.2182 13.792 22.2552 13.408 22.2552 13C22.2552 12.592 22.2182 12.208 22.1688 11.824L24.7719 9.844C25.0063 9.664 25.068 9.34 24.9199 9.076L22.4526 4.924C22.3046 4.66 21.9715 4.564 21.7001 4.66L18.6282 5.86C17.9867 5.38 17.2959 4.984 16.5433 4.684L16.0745 1.504C16.0375 1.216 15.7785 1 15.4701 1H10.5354C10.227 1 9.96791 1.216 9.9309 1.504L9.46211 4.684C8.70957 4.984 8.01872 5.392 7.37722 5.86L4.30539 4.66C4.02165 4.552 3.7009 4.66 3.55286 4.924L1.08553 9.076C0.925156 9.34 0.999175 9.664 1.23357 9.844L3.8366 11.824C3.78726 12.208 3.75025 12.604 3.75025 13C3.75025 13.396 3.78726 13.792 3.8366 14.176L1.23357 16.156C0.999175 16.336 0.937492 16.66 1.08553 16.924L3.55286 21.076C3.7009 21.34 4.03399 21.436 4.30539 21.34L7.37722 20.14C8.01872 20.62 8.70957 21.016 9.46211 21.316L9.9309 24.496C9.96791 24.784 10.227 25 10.5354 25H15.4701C15.7785 25 16.0375 24.784 16.0745 24.496L16.5433 21.316C17.2959 21.016 17.9867 20.608 18.6282 20.14L21.7001 21.34C21.9838 21.448 22.3046 21.34 22.4526 21.076L24.9199 16.924C25.068 16.66 25.0063 16.336 24.7719 16.156L22.1688 14.176ZM13.0026 17.2002C10.6216 17.2002 8.6848 15.3162 8.6848 13.0002C8.6848 10.6842 10.6216 8.80018 13.0026 8.80018C15.3836 8.80018 17.3204 10.6842 17.3204 13.0002C17.3204 15.3162 15.3836 17.2002 13.0026 17.2002Z"
                    fill="#197CE0" />
            </svg></span>
        <span class="menu-text">Settings</span>
    </a>
<?php
 }
 ?>

</div>
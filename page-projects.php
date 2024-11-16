<?php
/*
Template Name: Project
*/ 

get_header();

 
use AccountPlannerWP\Classes\AccountPlanner;

 $pid =  isset($_GET['pid']) ? $_GET['pid'] : '';
$user_id =  isset($_GET['pid']) ? $_GET['user_id'] : '';

if(isset($pid)){
    wp_delete_post($pid);

    $cur_link = get_permalink( get_page_by_path( "projects"));
    // echo"
    //     <script> window.location.href='$cur_link'    </script>
    // ";
}



$searches = AccountPlanner::get_instance()->get_saved_search("");


$logo = get_template_directory_uri()."/img/logo-1.svg";
$logo_dark = get_template_directory_uri()."/img/logo-dark.svg";
$ham = get_template_directory_uri()."/img/ham.svg";
$logo_circle = get_template_directory_uri()."/img/logo-circle.svg";


?>


<!-- header section -->
<?php get_template_part( "template-parts/header","section");  ?>


<section class="body">
    <div class="body-container">
        <div class="nav">

          <!-- sidemenu -->
          <?php get_template_part( "template-parts/sidemenu","section");  ?> 


        </div>
        <div class="content">

            <div class="heading">
                <h1> Workspace </h1>
               
            </div>

            <div class="top-search saved">

                <!-- top search -->
                



                <div class="search">
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_3815_350)">
                <path d="M28.1249 5.60984H20.6362V3.79297C20.6362 2.24141 19.3743 0.980469 17.8237 0.980469H12.1855C10.634 0.980469 9.37305 2.24141 9.37305 3.79297V5.60984H1.87398C0.843672 5.60984 -0.00101563 6.45453 -0.00101563 7.48484V14.0548H-0.00195312V15.9298H-0.00101563V27.1452C-0.00101563 28.1755 0.842734 29.0202 1.87398 29.0202H28.124C29.1543 29.0202 29.999 28.1755 29.999 27.1452V7.48484C29.999 6.45453 29.1552 5.60984 28.1249 5.60984ZM11.249 3.79297C11.249 3.27547 11.669 2.85547 12.1865 2.85547H17.8237C18.3412 2.85547 18.7612 3.27547 18.7612 3.79297V5.60984H11.248L11.249 3.79297ZM1.87586 7.48484H28.1259V14.0548H17.8021V13.0948C17.8021 12.0617 16.9602 11.2198 15.9271 11.2198H14.0596C13.0265 11.2198 12.1846 12.0617 12.1846 13.0948V14.0548H1.87586V7.48484ZM15.928 17.8161H14.0587V13.0948H15.9262L15.928 17.8161ZM1.87492 27.1442V15.9289H12.1837V17.8152C12.1837 18.8483 13.0246 19.6902 14.0587 19.6902H15.9262C16.9593 19.6902 17.8012 18.8483 17.8012 17.8152V15.9289H28.1249V27.1442H1.87492Z" fill="#ADB8CC"></path>
                </g>
                <defs>
                <clipPath id="clip0_3815_350">
                <rect width="30" height="30" fill="white"></rect>
                </clipPath>
                </defs>
                </svg>

                <input type="text" name="search_saved" placeholder="Type an account to access saved research" autocomplete="off"  >
                </div>
                 
                <div class="search-btn-saved">
                <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.0006 16.0006H17.2106L16.9306 15.7306C18.1306 14.3306 18.7506 12.4206 18.4106 10.3906C17.9406 7.61063 15.6206 5.39063 12.8206 5.05063C8.59063 4.53063 5.03063 8.09063 5.55063 12.3206C5.89063 15.1206 8.11063 17.4406 10.8906 17.9106C12.9206 18.2506 14.8306 17.6306 16.2306 16.4306L16.5006 16.7106V17.5006L20.7506 21.7506C21.1606 22.1606 21.8306 22.1606 22.2406 21.7506C22.6506 21.3406 22.6506 20.6706 22.2406 20.2606L18.0006 16.0006ZM12.001 16.0006C9.51098 16.0006 7.50098 13.9906 7.50098 11.5006C7.50098 9.01061 9.51098 7.00061 12.001 7.00061C14.491 7.00061 16.501 9.01061 16.501 11.5006C16.501 13.9906 14.491 16.0006 12.001 16.0006Z" fill="white"></path>
                </svg>
                <span>GET SMART</span>
                </div>



            </div>


            <div class="project-cards">

            <?php
 			
            if($searches){

                $user_id =  wp_get_current_user()->ID ;

                    foreach ($searches as $key => $search) {
                        $id = $search->ID ;
                        $date = $search->post_date ;
                        $single_project = get_permalink( get_page_by_path( "dashboard"))."?pid=$id&&user_id=$user_id";
                        $delete_single_project = get_permalink( get_page_by_path( "projects"))."?code=QSy5oflWTcaOdks4t0q8BeHM95vo1tGXZISPUxm3AaN6idLKaZU9rIHzf3k2QOy8mDjq3K1GSLxUICRZMHmeNfYbIoglYXkxF246TM18zZU0Wi&&pid=$id&&user_id=$user_id";

                        echo"
                        <div>
                            <div class='project-card'>
                            <div class='top'> <span>$date</span> <iimg class='logo-circle' src='$logo_dark' alt=''> </div>
                            <div class='bottom'>
                            <span>$search->post_title</span>
                            
                            </div>
                            </div>

                            <div style='display: flex; align-items: center; justify-content: space-between;'>
                                <a href='$single_project' style='width: 48%;  background: #efeeee;border-radius: 0 0 5px 5px;'>
                                    <div idd='delete-workspace' class='delete-workspace' style='  padding: 10px; color: #101c4e9e; text-align: center;'> View </div>
                                </a>

                                <a style='width: 48%; background: #a2a2a291;  border-radius: 0 0 5px 5px;' onclick=\"if(confirm('Are you sure you want to delete selected search result?')){return true;}else{event.stopPropagation(); event.preventDefault();};\" class='delete-search' href='$delete_single_project' >
                                    <div idd='delete-workspace' class='delete-workspace' style='padding: 10px; color: #34394d; text-align: center;'> Delete </div>
                                </a>
                            </div>
                        </div>
";
                    }

                }
            ?>


            </div>
                <?php

                if(empty($searches)){
                    echo "<div style='text-align:center;width:100%'> You have no save search </div>";
                }

                ?>

        </div>
    </div>
</section>


<?php
get_footer();
(function($){



    // Account smart 
      $(document).ready(function(){
    
    
         /* Prompt Tab Switching */ 
         jQuery(".prompt-nav-item").each(function(){
    
            jQuery(this).click(function(){
                var ci = jQuery(this).data("nav");
                console.log("CI ", ci) ;
                
                if(ci === "kyb"){
                    jQuery(".prompt-nav-item").removeClass("active");
                    jQuery(this).addClass("active");
    
                    // jQuery(".prompt-card").show();
                    jQuery("div[data-nav-content='kyb']").show();
                    jQuery("div[data-nav-content='vic']").hide();
                    jQuery("div[data-nav-content='vas']").hide();
                }else if(ci === "vas"){
                    jQuery(".prompt-nav-item").removeClass("active");
                    jQuery(this).addClass("active");
    
                    // jQuery(".prompt-card").show();
                    // jQuery(".prompt-card").show();
                    jQuery("div[data-nav-content='vas']").show();
                    jQuery("div[data-nav-content='vic']").hide();
                    jQuery("div[data-nav-content='kyb']").hide();
                }else if(ci === "vic"){
                    jQuery(".prompt-nav-item").removeClass("active");
                    jQuery(this).addClass("active");
    
                    // jQuery(".prompt-card").show();
                    // jQuery(".prompt-card").show();
                    jQuery("div[data-nav-content='vic']").show();
                    jQuery("div[data-nav-content='vas']").hide();
                    jQuery("div[data-nav-content='kyb']").hide();
                }
    
            });
        })
    
    
    
        /* Bottom chat activation  */ 
        jQuery(".default-chat-view").click(function(){
                jQuery(".chat-section").css({"display":"flex"});
                // setTimeout(function(){
                //     $(window).resize(function(){  /*Bind an event handler to the "resize"*/
                //         if ($(window).width() <= 480) {
                //             jQuery(".chat-section").css({"width":"100%"});
                //         }else{
                //             jQuery(".chat-section").css({"width":"40%"});
                //         }
                //     })

                // },1000);
                jQuery(".main-chat-div svg").show();
                jQuery(".body-container .content").addClass("chat");
                jQuery(this).hide();
            });
            
            jQuery(".main-chat-div svg").click(function(){
            jQuery(".default-chat-view").css({"display":"flex"});
            jQuery(".body-container .content").removeClass("chat");
    
            // setTimeout(function(){
            //     jQuery(".chat-section").css({"width":"40%"});
            // },1000);
            jQuery(".chat-section").hide();
    
                // jQuery(".main-chat-div").hide();
                jQuery(this).hide();
    
                
        });
    
        /* 3 Main sections */ 
        jQuery(".section-responses-container .section-responses-div").each(function(){
    
            jQuery(this).click(function(){
                var ci = jQuery(this).index(".section-responses-container .section-responses-div");
                // console.log("CI ", ci) ;
                
                jQuery(".response-section-tab").addClass("active");
                jQuery(".response-section-tab").eq(ci).trigger("click");
                AOS.init();
                jQuery(".response-section-tab").eq(ci).removeClass("active");
    
                jQuery(".section-responses").hide();
                jQuery(".actionable-insights").show();
                // jQuery(".response-section-tab.section-responses-div").eq(ci).removeClass("active");

    
                // Show chat trigger 
                $(".control-item.save_search,.chat-btn").css({"display":"flex"})
    
            });
        })
    
        /* Main section Result Tab*/ 
        jQuery(".response-section-content").hide();
        jQuery(".response-section-content").eq(0).show();

        $(".response-section-content.active div.result-section").hide();
        $(".response-section-content.active  div.result-section").eq(0).show();
        
        jQuery(".response-section-tab").each(function(){
            jQuery(this).click(function(e){
                e.preventDefault();
                AOS.init();
    
                // var cur_tab = jQuery(this).attr("data-tab");
                var cur_tab_index = jQuery(this).index(".response-section-tab");
    
                // Left Tab : Tweeki here
                jQuery(".response-section-tab").addClass("active");
                jQuery(".response-section-tab").eq(cur_tab_index).removeClass("active");
    
                // Left Tab content
                console.log('Hey',cur_tab_index);
                jQuery(".response-section-content").removeClass("active");
                jQuery(".response-section-content").hide();
                jQuery(".response-section-content").eq(cur_tab_index).addClass("active");
    
                // Sub tab /contennt visibility
                $(".response-section-content.active div.result-section").hide();
                $(".response-section-content.active  div.result-section").eq(0).show();
    
                
            });
        });
        /* Ends  Main section Result Tab*/ 
    
    
        /* Section Result tab/content*/ 
    
        $(".insights-container-right div.result-tab-section").each(function(){
    
            $(this).click(function(){
                var cur_tab_index = $(this).index(".insights-container-right div.result-tab-section");
    
                // Current tab active
                $(".response-section-content.active  div.result-tab-section").removeClass("active");
                $(this).addClass("active");
    
                // Current tab content active
                $(".response-section-content.active div.result-section").hide();
                $(".insights-container-right div.result-section").eq(cur_tab_index).show();
    
            });
        });
        /* Section Result tab/content*/ 
    
    
    
    
        // API Grouping
        // jQuery(".api-group").hide();
        // jQuery(".gemini-section").show();
    
        jQuery("select[name='api-switch']").change(function(){
    
            if(jQuery(this).val() == "fireworks"){
                jQuery(".api-group").hide();
                jQuery(".fireworks-section").show();
            } 

            if(jQuery(this).val() == "gemini"){
                jQuery(".api-group").hide();
                jQuery(".gemini-section").show();
            } 
        
             if(jQuery(this).val() == "chatgpt"){
                 jQuery(".api-group").hide();
                jQuery(".gpt-section").show();
            } 
        
             if(jQuery(this).val() == "perplexity"){
                jQuery(".api-group").hide();
                jQuery(".perplexity-section").show();
            } 
            
        });
    
      });
    
    
        
        /* Create User */
    
        $(".add-user").click(function(){
            $("section.popup-process.create_user").css({"display":"flex"});
    
            $(".pclose").click(function(){
                $(this).parent().parent().hide();
            });
        
        });
        
         /* Edit User */
    
         $("span.control.edit_user").click(function(){
            $("section.popup-process.edit_user").css({"display":"flex"});
    
                //user_id
                $("section.popup-process.edit_user .profile-card input[name='user_id']").val($(this).siblings("span.user_id").html());
    
                //username
                $("section.popup-process.edit_user .profile-card input[name='username']").val($(this).parent().parent().find("span.username").html());
    
                //first_name
                $("section.popup-process.edit_user .profile-card input[name='first_name']").val($(this).parent().parent().find("span.firstname").html());
    
                //lastname
                $("section.popup-process.edit_user .profile-card input[name='last_name']").val($(this).parent().parent().find("span.lastname").html());
    
                //email
                $("section.popup-process.edit_user .profile-card input[name='email']").val($(this).parent().parent().find("span.email").html());
    
    
            $(".pclose").click(function(){
                $(this).parent().parent().hide();
            });
        
        });
    
    
        
        /* End user */ 
    
    
        function containsQueryParam(paramName) {
            const url = new URL(window.location.href);
          
            return url.searchParams.has(paramName);
          }
    
        if(containsQueryParam("pid")){
            $(".results-container").show();
            $(".no-result-container").hide();
            jQuery(".conclusion-controls .control-item").eq(0).hide();
            jQuery(".conclusion-controls .control-item").eq(1).hide();
            $(".about-company").show();
            $(".result-logo img").show();
    
    
        }else{
            $(".results-container").hide();
            $(".no-result-container").show();
            jQuery(".conclusion-controls .control-item").eq(0).show();
            jQuery(".conclusion-controls .control-item").eq(1).show();
            $(".about-company").hide();
    
        }
    
    
    
        // Register
        $(".register-room").hide();
    
        setInterval(function(){
            jQuery(".loading").fadeToggle(1200);
        },2000);
    
    
        // Menu Trigger
       $("#menu-trigger").click(function(){
        $(".body-container .nav").fadeToggle();
       });
    
    
       $(".register-login-btn").click(function(){
    
        $(".register-login-btn").removeClass("active");
        $(this).toggleClass("active");
    
       });
    
       $("#login-btn").click(function(){
            $(".register-room").hide();
            $(".login-room").fadeToggle();
    
       });
    
       $("#register-btn").click(function(){
            $(".login-room").hide();
            $(".register-room").fadeToggle();
       });
    
    
       $(".save-btn").show();
       
    
        if( (account_data.role ==="subscriber")){ //profile
    
            $(".save-btn").attr("action","profile");
        }else{
            $(".save-btn").attr("action","prompt");
        }
    
    
       $(".tab-content").hide();
       $(".tab-content").eq(0).show();
    
       $(".save-btn.profile").show();
    
       $(".s-nav-item").each(function(a,b){
            $(this).click(function(){
                $(".s-nav-item").removeClass("active");
                $(this).addClass("active");
                console.log("index",$(this).index(".s-nav-item") ); 
                $(".tab-content").hide();
                var idx = parseInt($(this).index(".s-nav-item"));
                $(".tab-content").eq(idx).show();
                if(idx===0 && (account_data.role ==="subscriber")){
                    $(".save-btn").attr("action","profile");
                    $(".save-btn").show();
    
                }
                else if(idx===0 && (account_data.role !=="subscriber") ){
                    
                    $(".save-btn").attr("action","prompt");
                    $(".save-btn").show();
    
                }else if(idx===1 ){ //profile
                    // console.log("account_data.role",account_data.role ); 
    
                    $(".save-btn").attr("action","profile");
                    // $(".save-btn").hide();
    
    
                }else if(idx===2){ //user section
                    $(".save-btn").attr("action","");
                    $(".save-btn").hide();
    
    
                }else if(idx===3){ //api section
                    $(".save-btn").attr("action","api");
                    $(".save-btn").show();
    
    
                }
            });
       });
    
    
        /*
        * Chat GPT API
        *
        */ 
    
      $(document).ready(function(){
    
    
            // Default Prompt
            setTimeout(function(){
                
            // Check Local storage if Geuest user  saved their prompt 
            opportunity_pc_text_question = localStorage.getItem("opportunity_pc_text_question");
            opportunity_eb_text_question = localStorage.getItem("opportunity_eb_text_question");
            company_overview_text_question = localStorage.getItem("company_overview_text_question");
            challenges_text_question = localStorage.getItem("challenges_text_question");
            stakeholder_consideration_text_question = localStorage.getItem("stakeholder_consideration_text_question");
            understanding_stakeholder_text_question = localStorage.getItem("understanding_stakeholder_text_question");
            discovery_pc_text_question = localStorage.getItem("discovery_pc_text_question");
            discovery_eb_text_question = localStorage.getItem("discovery_eb_text_question");
            
                // If Guest user did not save to local storage then use the default prompt
            //     if(challenges_text_question==null){
            //           $("div[name='challenges']").html(account_data.challenges_prompt);
            //     }  
            //     if(opportunity_pc_text_question==null){
            //          $("div[name='impact']").html(account_data.opportunity_px_prompt);
    
            //     }  if(company_overview_text_question==null){
            //          $("div[name='insight']").html(account_data.company_overview_prompt);
            //     }   
            //     if( opportunity_eb_text_question==null){
            //          $("div[name='hypotesis']").html(account_data.opportunity_eb_text_question);
            //     }  
                
            //     if(stakeholder_consideration_text_question==null ){
            //          $("div[name='capability']").html(account_data.stakeholder_considerations_prompt);
            //     }
    
            //     if(understanding_stakeholder_text_question==null ){
            //         $("div[name='capability']").html(account_data.understanding_stakeholder_prompt);
            //    }
    
            //    if(discovery_pc_text_question==null ){
            //     $("div[name='capability']").html(account_data.discovery_pc_prompt);
            //     }
    
            //     if(discovery_eb_text_question==null ){
            //     $("div[name='capability']").html(account_data.discovery_eb_prompt);
            //     }
                
            },2000);
                
                
    
            // On  reset prompt
            $("#reset_prompt").click(function(){
                
                $("div[name='challenges']").html(account_data.challenges_prompt);
                $("div[name='company_overview']").html(account_data.company_overview_prompt);
                $("div[name='opportunity_pc']").html(account_data.opportunity_pc_prompt);
                $("div[name='opportunity_eb']").html(account_data.opportunity_eb_prompt);
                $("div[name='stakeholder_consideration']").html(account_data.stakeholder_considerations_prompt);
                $("div[name='understanding_stakeholder']").html(account_data.understanding_stakeholder_prompt);
                $("div[name='discovery_pc']").html(account_data.discovery_pc_prompt);
                $("div[name='discovery_eb']").html(account_data.discovery_eb_prompt);
                
            });
    
            /* Trigger CHAT GPT Query */
            $(".search-btn").click(function(){
    
                // var internal_company = $("input[name='internal_company']").val();
                var external_company = $("input[name='external_company']").val();
                if( (external_company == "") ){
                    // alert("You need to enter company name");
                    toastr.error("You need to enter company name", 'Error');
    
                    return;
                }
    
                $(".control-item.save_search,.chat-btn").hide();
    
    
                jQuery(".section-responses,.actionable-insights").hide();
    
                $(".result-loading-container").css({"display":"flex"});
                $(".no-result-container").hide();
    
                setTimeout(() => {
                $(".result-loading-container").hide();
                    jQuery(".section-responses").css({"display":"flex"});
                    AOS.init();
                }, 5000);
    
    
                // Loading
                $(".the-conten").html("<div style='height:30px;background:#0693e326;border-radius:25px'><div class='loading'>Generating...</div></div>");
                
                jQuery(".chat-body").html("");
    
                // setTimeout(function(){
                //     company();
                // },200);
    
                setTimeout(function(){
                    chat1();
                },500);
    
                setTimeout(function(){
                    chat2();
                },1500);
                setTimeout(function(){
                    chat7();
                },2500);
                setTimeout(function(){
                    chat3();
                },10500);
                setTimeout(function(){
                    chat4();
                },18500);
                setTimeout(function(){
                    chat5();
                },1000);
                setTimeout(function(){
                    chat6();
                },5000);
               
                setTimeout(function(){
                    chat8();
                },5000);
    
    
            });



            /* SIMULATE */

            $(".simulate-btn").click(function(){
    
                // var internal_company = $("input[name='internal_company']").val();
                var external_company = $("input[name='external_company']").val();
                if( (external_company == "") ){
                    // alert("You need to enter company name");
                    toastr.error("You need to enter company name before simulating", 'Error');
    
                    return;
                }
    
                $(".control-item.save_search,.chat-btn").hide();
    
    
                jQuery(".section-responses,.actionable-insights").hide();
    
                $(".result-loading-container").css({"display":"flex"});
                $(".no-result-container").hide();
    
                setTimeout(() => {
                $(".result-loading-container").hide();
                    jQuery(".section-responses").css({"display":"flex"});
                    AOS.init();
                }, 5000);
    
    
                // Loading
                $(".the-conten").html("<div style='height:30px;background:#0693e326;border-radius:25px'><div class='loading'>Generating...</div></div>");
                
                jQuery(".chat-body").html("");
     var count = 0;
                    for(i=0;i<180;i++){
                        count += i;

                        setTimeout(function(){
                            chat1();
                        },500);
            
                        setTimeout(function(){
                            chat2();
                        },1500);
                        setTimeout(function(){
                            chat7();
                        },2500);
                        setTimeout(function(){
                            chat3();
                        },10500);
                        setTimeout(function(){
                            chat4();
                        },18500);
                        setTimeout(function(){
                            chat5();
                        },1000);
                        setTimeout(function(){
                            chat6();
                        },5000);
                    
                        setTimeout(function(){
                            chat8();
                        },5000);
                        // console.log("Simulation "+i+" completed");

            
                    }
				
				console.log("Count",count);
            });//simulate BTN

            

            /* SIMULATE ENDS*/  



             /* Trigger CHAT GPT Query */
             $(".search-btn-saved").click(function(){
    
                // var internal_company = $("input[name='internal_company']").val();
                var search_saved = $("input[name='search_saved']").val();
                if( (search_saved == "") ){
                    // alert("You need to enter company name");
                    toastr.error("You need to enter company name", 'Error');
    
                    return;
                }else{
                    toastr.warning("Please hold on while we retrive your saved search", 'Wait');
                }
              
                $(".result-loading-container").css({"display":"flex"});
     
                const data = {
                    action: "retrieve_save_search",
                    "company":search_saved,

                };
                $.ajax({
                    url: account_data.ajaxurl, // AJAX handler
                    data: data,
                    type: "POST",
                    success: function (res) {
                        console.log('Retrieve Save search',res);

                        if(res != ""){
                            toastr.success("Saved search retrieved successfully", 'Success');
                            $(".project-cards").html(res);
                        }else{
                            toastr.error("You have no saved search", 'Error');
                            $(".project-cards").html("");

                        }
                    
                    },
                    error: function (error) {
                        console.log('error',error);
                    },
                });
    
             
    
    
            });
    
            /* Trigger CONTEXT CHAT */
            $(".chat-input-send").click(function(){
    
                 
                var chat_input = $("input#chat-input").val();
                if( (chat_input == "") ){
                    
                    toastr.success("Enter your question in the chat to continue conversation", 'Success');
                    // alert("Enter your question in the chat to continue conversation");
                    return;
                }
    
                jQuery(".chat-body").append(`<div class='client-request'> <span> ${chat_input} </span> <div class='user-sec'> <div class='user-div'>User </div></div></div>`);
                
                /* */ 
                setTimeout(function(){
                    jQuery(".chat-body").append(`<div class='assistant-request temp'> <span> ...... </span></div>`);
                },1500);
                
                jQuery(".chat-body").scrollTop(jQuery(".chat-body")[0].scrollHeight);
                

    
    
                // Loading
                // $(".the-conten").html("<div style='height:30px;background:#0693e326;border-radius:25px'><div class='loading'>Generating...</div></div>");
    
                setTimeout(function(){
                    context_chat();
                },500);
     
    
    
            });
    
    
           // On Setting Saved 
            $(".save-btn,.save-btn.profile").click(function(){
    
                $action = $(this).attr("action");
                console.log("$action",$action);
             
                // setTimeout(function(){
                    setting_api();
                // },200);
    
                
            });
    
    
             // On  Saved search
             $(".save_search").click(function(){
                $(this).hide();
    
                console.log("Saving");
                setTimeout(function(){
                    save_search();
                },200);
    
                
            });
    
    
            function countWords(str) {
                // Split the string into an array of words using regex
                const words = str.match(/\b\w+\b/g);
                // Return the count of words
                return words ? words.length : 0;
            }
    
            function save_search(){
    
                
                    /* AJAX For save_search api generation */ 
                    var challenges = $("#challenges-content").html();
                    var company_overview = $("#company-profile-content").html();
                    var opportunity_pc = $("#bussiness-vo-content").html();
                    var opportunity_eb = $("#solution-impact-content").html();
                    var stakeholder_considerations = $("#key-sc-content").html();
                    var understanding_stakeholder = $("#understanding-ys-content").html();
                    var discovery_eb = $("#value-in-ade-content").html();
                    var discovery_pc = $("#value-action-ae-content").html();
        
                    var internal_company = "Patriot Growth Insurance Services";
                    var external_company = $("input[name='external_company']").val();
    
    
                    const data = {
                        action: "save_search",
                        "challenges":challenges,
                        "company_overview":company_overview,
                        "opportunity_pc":opportunity_pc,
                        "opportunity_eb":opportunity_eb,
                        "stakeholder_considerations":stakeholder_considerations,
                        "understanding_stakeholder":understanding_stakeholder,
                        "discovery_pc":discovery_pc,
                        "discovery_eb":discovery_eb,
                      "internal_company_logo" :internal_company,
                      "external_company" :external_company
    
                    };
                    $.ajax({
                        url: account_data.ajaxurl, // AJAX handler
                        data: data,
                        type: "POST",
                        success: function (res) {
                            console.log('Save search',res);
    
                            if(res.result === "success"){
                                // $(".report-url").show();
                                // $(".report-url").html("<b>Share URL: </b> "+res.url);
                                toastr.success("Your search setting has been saved", 'Success');
                                // alert("Your search setting has been saved");
                                // location.reload();
    
                            }
                        
                        },
                        error: function (error) {
                            console.log('error',error);
                        },
                    });
    
     
            
            }
    
            function setting_api(){
    
                    
                if( $(".save-btn").attr("action")  === "api"){
                    /* AJAX For setting api generation */ 
    
                    var api_switch = $("select[name='api-switch']").val();
    
                    /* Chat GPT */ 
                    var api_key = $("input[name='key']").val();
                    var max_tokens = $("input[name='max_tokens']").val();
                    var model = $("select[name='model']").val();
                    var temperature = $("input[name='temperature']").val();
                    var presence_penalty = $("input[name='presence_penalty']").val();
                    var fequency_penalty = $("input[name='fequency_penalty']").val();
    
                    /* Gemini Settings */ 
                    var gemini_api_key = $("input[name='gemini_key']").val();
                    var gemini_max_tokens = $("input[name='gemini_max_tokens']").val();
                    var gemini_temperature = $("input[name='gemini_temperature']").val();
                    var gemini_topk = $("input[name='gemini_topk']").val();
                    var gemini_topp = $("input[name='gemini_topp']").val();
                    var gemini_model = $("select[name='gemini_model']").val();
    
    
                    /* Perplexity  */ 
                    var perplexity_api_key = $("input[name='perplexity_api_key']").val();
                    var perplexity_max_tokens = $("input[name='perplexity_max_tokens']").val();
                    var perplexity_model = $("select[name='perplexity_model']").val();
                    var perplexity_temperature = $("input[name='perplexity_temperature']").val();
                    var perplexity_presence_penalty = $("input[name='perplexity_presence_penalty']").val();
                    var perplexity_fequency_penalty = $("input[name='perplexity_fequency_penalty']").val();
    
                    /* Fireworks  */ 
                    var fireworks_api_key = $("input[name='fireworks_api_key']").val();
                    var fireworks_max_tokens = $("input[name='fireworks_max_tokens']").val();
                    var fireworks_model = $("select[name='fireworks_model']").val();
                    var fireworks_temperature = $("input[name='fireworks_temperature']").val();
                    // var fireworks_presence_penalty = $("input[name='fireworks_presence_penalty']").val();
                    // var fireworks_fequency_penalty = $("input[name='fireworks_fequency_penalty']").val();
    
    
                    const company_data = {
                        action: "setting_api",
                        "function_cb": "api",
    
                        "api_switch":api_switch,
    
                        "api_key":api_key,
                        "model":model,
                        "max_tokens":max_tokens,
                        "temperature":temperature,
                        "presence_penalty":presence_penalty,
                        "fequency_penalty":fequency_penalty,
    
                        "gemini_api_key":gemini_api_key,
                        "gemini_max_tokens":gemini_max_tokens,
                        "gemini_temperature":gemini_temperature,
                        "gemini_topk":gemini_topk,
                        "gemini_topp":gemini_topp,
                        "gemini_model":gemini_model,
    
                        "perplexity_api_key":perplexity_api_key,
                        "perplexity_model":perplexity_model,
                        "perplexity_max_tokens":perplexity_max_tokens,
                        "perplexity_temperature":perplexity_temperature,
                        "perplexity_presence_penalty":perplexity_presence_penalty,
                        "perplexity_fequency_penalty":perplexity_fequency_penalty,

                        "fireworks_api_key":fireworks_api_key,
                        "fireworks_model":fireworks_model,
                        "fireworks_max_tokens":fireworks_max_tokens,
                        "fireworks_temperature":fireworks_temperature,
                        // "fireworks_presence_penalty":fireworks_presence_penalty,
                        // "fireworks_fequency_penalty":fireworks_fequency_penalty,
    
                    };
                    
                    $.ajax({
                        url: account_data.ajaxurl, // AJAX handler
                        data: company_data,
                        type: "POST",
                        success: function (res) {
                            console.log('Prompt',res);
    
                            if(res.status === "success"){
                                toastr.success("Your API setting has been saved", 'Success');
                                // alert("Your API setting has been saved");
                                // location.reload();
    
                            }
                        
                        },
                        error: function (error) {
                            console.log('error',error);
                        },
                    });
    
    
                }else if( $(".save-btn").attr("action")  === "prompt"){
                    
                    if(account_data.role =="subscriber"  || (account_data.role === null) ){
                        /* AJAX For setting api generation */ 
                        var challenges = $("div[name='challenges']").html();
                        var company_overview = $("div[name='company_overview']").html();
                        var opportunity_pc = $("div[name='opportunity_pc']").html();
                        var opportunity_eb = $("div[name='opportunity_eb']").html();
                        var stakeholder_considerations = $("div[name='stakeholder_consideration']").html();
                        var understanding_stakeholder = $("div[name='understanding_stakeholder']").html();
                        var discovery_pc = $("div[name='discovery_pc']").html();
                        var discovery_eb = $("div[name='discovery_eb']").html();
                                
                        localStorage.setItem("challenges_text_question", challenges);
                        localStorage.setItem("company_overview_text_question", company_overview);
                        localStorage.setItem("opportunity_pc_text_question", opportunity_pc);
                        localStorage.setItem("opportunity_eb_text_question", opportunity_eb);
                        localStorage.setItem("stakeholder_consideration_text_question", stakeholder_consideration_text_question);
                        localStorage.setItem("understanding_stakeholder_text_question", understanding_stakeholder_text_question);
                        localStorage.setItem("discovery_pc_text_question", opportunitdiscovery_pc_text_questiony_pc);
                        localStorage.setItem("discovery_eb_text_question", opportunitdiscovery_eb_text_questiony_pc);
                        localStorage.setItem("discovery_eb_text_question", opportunitdiscovery_eb_text_questiony_pc);
                 
                        //  alert("Your Prompt has been saved");
                         toastr.success("Your Prompt has been saved", 'Success');
                    }
                    
                    else{
                        /* AJAX For setting api generation */ 
                        var challenges = $("div[name='challenges']").html();
                        var company_overview = $("div[name='company_overview']").html();
                        var opportunity_pc = $("div[name='opportunity_pc']").html();
                        var opportunity_eb = $("div[name='opportunity_eb']").html();
                        var stakeholder_considerations = $("div[name='stakeholder_consideration']").html();
                        var understanding_stakeholder = $("div[name='understanding_stakeholder']").html();
                        var discovery_pc = $("div[name='discovery_pc']").html();
                        var discovery_eb = $("div[name='discovery_eb']").html();
                        var system_prompt = $("div[name='system_prompt']").html();
                       
        
                        const company_data = {
                            action: "setting_api",
                            "function_cb": "prompt",
                            "challenges":challenges,
                            "company_overview":company_overview,
                            "opportunity_pc":opportunity_pc,
                            "opportunity_eb":opportunity_eb,
                            "stakeholder_considerations":stakeholder_considerations,
                            "understanding_stakeholder":understanding_stakeholder,
                            "discovery_pc":discovery_pc,
                            "discovery_eb":discovery_eb,
                            "system_prompt":system_prompt
                        };
    
                        $.ajax({
                        url: account_data.ajaxurl, // AJAX handler
                        data: company_data,
                        type: "POST",
                        success: function (res) {
                            console.log('Prompt',res);
        
                            if(res.status === "success"){
                            toastr.success("Your Prompt has been saved", 'Success');
    
                                // alert("Your Prompt has been saved");
                                //location.reload();
        
                            }
                            
                        },
                        error: function (error) {
                            console.log('error',error);
                        },
                        });
                    
                    
                    }
                }else if( ($(".save-btn").attr("action")  === "profile") || $(".save-btn.profile").attr("action")  === "profile"){
                    /* AJAX For setting api generation */ 
                    var form = $("#profile_form");
                    console.log("profile submitted");
                    form.submit();
    
                } else{
                    console.log("No setting was submitted");
                }
                
                
            
            }
    
    
            function company(){
    
                $("#about-company-content").html("<div style='height:30px;background:#0693e326;border-radius:25px'><div class='loading'>Generating...</div></div>");
    
                 /* AJAX For company details generation */ 
                 var internal_company = "Patriot Growth Insurance Services";
                 var external_company = $("input[name='external_company']").val();
    
                 const company_data = {
                    action: "account_filter_by_company_details",
                    "internal_company":internal_company,
                    "external_company":external_company
                };
                $.ajax({
                    url: account_data.ajaxurl, // AJAX handler
                    data: company_data,
                    type: "POST",
                    success: function (res) {
                        console.log('The Company',res);
                        // $(".about-company").show();
    
                      
                        if(validURL(internal_company) && validURL(external_company) ){
                            /* load default images */
                            $("img.external-company-logo").attr("src",res.external_company_logo);
                            $("img.internal-company-logo").attr("src",res.internal_company_logo);
                            jQuery(".result-logo").attr("style","");
                             $(".result-logo img").show();
                        }
                        else{
                            // $(".result-logo img").show();
                            // testing for just challenges + others can stested later
                            jQuery(".challenges_logo").attr("style",`background:url(${account_data.challenges_logo})`);
                            jQuery(".insight_logo").attr("style",`background:url(${account_data.insight_logo})`);
                            jQuery(".capability_logo").attr("style",`background:url(${account_data.capability_logo})`);
                            jQuery(".impact_logo").attr("style",`background:url(${account_data.impact_logo})`);
                            jQuery(".value_logo").attr("style",`background:url(${account_data.value_logo})`);
    
                            $(".result-logo img").hide();
    
                        }
    
                        /* Load Content */
                        /* Customer Name & Bio */
                        external_company = external_company.charAt(0).toUpperCase() + external_company.slice(1);
                        internal_company = internal_company.charAt(0).toUpperCase() + internal_company.slice(1);
                        
                        $(".cname.external-company-name").html(external_company);
                        $(".cname.internal-company-name").html(internal_company);
                        $(".cname.both-company-name").html(internal_company +" VS "+ external_company);
                        $(".cname.external-company-name").eq(0).html(external_company+"<div class='h4 section-title'> Customer's Company Brief </div> ");
    
                        // $(".cname.internal-company-name").html(res.internal_company_logo);
                        
                        $("#company-profile-content").html(res.company_bio);
    
    
    
                    },
                    error: function (error) {
                        console.log('error',error);
                    },
                });
            
            }
    
    
            function validURL(str) {
                var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
                  '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
                  '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
                  '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
                  '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
                  '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
                return !!pattern.test(str);
              }
    
    
            function context_chat(){
    
                var chat_input = $("input#chat-input").val();
                $("input#chat-input").val("");//empty input for new input
                var external_company = $("input[name='external_company']").val();
    
    
                var data = {
                    action: "account_filter_by_ajax",
                    "client_request":chat_input,
                    "challenges" : account_data.challenges,
                    "overview" : account_data.company_overview,
                    "consideration" : account_data.stakeholder_considerations,
                    "understanding" : account_data.understanding_stakeholder,
                    "opportunity_eb" : account_data.opportunity_eb,
                    "opportunity_pc" : account_data.opportunity_pc,
                    "discovery_pc" : account_data.discovery_pc,
                    "discovery_eb" : account_data.discovery_eb,
                    "external_company":external_company,
                    "pid": account_data.pid,
    
                    "type":"chat",
                };
    
                
                $.ajax({
                url: account_data.ajaxurl, // AJAX handler
                data: data,
                type: "POST",
                success: function (result) {
                    console.log('Chat',result);
                    if(result.response === null){
                        context_chat();
                    }else{
                    //    account_data.chat.push({'user':chat_input});
                       var pretext = "";
                       setTimeout(function(){
                            jQuery(".assistant-request.temp").remove();  
                        },500);
                    /* */ 
        
                       jQuery(".chat-body").append(`<div class='main-assistant-request'> <div class='assistant-request'> <span> ${result.response} </span> </div><div class='ai-sec'> <div class='ai-div'>AI </div></div> </div> `);
                       jQuery(".chat-body").scrollTop(jQuery(".chat-body")[0].scrollHeight);
    
    
                    }
                    
                 
                },
                error: function (error) {
                    console.log('error',error);
                },
                });
            }
    
    
            function chat1(){
    
                var internal_company = "Patriot Growth Insurance Services";
                var external_company = $("input[name='external_company']").val();
                var stakeholder = $("input[name='stakeholder']").val();
     
                // console.log("internal_company",internal_company);
                // console.log("external_company",external_company);
    
                if( ( account_data.role =="subscriber") || (account_data.role === null) ){
                    challenges_text_question = localStorage.getItem("challenges_text_question");
                    overview_text_question = localStorage.getItem("overview_text_question");
                    opportunity_pc_text_question = localStorage.getItem("opportunity_pc_text_question");
                    opportunity_eb_text_question = localStorage.getItem("insight_text_question");
                    consideration_text_question = localStorage.getItem("consideration_text_question");
                    understanding_text_question = localStorage.getItem("understanding_text_question");
                    discovery_pc_text_question = localStorage.getItem("discovery_pc_text_question");
                    discovery_eb_text_question = localStorage.getItem("discovery_eb_text_question");
                    
                    var data = {
                        action: "account_filter_by_ajax",
                        "internal_company":internal_company,
                        "external_company":external_company,
                        "type":"company_overview",
                        "challenges_text_question":challenges_text_question,
                        "overview_text_question":overview_text_question,
                        "opportunity_pc_text_question":opportunity_pc_text_question,
                        "opportunity_eb_text_question":opportunity_eb_text_question,
                        "consideration_text_question":consideration_text_question,
                        "understanding_text_question":understanding_text_question,
                        "discovery_pc_text_question":discovery_pc_text_question,
                        "discovery_pc_text_question":discovery_eb_text_question,
                    };
                    
                }else{
                
                    var data = {
                        action: "account_filter_by_ajax",
                        "internal_company":internal_company,
                        "external_company":external_company,
                        "type":"company_overview",
                    };
                }
    
                
                $.ajax({
                url: account_data.ajaxurl, // AJAX handler
                data: data,
                type: "POST",
                success: function (result) {
                    console.log('OverviewResponse',result);
                    if(result.response === null){
                        chat1();
                    }else{
                       account_data.company_overview = result.response;
                       var pretext = "";
    
                        $("#company-profile-content").html(pretext+result.response)
                        $("#company-profile-content-download").html(pretext+result.response)
                    }
                    
                 
                },
                error: function (error) {
                    console.log('error',error);
                },
                });
            }
    
            function chat2(){
    
                var internal_company = "Patriot Growth Insurance Services";
                var external_company = $("input[name='external_company']").val();
                var stakeholder = $("input[name='stakeholder']").val();
     
                // console.log("internal_company",internal_company);
                // console.log("external_company",external_company);
    
                if( ( account_data.role =="subscriber") || (account_data.role === null) ){
                    challenges_text_question = localStorage.getItem("challenges_text_question");
                    overview_text_question = localStorage.getItem("overview_text_question");
                    opportunity_pc_text_question = localStorage.getItem("opportunity_pc_text_question");
                    opportunity_eb_text_question = localStorage.getItem("insight_text_question");
                    consideration_text_question = localStorage.getItem("consideration_text_question");
                    understanding_text_question = localStorage.getItem("understanding_text_question");
                    discovery_pc_text_question = localStorage.getItem("discovery_pc_text_question");
                    discovery_eb_text_question = localStorage.getItem("discovery_eb_text_question");
                    
                    var data = {
                        action: "account_filter_by_ajax",
                        "internal_company":internal_company,
                        "external_company":external_company,
                        "type":"challenges",
                        "challenges_text_question":challenges_text_question,
                        "overview_text_question":overview_text_question,
                        "opportunity_pc_text_question":opportunity_pc_text_question,
                        "opportunity_eb_text_question":opportunity_eb_text_question,
                        "consideration_text_question":consideration_text_question,
                        "understanding_text_question":understanding_text_question,
                        "discovery_pc_text_question":discovery_pc_text_question,
                        "discovery_pc_text_question":discovery_eb_text_question,
                    };
                    
                }else{
                
                    var data = {
                        action: "account_filter_by_ajax",
                        "internal_company":internal_company,
                        "external_company":external_company,
                        "type":"challenges",
                    };
                }
    
                
                $.ajax({
                url: account_data.ajaxurl, // AJAX handler
                data: data,
                type: "POST",
                success: function (result) {
                    console.log('ChallengesResponse',result);
                    if(result.response === null){
                        chat2();
                    }else{
                       account_data.challenges = result.response;
                       var pretext = "";
    
                        $("#challenges-content").html(pretext+result.response)
                        $("#challenges-content-download").html(pretext+result.response)
                    }
                    
                 
                },
                error: function (error) {
                    console.log('error',error);
                },
                });
            }
    
    
            function chat3(){
    
                var internal_company = "Patriot Growth Insurance Services";
                var external_company = $("input[name='external_company']").val();
                var stakeholder = $("input[name='stakeholder']").val();
     
                // console.log("internal_company",internal_company);
                // console.log("external_company",external_company);
    
                if( ( account_data.role =="subscriber") || (account_data.role === null) ){
                    challenges_text_question = localStorage.getItem("challenges_text_question");
                    overview_text_question = localStorage.getItem("overview_text_question");
                    opportunity_pc_text_question = localStorage.getItem("opportunity_pc_text_question");
                    opportunity_eb_text_question = localStorage.getItem("insight_text_question");
                    consideration_text_question = localStorage.getItem("consideration_text_question");
                    understanding_text_question = localStorage.getItem("understanding_text_question");
                    discovery_pc_text_question = localStorage.getItem("discovery_pc_text_question");
                    discovery_eb_text_question = localStorage.getItem("discovery_eb_text_question");
                    
                    var data = {
                        action: "account_filter_by_ajax",
                        "internal_company":internal_company,
                        "external_company":external_company,
                        "challenges" : account_data.challenges,
                        "overview" : account_data.company_overview,
                        "type":"opportunity_pc",
                        "challenges_text_question":challenges_text_question,
                        "overview_text_question":overview_text_question,
                        "opportunity_pc_text_question":opportunity_pc_text_question,
                        "opportunity_eb_text_question":opportunity_eb_text_question,
                        "consideration_text_question":consideration_text_question,
                        "understanding_text_question":understanding_text_question,
                        "discovery_pc_text_question":discovery_pc_text_question,
                        "discovery_pc_text_question":discovery_eb_text_question,
                    };
                    
                }else{
                
                    var data = {
                        action: "account_filter_by_ajax",
                        "internal_company":internal_company,
                        "external_company":external_company,
                        "challenges" : account_data.challenges,
                        "overview" : account_data.company_overview,
                        "type":"opportunity_pc",
                    };
                }
    
                
                $.ajax({
                url: account_data.ajaxurl, // AJAX handler
                data: data,
                type: "POST",
                success: function (result) {
                    console.log('OpportnityPCResponse',result);
                    if(result.response === null){
                        chat3();
                    }else{
                       account_data.opportunity_pc = result.response;
                       var pretext = "";
    
                        $("#bussiness-vo-content").html(pretext+result.response)
                        $("#bussiness-vo-content-download").html(pretext+result.response)
                    }
                    
                 
                },
                error: function (error) {
                    console.log('error',error);
                },
                });
               
            }
    
            function chat4(){
     
                var internal_company = "Patriot Growth Insurance Services";
                var external_company = $("input[name='external_company']").val();
                var stakeholder = $("input[name='stakeholder']").val();
     
                // console.log("internal_company",internal_company);
                // console.log("external_company",external_company);
    
                if( ( account_data.role =="subscriber") || (account_data.role === null) ){
                    challenges_text_question = localStorage.getItem("challenges_text_question");
                    overview_text_question = localStorage.getItem("overview_text_question");
                    opportunity_pc_text_question = localStorage.getItem("opportunity_pc_text_question");
                    opportunity_eb_text_question = localStorage.getItem("insight_text_question");
                    consideration_text_question = localStorage.getItem("consideration_text_question");
                    understanding_text_question = localStorage.getItem("understanding_text_question");
                    discovery_pc_text_question = localStorage.getItem("discovery_pc_text_question");
                    discovery_eb_text_question = localStorage.getItem("discovery_eb_text_question");
                    
                    var data = {
                        action: "account_filter_by_ajax",
                        "internal_company":internal_company,
                        "external_company":external_company,
                        "challenges" : account_data.challenges,
                        "overview" : account_data.company_overview,
                        "type":"opportunity_eb",
                        "challenges_text_question":challenges_text_question,
                        "overview_text_question":overview_text_question,
                        "opportunity_pc_text_question":opportunity_pc_text_question,
                        "opportunity_eb_text_question":opportunity_eb_text_question,
                        "consideration_text_question":consideration_text_question,
                        "understanding_text_question":understanding_text_question,
                        "discovery_pc_text_question":discovery_pc_text_question,
                        "discovery_pc_text_question":discovery_eb_text_question,
                    };
                    
                }else{
                
                    var data = {
                        action: "account_filter_by_ajax",
                        "internal_company":internal_company,
                        "external_company":external_company,
                        "challenges" : account_data.challenges,
                        "overview" : account_data.company_overview,
                        "type":"opportunity_eb",
                    };
                }
    
                
                $.ajax({
                url: account_data.ajaxurl, // AJAX handler
                data: data,
                type: "POST",
                success: function (result) {
                    console.log('OpportnityEBResponse',result);
                    if(result.response === null){
                        chat4();
                    }else{
                       account_data.opportunity_eb = result.response;
                       var pretext = "";
    
                        $("#solution-impact-content").html(pretext+result.response)
                        $("#solution-impact-content-download").html(pretext+result.response)
                    }
                    
                 
                },
                error: function (error) {
                    console.log('error',error);
                },
                });
               
            }
    
            function chat5(){
                
                var internal_company = "Patriot Growth Insurance Services";
                var external_company = $("input[name='external_company']").val();
                var stakeholder = $("input[name='stakeholder']").val();
     
                // console.log("internal_company",internal_company);
                // console.log("external_company",external_company);
    
                if( ( account_data.role =="subscriber") || (account_data.role === null) ){
                    challenges_text_question = localStorage.getItem("challenges_text_question");
                    overview_text_question = localStorage.getItem("overview_text_question");
                    opportunity_pc_text_question = localStorage.getItem("opportunity_pc_text_question");
                    opportunity_eb_text_question = localStorage.getItem("insight_text_question");
                    consideration_text_question = localStorage.getItem("consideration_text_question");
                    understanding_text_question = localStorage.getItem("understanding_text_question");
                    discovery_pc_text_question = localStorage.getItem("discovery_pc_text_question");
                    discovery_eb_text_question = localStorage.getItem("discovery_eb_text_question");
                    
                    var data = {
                        action: "account_filter_by_ajax",
                        "internal_company":"Patriot Growth Insurance Services",
                        "external_company":external_company,
                        "challenges" : account_data.challenges,
                        "company_overview" : account_data.company_overview,
                        "opportunity_eb" : account_data.opportunity_eb,
                        "opportunity_pc" : account_data.opportunity_pc,
                        "type":"stakeholder_considerations",
                        "challenges_text_question":challenges_text_question,
                        "overview_text_question":overview_text_question,
                        "opportunity_pc_text_question":opportunity_pc_text_question,
                        "opportunity_eb_text_question":opportunity_eb_text_question,
                        "consideration_text_question":consideration_text_question,
                        "understanding_text_question":understanding_text_question,
                        "discovery_pc_text_question":discovery_pc_text_question,
                        "discovery_pc_text_question":discovery_eb_text_question,
                    };
                    
                }else{
                
                    var data = {
                        action: "account_filter_by_ajax",
                        "internal_company":internal_company,
                        "external_company":external_company,
                        "challenges" : account_data.challenges,
                        "overview" : account_data.company_overview,
                        "opportunity_eb" : account_data.opportunity_eb,
                        "opportunity_pc" : account_data.opportunity_pc,
                        "type":"stakeholder_considerations",
                    };
                }
    
                
                $.ajax({
                url: account_data.ajaxurl, // AJAX handler
                data: data,
                type: "POST",
                success: function (result) {
                    console.log('StakeHolderConsiderationResponse',result);
                    if(result.response === null){
                        chat5();
                    }else{
                       account_data.stakeholder_considerations = result.response;
                       var pretext = "";
    
                        $("#key-sc-content").html(pretext+result.response)
                        $("#key-sc-content-download").html(pretext+result.response)
                    }
                    
                 
                },
                error: function (error) {
                    console.log('error',error);
                },
                });
            }
    
            function chat6(){
                
                var internal_company = "Patriot Growth Insurance Services";
                var external_company = $("input[name='external_company']").val();
                var stakeholder = $("input[name='stakeholder']").val();
     
                // console.log("internal_company",internal_company);
                // console.log("external_company",external_company);
    
                if( ( account_data.role =="subscriber") || (account_data.role === null) ){
                    challenges_text_question = localStorage.getItem("challenges_text_question");
                    overview_text_question = localStorage.getItem("overview_text_question");
                    opportunity_pc_text_question = localStorage.getItem("opportunity_pc_text_question");
                    opportunity_eb_text_question = localStorage.getItem("insight_text_question");
                    consideration_text_question = localStorage.getItem("consideration_text_question");
                    understanding_text_question = localStorage.getItem("understanding_text_question");
                    discovery_pc_text_question = localStorage.getItem("discovery_pc_text_question");
                    discovery_eb_text_question = localStorage.getItem("discovery_eb_text_question");
                    
                    var data = {
                        action: "account_filter_by_ajax",
                        "internal_company":internal_company,
                        "external_company":external_company,
                        "stakeholder":stakeholder,
                        "consideration" : account_data.stakeholder_considerations,
                        "type":"understanding_stakeholder",
                        "challenges_text_question":challenges_text_question,
                        "stakeholder":stakeholder,
                        "overview_text_question":overview_text_question,
                        "opportunity_pc_text_question":opportunity_pc_text_question,
                        "opportunity_eb_text_question":opportunity_eb_text_question,
                        "consideration_text_question":consideration_text_question,
                        "understanding_text_question":understanding_text_question,
                        "discovery_pc_text_question":discovery_pc_text_question,
                        "discovery_pc_text_question":discovery_eb_text_question,
                    };
                    
                }else{
                
                    var data = {
                        action: "account_filter_by_ajax",
                        "internal_company":internal_company,
                        "external_company":external_company,
                        "consideration" : account_data.stakeholder_considerations,
                        "type":"understanding_stakeholder",
                        "stakeholder":stakeholder,
    
                    };
                }
    
                
                $.ajax({
                url: account_data.ajaxurl, // AJAX handler
                data: data,
                type: "POST",
                success: function (result) {
                    console.log('UnderstandingStakeHolderResponse',result);
                    if(result.response === null){
                        chat6();
                    }else{
                       account_data.understanding_stakeholder = result.response;
                       var pretext = "";
    
                        $("#understanding-ys-content").html(pretext+result.response)
                        $("#understanding-ys-content-download").html(pretext+result.response)
                    }
                    
                 
                },
                error: function (error) {
                    console.log('error',error);
                },
                });
            }
     
    
            function chat7(){
                
                var internal_company = "Patriot Growth Insurance Services";
                var external_company = $("input[name='external_company']").val();
                var stakeholder = $("input[name='stakeholder']").val();
     
                // console.log("internal_company",internal_company);
                // console.log("external_company",external_company);
    
                if( ( account_data.role =="subscriber") || (account_data.role === null) ){
                    challenges_text_question = localStorage.getItem("challenges_text_question");
                    overview_text_question = localStorage.getItem("overview_text_question");
                    opportunity_pc_text_question = localStorage.getItem("opportunity_pc_text_question");
                    opportunity_eb_text_question = localStorage.getItem("insight_text_question");
                    consideration_text_question = localStorage.getItem("consideration_text_question");
                    understanding_text_question = localStorage.getItem("understanding_text_question");
                    discovery_pc_text_question = localStorage.getItem("discovery_pc_text_question");
                    discovery_eb_text_question = localStorage.getItem("discovery_eb_text_question");
                    
                    var data = {
                        action: "account_filter_by_ajax",
                        "internal_company":internal_company,
                        "external_company":external_company,
                        "type":"discovery_pc",
                        "challenges_text_question":challenges_text_question,
                        "overview_text_question":overview_text_question,
                        "opportunity_pc_text_question":opportunity_pc_text_question,
                        "opportunity_eb_text_question":opportunity_eb_text_question,
                        "consideration_text_question":consideration_text_question,
                        "understanding_text_question":understanding_text_question,
                        "discovery_pc_text_question":discovery_pc_text_question,
                        "discovery_pc_text_question":discovery_eb_text_question,
                    };
                    
                }else{
                
                    var data = {
                        action: "account_filter_by_ajax",
                        "internal_company":internal_company,
                        "external_company":external_company,
                        "type":"discovery_pc",
                    };
                }
    
                
                $.ajax({
                url: account_data.ajaxurl, // AJAX handler
                data: data,
                type: "POST",
                success: function (result) {
                    console.log('DiscoveryPCResponse',result);
                    if(result.response === null || ( countWords(result.response)<200 )) {
                        chat7();
                    }else{
                       account_data.discovery_pc = result.response;
                       var pretext = "";
    
                        $("#value-in-ade-content").html(pretext+result.response)
                        $("#value-in-ade-content-download").html(pretext+result.response)
                    }
                    
                 
                },
                error: function (error) {
                    console.log('error',error);
                },
                });
            }
    
    
            function chat8(){
                
                var internal_company = "Patriot Growth Insurance Services";
                var external_company = $("input[name='external_company']").val();
                var stakeholder = $("input[name='stakeholder']").val();
     
                // console.log("internal_company",internal_company);
                // console.log("external_company",external_company);
    
                if( ( account_data.role =="subscriber") || (account_data.role === null) ){
                    challenges_text_question = localStorage.getItem("challenges_text_question");
                    overview_text_question = localStorage.getItem("overview_text_question");
                    opportunity_pc_text_question = localStorage.getItem("opportunity_pc_text_question");
                    opportunity_eb_text_question = localStorage.getItem("insight_text_question");
                    consideration_text_question = localStorage.getItem("consideration_text_question");
                    understanding_text_question = localStorage.getItem("understanding_text_question");
                    discovery_pc_text_question = localStorage.getItem("discovery_pc_text_question");
                    discovery_eb_text_question = localStorage.getItem("discovery_eb_text_question");
                    
                    var data = {
                        action: "account_filter_by_ajax",
                        "internal_company":internal_company,
                        "external_company":external_company,
                        "discovery_pc" : account_data.discovery_pc,
                        "type":"discovery_eb",
                        "challenges_text_question":challenges_text_question,
                        "overview_text_question":overview_text_question,
                        "opportunity_pc_text_question":opportunity_pc_text_question,
                        "opportunity_eb_text_question":opportunity_eb_text_question,
                        "consideration_text_question":consideration_text_question,
                        "understanding_text_question":understanding_text_question,
                        "discovery_pc_text_question":discovery_pc_text_question,
                        "discovery_pc_text_question":discovery_eb_text_question,
                    };
                    
                }else{
                
                    var data = {
                        action: "account_filter_by_ajax",
                        "internal_company":internal_company,
                        "external_company":external_company,
                        "discovery_pc" : account_data.discovery_pc,
                        "type":"discovery_eb",
                    };
                }
    
                
                $.ajax({
                url: account_data.ajaxurl, // AJAX handler
                data: data,
                type: "POST",
                success: function (result) {
                    console.log('DiscoveryEBResponse',result);
                    if(result.response === null || ( countWords(result.response)<200 )) {
                        chat8();
                    }else{
                       account_data.discovery_eb = result.response;
                       var pretext = "";
    
                        $("#value-action-ae-content").html(pretext+result.response);
                        $("#value-action-ae-content-download").html(pretext+result.response);
                        // $(".chat-btn").show();
    
                    }
    
                },
                error: function (error) {
                    console.log('error',error);
                },
                });
            }
    
    
    
            $("#profile_form").on("submit",function(event) {
                var user_image = $("input[name='profile']");
    
                        event.preventDefault();
                
                        console.log('Uploading . . . ');
                
                        // Get the files from the input
                        var formData =  new FormData(this);
    
                        // // Send the data.
                    
                        $.ajax({
                            url: account_data.ajaxurl, // AJAX handler
                            data: formData,
                            enctype: 'multipart/form-data',
                            processData: false, contentType: false, cache: false,
                            type: "POST",
                            success: function (res) {
                                console.log('Profile',res);
        
                                if(res.status === "success"){
                                    alert("Your profile setting has been saved");
                                    location.reload();
        
                                }else{
                                toastr.success("All field are required", 'Success');
    
                                    // alert("All field are required");
    
                                }
                            
                            },
                            error: function (error) {
                                console.log('error',error);
                            },
                        });
                    
                
            });
    
    
            $("#create_user").on("submit",function(event) {
             
    
                        event.preventDefault();
                
                        console.log('Creating user . . . ');
                
                        // Get the files from the input
                        var formData =  new FormData(this);
    
                        // // Send the data.
                    
                        $.ajax({
                            url: account_data.ajaxurl, // AJAX handler
                            data: formData,
                            // enctype: 'multipart/form-data',
                            processData: false, contentType: false, cache: false,
                            type: "POST",
                            success: function (res) {
                                console.log('Profile',res);
        
                                if(res.result === "success"){
                                    // alert("User has been created");
                                    toastr.success("User has been created", 'Success');
    
                                    location.reload();
        
                                }else{
                                    toastr.error(res.result, 'Error');
    
                                    // alert(res.result);
                                }
                            
                            },
                            error: function (error) {
                                console.log('error',error);
                            },
                        });
                    
                
            });
    
    
    
            $("#edit_user").on("submit",function(event) {
             
    
                event.preventDefault();
        
                console.log('Updating user . . . ');
        
                // Get the files from the input
                var formData =  new FormData(this);
    
                // // Send the data.
            
                $.ajax({
                    url: account_data.ajaxurl, // AJAX handler
                    data: formData,
                    // enctype: 'multipart/form-data',
                    processData: false, contentType: false, cache: false,
                    type: "POST",
                    success: function (res) {
                        console.log('Profile',res);
    
                        if(res.result === "success"){
                            // alert("User has been created");
                            toastr.success("User has been created", 'Success');
    
                            location.reload();
    
                        }else{
                            alert(res.result);
                        }
                    
                    },
                    error: function (error) {
                        console.log('error',error);
                    },
                });
            
        
            });
    
    
    
            $(".delete_user").on("click",function(event) {
             
    
                event.preventDefault();
        
                console.log('deleting user . . . ');
        
             
                // // Send the data.
            
                $.ajax({
                    url: account_data.ajaxurl, // AJAX handler
                    data: {
                        "action": "delete_user",
                        "user_id" : $(this).siblings("span.user_id").html(),
                    },
                    // enctype: 'multipart/form-data',
                    // processData: false, contentType: false, cache: false,
                    type: "POST",
                    success: function (res) {
                        console.log('deleted',res);
    
                        if(res.result === "success"){
                            // alert("User has been deleteds");
                            toastr.success("User has been deleted", 'Success');
                            location.reload();
    
                        }else{
                            // alert(res.result);
                            toastr.success(res.result, 'Error');
                        }
                    
                    },
                    error: function (error) {
                        console.log('error',error);
                    },
                });
            
        
            });
    
    
    
            $("#login_user").on("submit",function(event) {
             
    
                event.preventDefault();
        
                console.log('Creating user . . . ');
        
                // Get the files from the input
                var formData =  new FormData(this);
    
                // // Send the data.
            
                $.ajax({
                    url: account_data.home, // AJAX handler
                    data: formData,
                    // enctype: 'multipart/form-data',
                    processData: false, contentType: false, cache: false,
                    type: "POST",
                    success: function (res) {
                    //    console.log('res',res);
    
                        if(res.result === "success"){
                             window.location.href = account_data.dashboard;
    
                            // console.log('success',res);
    
                        }else{
                            $(".login-error").show();
                            $(".login-error").html(res.result);
                        }
                    
                    },
                    error: function (error) {
                        $("login-error").show().html(error);
                        // console.log('error',error);
                    },
                });
            
        
            });
    
    
    
            $("#register_user").on("submit",function(event) {
             
    
                event.preventDefault();
        
                console.log('Creating user . . . ');
        
                // Get the files from the input
                var formData =  new FormData(this);
    
                // // Send the data.
            
                $.ajax({
                    url: account_data.ajaxurl, // AJAX handler
                    data: formData,
                    // enctype: 'multipart/form-data',
                    processData: false, contentType: false, cache: false,
                    type: "POST",
                    success: function (res) {
                    //    console.log('res',res);
    
                        if(res.result === "success"){
                                         
                        // location.reload();
                            // console.log('success',res);
                            $(".register-error").show();
                            $(".register-error").html(res.result+ ": you can now login.");
                            $("input[type='email']").val('');
                            $("input[type='password']").val('');
                            $("input[type='text']").val('');
                            // $("input.register-btn").attr("disabled",true);
    
    
                        }else{
                            $(".register-error").show();
                            $(".register-error").html(res.result);
                        }
                    
                    },
                    error: function (error) {
                        $("login-error").show().html(error);
                        // console.log('error',error);
                    },
                });
            
        
            });
    
    
            //Save Subscriber  or guest prompt to browser
            if( (account_data.role ==="subscriber")  || (account_data.role ===null) ) {
                 $("div[name='challenges']").html(localStorage.getItem("challenges_text_question"));
                 $("div[name='impact']").html(localStorage.getItem("impact_text_question"));
                 $("div[name='insight']").html(localStorage.getItem("insight_text_question"));
                 $("div[name='hypotesis']").html(localStorage.getItem("challenges_text_question"));
                 $("div[name='capability']").html(localStorage.getItem("capability_text_question"));
            }
    
    
    
    
    
    
      });
    

    
    
    
    })(jQuery)
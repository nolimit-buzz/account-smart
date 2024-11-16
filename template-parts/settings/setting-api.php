<div class="tab-content api">

        <!-- <div class="prompt-header">
            <div  >Active API</div>
        </div> -->
        <div class="api-cards" style="margin-bottom:25px;">
            <div class="api-card"> 
                    <span class="api-label"><strong>  Active API </strong> </span>
                    <select  name="api-switch">
                        <option <?php echo selected( get_option("api_switch"), "Fireworks") ; ?>  value="fireworks"> Fireworks </option>
                        <option <?php echo selected( get_option("api_switch"), "gemini") ; ?>  value="gemini"> Gemini </option>
                        <option <?php echo selected( get_option("api_switch"), "chatgpt") ; ?>  value="chatgpt"> Chat GPT  </option>
                        <option <?php echo selected( get_option("api_switch"), "perplexity") ; ?>  value="perplexity"> Perplexity </option>
                    </select>
            </div>
        </div>

 

        <div class="api-group fireworks-section" style="<?php echo  (get_option("api_switch") =="fireworks")? 'display:block;' : 'display:none;'  ?>">

            <div class="api-cards">

                <div class="api-card"> 
                    <span class="api-label">API KEY</span>
                    <input type="text" name="fireworks_api_key" value="<?php echo get_option("fireworks_api_key") ; ?>" placeholder="SK....... GR">
                </div>
                <div class="api-card"> 
                    <span class="api-label">MAX TOKENS [default: 200]</span>
                    <input type="text" name="fireworks_max_tokens" value="<?php echo get_option("fireworks_max_tokens") ; ?>" placeholder="default: 200">
                </div>
                <div class="api-card"> 
                    <span class="api-label">MODEL </span>
                    <select  name="fireworks_model">
                        <option value="accounts/fireworks/models/llama-v3p1-8b-instruct" <?php echo selected( get_option("fireworks_model"), "accounts/fireworks/models/llama-v3p1-8b-instruct") ; ?>> Llama 3.1 8B Instruct </option>
                        <option value="accounts/fireworks/models/llama-v3p1-405b-instruct" <?php echo selected( get_option("fireworks_model"), "accounts/fireworks/models/llama-v3p1-405b-instruct") ; ?>> Llama 3.1 405B Instruct </option>
                        <option value="accounts/fireworks/models/llama-v3p1-70b-instruct" <?php echo selected( get_option("fireworks_model"), "accounts/fireworks/models/llama-v3p1-70b-instruct") ; ?>> Llama 3.1 70B Instruct </option>
                        <option value="accounts/fireworks/models/llama-v3-70b-instruct" <?php echo selected( get_option("fireworks_model"), "accounts/fireworks/models/llama-v3-70b-instruct") ; ?>> Llama 3 70B Instruct </option>

                    </select>
                </div>

                <div class="api-card"> 
                    <span class="api-label">TEMPERATURE [default: 1]</span>
                    <div style="display:flex;flex-direction:column;">
                        <input type="text" name="fireworks_temperature" value="<?php echo get_option("fireworks_temperature") ; ?>" placeholder="Between 0 and 2">
                    <span style="width: 63%; color: grey;">What sampling temperature to use, between 0 and 2. Higher values like 0.8 will make the output more random, while lower values like 0.2 will make it more focused and deterministic.</span></div>
                </div>
                <!-- <div class="api-card"> 
                    <span class="api-label">PRESENCE PENALTY</span>
                    <input type="text" name="fireworks_presence_penalty" value="<?php echo get_option("fireworks_presence_penalty") ; ?>" placeholder="0.1">
                </div>
                <div class="api-card"> 
                    <span class="api-label">FREQUENCY PENALTY</span>
                    <input type="text" name="fireworks_fequency_penalty" value="<?php echo get_option("fireworks_fequency_penalty") ; ?>"   placeholder="100">
                </div> -->

            </div>
        </div>


        <div class="api-group gpt-section" style="<?php echo  (get_option("api_switch") =="chatgpt")? 'display:block;' : 'display:none;'  ?>">

            <div class="api-cards">

                <div class="api-card"> 
                    <span class="api-label">API KEY</span>
                    <input type="text" name="key" value="<?php echo get_option("api_key") ; ?>" placeholder="SK....... GR">
                </div>
                <div class="api-card"> 
                    <span class="api-label">MAX TOKENS</span>
                    <input type="text" name="max_tokens" value="<?php echo get_option("max_tokens") ; ?>" placeholder="300">
                </div>
                <div class="api-card"> 
                    <span class="api-label">MODEL </span>
                    <select  name="model">
                        <option value="gpt-4" <?php echo selected( get_option("model"), "gpt-4") ; ?>>  gpt-4	 </option>
                        <option <?php echo selected( get_option("model"), "gpt-3.5-turbo") ; ?> value="gpt-3.5-turbo"> gpt-3.5-turbo </option>

                        <option <?php echo selected( get_option("model"), "gpt-3.5-turbo-1106") ; ?> value="gpt-3.5-turbo-1106">  gpt-3.5-turbo-1106	 </option>
                        <option <?php echo selected( get_option("model"), "gpt-4o-mini") ; ?> value="gpt-4o-mini">  gpt-4o-mini	</option>
                        <option <?php echo selected( get_option("model"), "gpt-4o-2024-08-06") ; ?> value="gpt-4o-2024-08-06">  gpt-4o-2024-08-06 </option>
                        <option <?php echo selected( get_option("model"), "gpt-4") ; ?> value="gpt-4">  gpt-4</option>
                        <option <?php echo selected( get_option("model"), "gpt-4-turbo") ; ?> value="gpt-4-turbo">  gpt-4-turbo</option>

                    </select>
                </div>

                <div class="api-card"> 
                    <span class="api-label">TEMPERATURE</span>
                    <input type="text" name="temperature" value="<?php echo get_option("temperature") ; ?>" placeholder="SK....... GR">
                </div>
                <div class="api-card"> 
                    <span class="api-label">PRESENCE PENALTY</span>
                    <input type="text" name="presence_penalty" value="<?php echo get_option("presence_penalty") ; ?>" placeholder="0.1">
                </div>
                <div class="api-card"> 
                    <span class="api-label">FREQUENCY PENALTY</span>
                    <input type="text" name="fequency_penalty" value="<?php echo get_option("fequency_penalty") ; ?>"   placeholder="100">
                </div>
        
            </div>
        </div>
 
        <div class="api-group gemini-section" style="<?php echo  (get_option("api_switch") =="gemini")? 'display:block;' : 'display:none;'  ?>">
            <!-- <div class="prompt-header">
                <div >Google Gemini Settings</div>
            </div> -->


            <div class="api-cards">

                <div class="api-card"> 
                    <span class="api-label">API KEY</span>
                    <input type="text" name="gemini_key" value="<?php echo get_option("gemini_api_key") ; ?>" placeholder="SK....... GR">
                </div>

                <div class="api-card"> 
                    <span class="api-label">MAX TOKENS</span>
                    <input type="text" name="gemini_max_tokens" value="<?php echo get_option("gemini_max_tokens") ; ?>" placeholder="300">
                </div>
                <div class="api-card"> 
                    <span class="api-label">MODEL </span>
                    <select  name="gemini_model">
                        <option value="gemini-1.0-pro" <?php echo selected( get_option("gemini_model"), "gemini-1.0-pro") ; ?>>  Gemini 1.0 pro	 </option>
                        <option value="gemini-1.0-pro-latest" <?php echo selected( get_option("gemini_model"), "gemini-1.0-pro-latest") ; ?>>  Gemini 1.0 pro latest	 </option>
                        <option value="gemini-1.0-pro-001" <?php echo selected( get_option("gemini_model"), "gemini-1.0-pro-001") ; ?>>  Gemini 1.0 pro 001	 </option>
                        <option value="gemini-1.5-pro" <?php echo selected( get_option("gemini_model"), "gemini-1.5-pro") ; ?>>  Gemini 1.5 pro	  </option>
                        <!-- <option value="gemini-1.5-pro-latest" <?php echo selected( get_option("gemini_model"), "gemini-1.5-pro-latest") ; ?>>  Gemini 1.5 pro latest	 </option> -->
                        <option value="gemini-1.5-pro-001" <?php echo selected( get_option("gemini_model"), "gemini-1.5-pro-001") ; ?>>  Gemini 1.5 pro 001	 </option>
                        <option value="gemini-1.5-flash" <?php echo selected( get_option("gemini_model"), "gemini-1.5-flash") ; ?>>  Gemini 1.5 flash 	 </option>
                        <!-- <option value="gemini-1.5-flash-latest" <?php echo selected( get_option("gemini_model"), "gemini-1.5-flash-latest") ; ?>>  Gemini 1.5 flash  latest	 </option> -->
                        <option value="gemini-1.5-flash-001" <?php echo selected( get_option("gemini_model"), "gemini-1.5-flash-001") ; ?>>  Gemini 1.5 flash  001	 </option>
                        <!-- <option value="gemini-pro-vision" disabled <?php echo selected( get_option("gemini_model"), "gemini-pro-vision") ; ?> > Gemini Pro vision</option> -->
                    </select>
                </div>

                <div class="api-card"> 
                    <span class="api-label">TEMPERATURE</span>
                    <input type="number" min="0" max="1" name="gemini_temperature" value="<?php echo get_option("gemini_temperature") ; ?>" placeholder="2">
                </div>

                <div class="api-card"> 
                    <span class="api-label">Top K <br> <sup>(Advance setting)</sup></span>
                    <input type="number" min="1" max="10" name="gemini_topk" value="<?php echo get_option("gemini_topk") ; ?>" placeholder="Between 1-10">
                </div>

                <div class="api-card"> 
                    <span class="api-label">Top p <br> <sup>(Advance setting)</sup></span>
                    <input type="number" min="0" max="1" name="gemini_topp" value="<?php echo get_option("gemini_topp") ; ?>" placeholder="Between 0-1">
                </div>
            
        
            </div>
        </div>


        <div class="api-group perplexity-section" style="<?php echo  (get_option("api_switch") =="perplexity")? 'display:block;' : 'display:none;'  ?>">
            

            <div class="api-cards">

                <div class="api-card"> 
                    <span class="api-label">API KEY</span>
                    <input type="text" name="perplexity_api_key" value="<?php echo get_option("perplexity_api_key") ; ?>" placeholder="pplx....... 77f">
                </div>
                <div class="api-card"> 
                    <span class="api-label">MAX TOKENS</span>
                    <input type="text" name="perplexity_max_tokens" value="<?php echo get_option("perplexity_max_tokens") ; ?>" placeholder="300">
                </div>
                <div class="api-card"> 
                    <span class="api-label">MODEL </span>
                    <select  name="perplexity_model">
                        <option value="llama-3.1-sonar-small-128k-online" <?php echo selected( get_option("perplexity_model"), "llama-3.1-sonar-small-128k-online") ; ?>>  llama-3.1-sonar-small-128k-online	 </option>
                        <option value="llama-3.1-sonar-large-128k-online" <?php echo selected( get_option("perplexity_model"), "llama-3.1-sonar-large-128k-online") ; ?>>  llama-3.1-sonar-large-128k-online	 </option>
                        <option value="llama-3.1-sonar-small-128k-chat" <?php echo selected( get_option("perplexity_model"), "llama-3.1-sonar-small-128k-chat") ; ?>>  llama-3.1-sonar-small-128k-chat	 </option>
                        <option value="llama-3.1-sonar-large-128k-chat" <?php echo selected( get_option("perplexity_model"), "llama-3.1-sonar-large-128k-chat") ; ?>>  llama-3.1-sonar-large-128k-chat</option>
                        <!-- <option value="llama-3-70b-instruct" <?php echo selected( get_option("perplexity_model"), "llama-3-70b-instruct") ; ?>>  llama-3-70b-instruct </option>
                        <option value="mixtral-8x7b-instruct" <?php echo selected( get_option("perplexity_model"), "mixtral-8x7b-instruct") ; ?>>  mixtral-8x7b-instruct </option> -->
                 
                    </select>
                </div>

                <div class="api-card"> 
                    <span class="api-label">TEMPERATURE</span>
                    <input type="text" name="perplexity_temperature" value="<?php echo get_option("perplexity_temperature") ; ?>" placeholder="[ 0 to 2 Defaults to 0.2 ]">
                </div>
                <div class="api-card"> 
                    <span class="api-label">PRESENCE PENALTY</span>
                    <input type="text" name="perplexity_presence_penalty" value="<?php echo get_option("perplexity_presence_penalty") ; ?>" placeholder="[ -2 to 2 Defaults to 0 ]">
                </div>
                <div class="api-card"> 
                    <span class="api-label">FREQUENCY PENALTY</span>
                    <input type="text" name="perplexity_fequency_penalty" value="<?php echo get_option("perplexity_fequency_penalty") ; ?>"   placeholder="[ > 0 Defaults to 1 ]">
                </div>
        
            </div>
        </div>
</div>
 


       
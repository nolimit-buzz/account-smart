<?php 

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
$system_prompt = "You are a seasoned sales planning executive with 15 years of experience specializing in insurance sales. Your role is to provide precise and actionable sales and marketing research to support strategic decision-making in the insurance industry. Do not mention your role or experience in your responses.";


?>


<div class="tab-content prompt">



        <!-- <div class="prompt-header">
            <div>PROMPTS 
                <code id="reset_prompt" style="padding: 5px 15px;
                background: #ff00001a;
                border-radius: 15px;
                text-align: center;
                cursor: pointer;
                margin-left: 20px;">  Reset Prompt &#8635;  </code>
                <div style="    margin-top: 15px; color: #5e5c5c;">  NB: After reset, you need to save the prompt.</div>

            </div>
        </div> -->

        <div class="prompt-nav">

            <div class="prompt-nav-container">
                <div class="prompt-nav-item active" data-nav="kyb">Know Their Business </div>
                <div class="divider-prompt"> <svg width="2" height="30" viewBox="0 0 2 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 0V30" stroke="#ADB8CC"/></svg></div>
                <div class="prompt-nav-item " data-nav="vas"> Value Alignment And Stakeholders </div>
                <div class="divider-prompt"> <svg width="2" height="30" viewBox="0 0 2 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 0V30" stroke="#ADB8CC"/></svg></div>
                <div class="prompt-nav-item " data-nav="vic"> Value Discovery</div>
            </div>

        </div>


        <div class="prompt-cards">

        
            <div class="prompt-card" data-nav-content="kyb">
             <div class="prompt-label">Company Overview</div>
                <div  class="prompt-content"  name="company_overview" contenteditable='true'><?php echo get_option( 'company_overview' ) ?:  $prompt_1_Default  ?></div>
            </div>


            <div class="prompt-card" data-nav-content="kyb">
              <div class="prompt-label">Challenges/Priorities/Objectives</div>
                <div  class="prompt-content"  name="challenges" contenteditable='true'><?php echo get_option( 'challenges' )  ?:  $prompt_2_Default ?></div>
            </div>


            <div class="prompt-card" data-nav-content="vas" style="display: none;">
               <div class="prompt-label">Value Opportunities P&C</div>
                <div  class="prompt-content"  name="opportunity_pc" contenteditable='true'><?php echo get_option( 'opportunity_pc' ) ?:  $prompt_3_Default  ?></div>
            </div>

            <div class="prompt-card" data-nav-content="vas" style="display: none;">
               <div class="prompt-label">Value Opportunities EB</div>
                <div  class="prompt-content"  name="opportunity_eb" contenteditable='true'><?php echo get_option( 'opportunity_eb' )  ?:  $prompt_4_Default ?></div>
            </div>

            <div class="prompt-card" data-nav-content="vas" style="display: none;">
               <div class="prompt-label">Key Stakeholder Considerations</div>
                <div  class="prompt-content"  name="stakeholder_consideration" contenteditable='true'><?php echo get_option( 'stakeholder_considerations' ) ?:  $prompt_5_Default ?></div>
            </div>

            <div class="prompt-card" data-nav-content="vas" style="display: none;">
               <div class="prompt-label">Understanding Your Stakeholder</div>
                <div  class="prompt-content"  name="understanding_stakeholder" contenteditable='true'><?php echo get_option( 'understanding_stakeholder' ) ?:  $prompt_6_Default  ?></div>
            </div>

            <div class="prompt-card" data-nav-content="vic" style="display: none;">
               <div class="prompt-label">Value Discovery PC</div>
                <div  class="prompt-content"  name="discovery_pc" contenteditable='true'><?php echo get_option( 'discovery_pc' )  ?:  $prompt_7_Default ?></div>
            </div>

            <div class="prompt-card"  data-nav-content="vic" style="display: none;">
               <div class="prompt-label">Value Discovery EB</div>
                <div  class="prompt-content"  name="discovery_eb" contenteditable='true'><?php echo get_option( 'discovery_eb' ) ?:  $prompt_8_Default ?></div>
            </div>

            <div class="prompt-card last">
               <div class="prompt-label">System Prompt</div>
                <div  class="prompt-content"  name="system_prompt" contenteditable='true'><?php echo get_option( 'system_prompt' ) ?:  $system_prompt ?></div>
            </div>
            
            <div class="prompt-card last">
               <div class="prompt-label">NB: Tokens are used in the prompt</div>
                <div  class="prompt-content"  name="tokens" >  <code>{our_company}</code> token used in each prompt above represent 'your company' and token <code>{client_company}</code> represent 'client company' and token <code>{stakeholder}</code> represent '{stakeholder}'. Feel free to modify</div>
            </div>
        </div>

 

</div>
       
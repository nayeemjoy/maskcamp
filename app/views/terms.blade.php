@extends('layouts.default')

@section('body')
    <header class="navbar-fixed-top">

      <div class="container-fluid">
        <div class="row">
            <div class="visible-xs hidden-sm hidden-md hidden-lg" id="xs-flag"></div>
            <div class="col-lg-3 col-md-3 col-sm-3">
               <a href="{{URL::to('/')}}" style="text-decoration:none"><h1 class="title">MaskCamp<small class="beta">Beta</small></h1></a>
            </div>
      </div>

      </div>
               
    </header>

    <div class="container-fluid">
      <div class="row">

        <div class="terms-section">
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 terms-list">
              
              <div class="list-group terms-list-group">
                  <a class="list-group-item list-group-item-02 active">
                    Terms Of Uses
                  </a>
                  <a href="#acceptance" class="list-group-item list-group-item-02">1. Your Acceptance of the TOU</a>
                  <a href="#registration" class="list-group-item list-group-item-02">2. Eligibility and Registration</a>
                  <a href="#conduct" class="list-group-item list-group-item-02">3. Rules of Conduct</a>
                  <a href="#modification" class="list-group-item list-group-item-02">4. Modifications to the TOU</a>
                  <a href="#license" class="list-group-item list-group-item-02">5. Your License to Use the Services</a>
                  <a href="#property" class="list-group-item list-group-item-02">6. Intellectual Property Rights</a>
                  <a href="#warranty" class="list-group-item list-group-item-02">7. Warranty Disclaimer</a>
                  <a href="#limitations" class="list-group-item list-group-item-02">8. Limitation of Liability</a>
                  <a href="#indemnity" class="list-group-item list-group-item-02">9. Indemnity</a>
                  <a href="#third" class="list-group-item list-group-item-02">10. Third Party Sites and Services</a>
                  <a href="#termination" class="list-group-item list-group-item-02">11. Termination</a>
                  <a href="#general" class="list-group-item list-group-item-02">12. General</a>
                  <a href="#questions" class="list-group-item list-group-item-02">13. Questions</a>
              </div>
              
            </div>

            <!--06-30-15-->
            <div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 col-sm-8 col-sm-offset-4 col-xs-7 col-xs-offset-5 terms-description">

                  
                  <div class="terms-description-list">
                    <h3>Effective Date: February 2, 2015</h3>
                    <p>
                      These Terms of Use (the “TOU”), govern your access to and use of MaskCamp.com’s (“we”, “our”, or “us”) website and/or mobile application that link to this TOU (the “Services”). MaskCamp.com is a place to express and share your feelings and views anonymously with your facebook friends or others who are using MaskCamp. It is a fun place to visit – in order to make sure it stays that way, you agree to only access or use the Services in compliance with the TOU.                  
                    </p>
                    <p>
                      If there’s anything you don’t understand in the TOU (or anywhere else on the Services), please contact us using the contact information below.                  
                    </p>

                    <p>
                      If you are under the age of majority in your country, and are not an emancipated minor (in countries that permit this) you must have your parent’s or guardian’s consent to enter into these TOU and to use MaskCamp.com.
                    </p>
                  </div>
                  <hr>

                  <div class="terms-description-list">
                    <h3 id="acceptance">1. Your Acceptance of the TOU</h3>
                    <p>
                      By accessing or using the Services (whether or not you are a registered member), you, your heirs, and assigns (collectively, “you”) are entering into a binding legal agreement with us, the people who supply the Services. MaskCamp.com is provided by MaskCamp.com Bangladesh, Ltd., an Bangladeshi company (the “Company”). The Company’s registration number is XXXXXXX and its registered office is at XXXXXXXXX. The Company is subject to Bangladesh law.                 
                    </p>
                    <p>
                      By accessing, using, registering for or receiving any of the Services, you are agreeing to the TOU and to the MaskCamp.com PRIVECY POLICY and COOKIE PLOICY, which are incorporated herein by reference. <b>If you do not accept and agree to the TOU then you must not access or use the Services.</b>                
                    </p>

                  </div>
                  <hr>

                  <div class="terms-description-list">
                    <h3 id="registration">2. Eligibility and Registration</h3>
                    <p>
                       <b>A) Age Requirements:</b> By accessing or using the Services, you affirm that you are either over the age of majority in your country, an emancipated minor, or possess legal parental or guardian consent, and are fully able and competent to enter into and comply with the terms and conditions in the TOU. In any case, you affirm that you are at least 13 years old. If you are under 13 years of age, you are not permitted to access or use the Services. If we become aware that you are using MaskCamp.com even though you are under 13, we will deactivate your account and attempt to block you from accessing the Services.                 
                    </p>
                    <p>
                      <b>B) Compliance with Laws:</b> You are responsible for making sure you follow all laws and regulations in the country in which you live when you access and use the Services. By using MaskCamp.com, you are confirming that you have not been convicted of, nor are you subject to any court order relating to, assault, violence, sexual misconduct or harassment                 
                    </p>

                    <p>
                      <b>C)</b> To use some parts of the Services, you may be required to register for an account with MaskCamp.com. You may also be able to register to use the Services by logging into your account with your credentials from certain third party social networking sites (e.g., Facebook). You confirm that you are the owner of this social media account and that you are entitled to disclose your social media login information to us. You authorize us to collect your authentication information, and other information that may be available on or through your social media account consistent with your applicable settings and instructions.
                    </p>

                    <p>
                      Only you are allowed to access your account. You should not let anyone else access your account. Sharing your account access might lead to all of your posts, comments, personal information being leaked or someone impersonating or pretending to be you. If you don’t keep your login details confidential or give it to anyone other than your parent or guardian, we are not responsible for anyone accessing or using your account, including reading or sending posts or commenting from it. If you think that someone else might be using your account, you must let us know immediately using the contact information below. You should also immediately change your social login password. We may terminate your account or block you from accessing the Services if you break the rules on keeping your account secure.
                    </p>

                    <p>
                      To provide you with ease of access to your account, we may implement technology that enables us to recognize your device and provides you with direct access to your account without requiring you to retype your password when you revisit the Services.
                      Non-registered users are able to access only the parts of the Services that are publicly available and do not enjoy all of the privileges of being a registered member. They are, however, subject to the TOU.
                    </p>
                  </div>
                  <hr>

                  <div class="terms-description-list">
                    <h3 id="conduct">3. Rules of Conduct</h3>
                    <p>
                      When you post anything on MaskCamp.com it can be seen or accessed by the general public (not just registered members) as further described in our
                      <b>Privacy Policy</b>. If you don’t want something to be seen by the general public, then you shouldn’t post it. Use your common sense when posting anything or making any comment on the Services. Take a step back and think (especially if you are feeling angry) before you send something and check whether it’s something that’s not allowed. Remember, you are solely responsible for everything you write or post on the Services, and you are subject to the following rules (the “Rules of Conduct”).
                      <b>When using the Services, you must not post or send anything which:</b>
                    </p>
                    <p>
                      <ul>
                       <li>Is mean, is bullying someone or is intended to harass, scare or upset anyone.</li> 
                       <li>Is deliberately designed to provoke or antagonize people, especially trolling.</li>
                       <li>Uses rude words or is intended to upset or embarrass anyone;</li>
                       <li>Encourages dangerous or illegal activities or self-harm.</li>
                       <li>Depicts horrible, shocking or distressing things.</li>
                       <li>Contains any threat of any kind, including threats of physical violence to yourself or others.</li>
                       <li>Is racist or discriminates based on someone’s race, religion, age, gender, disability or sexuality.</li>
                       <li>Infringes other individual’s privacy rights.</li>
                       <li>Is illegal, could expose MaskCamp.com to legal liability, or encourages people to get involved in anything which is illegal (for example, drugs, violence, or crime).</li>
                       <li>Is defamatory or violates any third party’s rights, including breach of confidence, copyright, trademark, patent, trade secret, moral right, privacy right, right of publicity, or any other intellectual property right.</li>
                       <li>Constitutes spam, attempts to sell anything to other users, or competes with the business of MaskCamp.com .</li>
                       <li>Constitutes spam, attempts to sell anything to other users, or competes with the business of MaskCamp.com</li>
                       <li>Collects user content or information, or otherwise accesses the Services using automated means (such as harvesting bots, robots, spiders, or scrapers) without our prior permission.</li>
                       <li>Violates any robot exclusion headers of the site, if any, or bypasses or circumvents other measures employed to prevent or limit access to the Services.</li>
                       <li>Shares, recompiles, decompiles, disassembles, reverse engineers, or makes or distributes any other form of, or any derivative work from, the Services</li>
                       <li>Attempts to scrape or collect any personal or private information from other users or from the Services.</li>
                       <li>Pretends to come from someone other than you, or where you are impersonating someone else.</li>
                       <li>Intercepts or monitors, damages, or modifies any communication not intended for you.</li>
                       <li>May cause any harm or damage to you or anyone else</li>
                       <li>Otherwise breaches the <b>TOU</b>; or</li>
                       <li>Attempts to do any of the foregoing.</li>
                      </ul>              
                    </p>

                    <p>
                      We reserve the right, at any time and without prior notice, to remove or disable access to any content that we, for any reason or no reason, consider to be objectionable, in violation of the TOU or otherwise harmful to the Services or our users. If anyone is bullying or harassing you (or anyone else) or doing any of the things that are not allowed under the TOU or our Rules of Conduct, you can report it or complain about it by contacting us via our Contact Us Page. In order to help us help you, please tell us exactly what the problem is, in as much detail as possible. You can also report any post directly from a profile, by clicking the “Report” button and choosing the reason for the complaint.
                    </p>
                    <p>
                      You acknowledge that we have no obligation to monitor your access to or use of the Services for violations of the TOU, or to review or edit any content. However, we have the right to do so for the purpose of operating and improving the Services (including without limitation for fraud prevention, risk assessment, investigation and customer support purposes), to ensure your compliance with the TOU and to comply with applicable law or the order or requirement of a court, consent decree, administrative agency or other governmental body. We can also block or respond to content that we determine is otherwise objectionable or as set forth in the TOU. In addition, you acknowledge that we have your consent to monitor and block content that we consider to be harassing or bullying.
                    </p>
                    <p>
                      We may access, preserve or disclose any of your information if we are required to do so by law, or if we believe in good faith that it is reasonably necessary to (i) respond to claims asserted against us or to comply with legal process (for example, subpoenas or warrants), including those issued by courts having jurisdiction over us or you, (ii) enforce or administer our agreements with users, such as the TOU; (iii) for fraud prevention, risk assessment, investigation, customer support, providing the Services or engineering support, or (iv) protect the rights, property or safety of MaskCamp.com, its users, or members of the public.
                    </p>
                  </div>
                  <hr>

                  <div class="terms-description-list">
                    <h3 id="modification">4. Modifications to the TOU</h3>
                    <p>
                      We may, at any time and for any reason make changes to the TOU. We may do this for a variety of reasons including to reflect changes in or requirements of the law, new features, or changes in business practices. The most recent version of the TOU will be posted on the Services and you should regularly check for the most recent version. The most recent version is the version that applies. If the changes include material changes that affect your rights or obligations, we will notify you of the changes by reasonable means, which could include notification through the Services or via email. If you continue to use the Services after the changes become effective, then you shall be deemed to have accepted those changes. If you don’t agree to these changes, you must end your relationship with us (without penalty) by ceasing to use the Services and leaving MaskCamp.com. Additionally, if we update or upgrade the Services, you may be required to accept the most recent version of the TOU to access the updated or upgraded Services.                 
                    </p>                
                  </div>
                  <hr>

                  <div class="terms-description-list">
                    <h3 id="license">5. Your License to Use the Services</h3>
                    <p>
                       <b>A)</b>  We grant you a personal, limited, non-exclusive and non-transferable license to access and use the Services only as expressly permitted in the TOU. You shall not use the Services for any illegal purpose or in any manner inconsistent with the provisions of the TOU. You may use information made available through the Services solely for your personal, non-commercial use. You may also download material displayed on the Services for personal, non-commercial use only, provided that you also retain all copyright and other proprietary notices contained on or in the materials. You may not, however, distribute, modify, transmit, reuse, re-post, or use the content or the Services for public or commercial purposes without our permission. Any violation by you of the license provisions contained in this Section 5 may result in the immediate termination of your right to use the Services, as well as potential liability for copyright infringement depending on the circumstances.                 
                    </p>
                    <p>
                      <b>B) Services Modifications/Updates: </b>We reserve the right to change or discontinue any aspect of the Services at any time. Upgrades or updates of the Services may be made available from time to time. We do this to improve the quality of the Services that we provide to you and other users. The software or the software application store that makes the software available for download may include functionality to automatically check for updates or upgrades to the software. Unless your device, its settings or computer software does not permit transmission or use of upgrades or updates, you agree that we, or the applicable software application store, may provide notice to you of the availability of such upgrades or updates and automatically push such upgrade or update to your device or computer from time-to-time. You may be required to install certain upgrades or updates to the software in order to continue to access or use the Services, or portions thereof (including upgrades or updates designed to correct issues with the Services). Any updates or upgrades provided to you by us under the TOU shall be considered part of the Services.                
                    </p>

                    <p>
                      <b>C) Content You Post: </b>If you submit material to the Services, unless we indicate otherwise, you grant us a nonexclusive, royalty-free, and fully sublicensable right to access, view, use, reproduce, modify, adapt, publish, translate, create derivative works from, distribute, copy, and display such material throughout the world in any form, media, or technology now known or hereafter developed. You also permit any other user to view, copy, access, store, or reproduce such material for that user’s personal use. You grant us the right to use the overall ratio of like and dislike of your posts that you gain in connection with such material. You represent and warrant that you own or otherwise control all of the rights to the material that you submit; that the material you submit is truthful and accurate; and that use of the material you supply does not violate this TOU or any applicable laws. You unconditionally waive in favour of us all moral rights in respect of material you submit to the Services under any laws in force from time to time in any part of the world. <b>If you leave MaskCamp.com, your account information and any material you have posted in response to questions will be deleted but your questions will remain on the Services in anonymous form. (For more information about the use of your data after you leave MaskCamp.com, go to Section 12 (Termination) of this TOU).</b>
                    </p>
                  </div>
                  <hr>

                  <div class="terms-description-list">
                    <h3 id="property">6. Intellectual Property Rights</h3>

                    <p>
                      <b>A)</b> The Services are proprietary and are protected by copyright laws, international treaty provisions, trademarks, service marks, and other intellectual property laws and treaties. The Services are also protected as a collective work or compilation under copyright and other laws and treaties. You agree to abide by all applicable copyright and other laws, as well as any additional copyright notices or restrictions contained in the Services. You acknowledge that the Services contain original works and have been developed, compiled, prepared, revised, selected, and arranged by MaskCamp.com and others through the application of methods and standards of judgment developed and applied through the expenditure of substantial time, effort, and money and constitutes valuable intellectual property of MaskCamp.com and such others. You agree to protect the proprietary rights of MaskCamp.com and all others having rights in the Services during and after the term of this agreement and to comply with all reasonable written requests made by MaskCamp.com or its suppliers and licensors of content or otherwise to protect their and others’ contractual, statutory, and common law rights in the Services. MaskCamp.com neither warrants nor represents that your use of materials displayed on the Services will not infringe rights of third parties not owned by or affiliated with MaskCamp.com. You agree to immediately notify us upon becoming aware of any claim that the Services infringe upon any copyright, trademark, or other contractual, statutory, or common law rights by following the instructions contained below in Section 6(c). All present and future rights in and to trade secrets, patents, designs, copyrights, trademarks, service marks, know-how, and other proprietary rights of any type under the laws of any governmental authority, domestic or foreign, including rights in and to all applications and registrations relating to the Services shall, as between you and MaskCamp.com, at all times be and remain the sole and exclusive property of MaskCamp.com.                
                    </p>

                    <p>
                      <b>B)</b> The trademarks, logos, taglines and service marks (collectively, the “Trademarks”) displayed on the Services are registered and unregistered Trademarks of MaskCamp.com and others. Nothing contained on the Services should be read as granting any Trademark without the written permission of MaskCamp.com or such third party that may own the Trademarks. Other than as provided in the TOU, in particular this Section 6, your use of the Trademarks, or any other MaskCamp.com content is strictly prohibited. You are also advised that MaskCamp.com will enforce its intellectual property rights to the fullest extent of the law.                
                    </p>

                    <p>
                      <b>C) Copyright Claims:</b>  MaskCamp.com is committed to protecting the intellectual property of others, and we ask the same of our users. Below, MaskCamp.com provides rights holders with information regarding how to report copyright and other intellectual property infringements by people posting content on MaskCamp.com. It is our policy to respond to clear notices of alleged copyright or other IP rights infringement, and in appropriate circumstances and at our discretion, to disable and/or terminate the accounts of users who may infringe or repeatedly infringe the copyrights or other intellectual property rights of MaskCamp.com and/or others.
                    </p>

                    <p>
                      <b>D) Notice for Claims of Intellectual Property Violations and Agent for Notice: </b>
                      This process is for copyright and intellectual property matters only and is designed to make submitting notices of alleged infringement to MaskCamp.com as straightforward as possible while also providing MaskCamp.com with the necessary information for notice verification
                    </p>

                    <p>
                      If you believe that your work has been copied in a way that constitutes copyright infringement, or that your intellectual property rights have been otherwise violated, please provide MaskCamp.com’s Copyright Agent with a written communication containing the following information in English (your “Notice”):
                    </p>

                    <p>
                      <i>Note: If you are asserting infringement of an intellectual property right other than copyright, you should specify the intellectual property right at issue.</i>
                    </p>

                    <p>
                      <ol>
                        <li>A physical or electronic signature of a person authorized to act on behalf of the owner of the copyright or other exclusive right that is allegedly infringed</li>
                        <li>A detailed description sufficient to identify the copyrighted work or other intellectual property that you claim has been infringed, or if multiple works have been infringed, a representative list of such works on the MaskCamp.com site.</li>
                        <li>A description of the material that you claim is infringing and that is to be removed or access to which is to be disabled and information reasonably sufficient to permit us to locate this material on the MaskCamp.com site (as part of this information, you must provide us with the specific URL where the material is located).</li>
                        <li>Information sufficient for MaskCamp.com to contact you, including your username (if applicable), address, telephone number, and/or email address.</li>
                        <li>A statement by you that you have a good faith belief that the disputed use of the material is not authorized by the copyright or intellectual property owner, its agents, or the law.</li>
                        <li>
                          A statement by you, made under penalty of perjury (if you are located in the US) or made truthfully (if you are located elsewhere) that the information in this notice is accurate and that you are the copyright or intellectual property owner for the material or that you are authorized to act on the copyright or intellectual property owner’s behalf<br>
                          In some circumstances, in order to notify the subscriber, account holder or host who provided the allegedly infringing content to which MaskCamp.com has disabled access (or intends to disable access), MaskCamp.com may forward a copy of your notification including your name and contact information to the subscriber or account holder. The individual may choose to file a counter-notification explaining why the content does not infringe an IP right following receipt of our notice. We may also, in our sole discretion, post a notice or a copy of your complaint on our site. By providing us with a complaint, you are consenting to your complaint being forwarded to the subscriber, account holder or host who provided the allegedly infringing content, and/or to our posting a notice or copy of your complaint on our site<br>
                          After submitting a copyright, or other IP right, infringement notification, you may realize that you misidentified content or you might otherwise change your mind. MaskCamp.com will honor retractions of copyright or other IP claims from the party who originally submitted them.<br>
                          After submitting a copyright, or other IP right, infringement notification, you may realize that you misidentified content or you might otherwise change your mind. MaskCamp.com will honor retractions of copyright or other IP claims from the party who originally submitted them.<br>
                          If you are unsure whether the content you are reporting is infringing your legal rights, you may wish to seek legal guidance. Keep in mind that submitting intentionally misleading reports of infringement may be punishable under the laws of your countries.<br>
                          For the purpose of the copyright act, MaskCamp.com’s Agent for notice of claims of copyright or other intellectual property infringement can be reached as follows: <br>
                          <b>By email: </b>
                          <i>copyrightclaim@MaskCamp.com</i>
                        </li>
                      </ol>
                    </p>

                  </div>
                  <hr>

                  <div class="terms-description-list">
                    <h3 id="warranty">7. Warranty Disclaimer</h3>
                    <p>
                      YOU ACKNOWLEDGE AND AGREE THAT THE SERVICES ARE PROVIDED “AS IS” AND “AS AVAILABLE” AND THAT YOUR USE OF THE SERVICES SHALL BE AT YOUR SOLE RISK. TO THE FULLEST EXTENT PERMITTED BY APPLICABLE LAW, MASKCAMP.COM, AND ITS RESPECTIVE OFFICERS, DIRECTORS, EMPLOYEES, AGENTS, AFFILIATES, SUBSIDIARIES, AND LICENSORS (“MASKCAMP.COM PARTIES”) DISCLAIM ALL WARRANTIES, EXPRESS OR IMPLIED, IN CONNECTION WITH THE SERVICES AND YOUR USE OF THEM. TO THE FULLEST EXTENT PERMITTED BY APPLICABLE LAW, THE MASKCAMP.COM PARTIES MAKE NO WARRANTIES OR REPRESENTATIONS THAT WE HAVE THE NECESSARY SKILL TO RENDER THE SERVICES OR THAT THE SERVICES HAVE BEEN AND WILL BE PROVIDED WITH DUE SKILL, CARE AND DILIGENCE OR ABOUT THE ACCURACY OR COMPLETENESS OF THE SERVICES’ CONTENT AND ASSUME NO RESPONSIBILITY FOR ANY (I) ERRORS, MISTAKES, OR INACCURACIES OF CONTENT, (II) PERSONAL INJURY OR PROPERTY DAMAGE, OF ANY NATURE WHATSOEVER, RESULTING FROM YOUR ACCESS TO AND USE OF OUR SERVICE, (III) ANY UNAUTHORIZED ACCESS TO OR USE OF OUR SERVERS AND/OR ANY AND ALL PERSONAL INFORMATION AND/OR FINANCIAL INFORMATION STORED THEREIN, (IV) ANY INTERRUPTION OR CESSATION OF TRANSMISSION TO OR FROM THE SERVICES, (V) ANY BUGS, VIRUSES, TROJAN HORSES, OR THE LIKE WHICH MAY BE TRANSMITTED TO OR THROUGH THE SERVICES THROUGH THE ACTIONS OF ANY THIRD PARTY, (VI) ANY LOSS OF YOUR DATA OR CONTENT FROM THE SERVICES AND/OR (VII) ANY ERRORS OR OMISSIONS IN ANY CONTENT OR FOR ANY LOSS OR DAMAGE OF ANY KIND INCURRED AS A RESULT OF THE USE OF ANY CONTENT POSTED, EMAILED, TRANSMITTED, OR OTHERWISE MADE AVAILABLE VIA THE SERVICES. THE MASKCAMP.COM PARTIES DO NOT WARRANT, ENDORSE, GUARANTEE, OR ASSUME RESPONSIBILITY FOR ANY PRODUCT OR SERVICE ADVERTISED OR OFFERED BY A THIRD PARTY THROUGH THE SERVICES, AND THE MASKCAMP.COM PARTIES WILL NOT BE A PARTY TO OR IN ANY WAY BE RESPONSIBLE FOR MONITORING ANY TRANSACTION BETWEEN YOU AND THIRD-PARTY PROVIDERS OF PRODUCTS OR SERVICES. AS WITH THE PURCHASE OF A PRODUCT OR SERVICE THROUGH ANY MEDIUM OR IN ANY ENVIRONMENT, YOU SHOULD USE YOUR BEST JUDGMENT AND EXERCISE CAUTION WHERE APPROPRIATE. YOU ARE SOLELY RESPONSIBLE FOR ALL OF YOUR COMMUNICATIONS AND INTERACTIONS WITH OTHER USERS OF THE SERVICES AND WITH OTHER PERSONS WITH WHOM YOU COMMUNICATE OR INTERACT AS A RESULT OF YOUR USE OF THE SERVICES.                
                    </p>             

                  </div>
                  <hr>

                  <div class="terms-description-list">
                    <h3 id="limitations">8. Limitations of Liability</h3>
                    <p>
                      TO THE FULLEST EXTENT PERMITTED BY APPLICABLE LAW, IN NO EVENT SHALL THE MASKCAMP.COM PARTIES BE LIABLE TO YOU FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, PUNITIVE, OR CONSEQUENTIAL DAMAGES WHATSOEVER RESULTING FROM ANY (I) ERRORS, MISTAKES, OR INACCURACIES OF CONTENT, (II) PERSONAL INJURY OR PROPERTY DAMAGE, OF ANY NATURE WHATSOEVER, RESULTING FROM YOUR ACCESS TO AND USE OF THE SERVICES, (III) ANY UNAUTHORIZED ACCESS TO OR USE OF OUR SERVERS AND/OR ANY AND ALL PERSONAL INFORMATION AND/OR FINANCIAL INFORMATION STORED THEREIN, (IV) ANY INTERRUPTION OR CESSATION OF TRANSMISSION TO OR FROM OUR SERVERS, (V) ANY BUGS, VIRUSES, TROJAN HORSES, OR THE LIKE, WHICH MAY BE TRANSMITTED TO OR THROUGH THE SERVICE BY ANY THIRD PARTY, (VI) ANY LOSS OF YOUR DATA OR CONTENT FROM THE SERVICES (VII) ANY ERRORS OR OMISSIONS IN ANY CONTENT OR FOR ANY LOSS OR DAMAGE OF ANY KIND INCURRED AS A RESULT OF YOUR USE OF ANY CONTENT POSTED, TRANSMITTED, OR OTHERWISE MADE AVAILABLE VIA THE SERVICES, WHETHER BASED ON WARRANTY, CONTRACT, TORT, OR ANY OTHER LEGAL THEORY, AND WHETHER OR NOT THE MASKCAMP.COM PARTIES ARE ADVISED OF THE POSSIBILITY OF SUCH DAMAGES, AND/OR (VIII) THE DISCLOSURE OF INFORMATION PURSUANT TO THESE TERMS OF USE OR PRIVACY POLICY.                 
                    </p>
                    <p>
                      Some countries and jurisdictions do not allow the limitation or exclusion of consequential, direct, indirect, or other damages in contracts with consumers and to the extent you are a consumer the limitations or exclusions in this section may not apply to you.               
                    </p>

                    <p>
                      YOU SPECIFICALLY ACKNOWLEDGE AND AGREE THAT THE MASKCAMP.COM PARTIES ARE NOT PUBLISHERS OF USER SUBMISSIONS OR LIABLE FOR THE DEFAMATORY, OFFENSIVE, OR ILLEGAL CONDUCT OF ANY THIRD PARTY. TO THE FULLEST EXTENT PERMITTED BY APPLICABLE LAW, THE MASKCAMP.COM PARTIES DISCLAIM ALL LIABILITY FOR USER SUBMISSIONS. YOU FURTHER ACKNOWLEDGE AND AGREE THAT CONTENT YOU PUBLISH AND / OR TRANSMIT ON OR THROUGH THE SERVICES TO OTHER USERS OR ENTITIES MAY BE COPIED, RE-USED, OR FURTHER DISCLOSED BY SUCH OTHER USERS OR ENTITIES OUTSIDE OF THE MASKCAMP.COM PARTIES’ CONTROL AND THAT THE MASKCAMP.COM PARTIES ARE NOT LIABLE TO YOU FOR ANY SUCH USE OF CONTENT BY OTHERS.
                    </p>

                  </div>
                  <hr>

                  <div class="terms-description-list">
                    <h3 id="indemnity">9. Indemnity</h3>
                    <p>
                      You agree to indemnify, defend, and hold the MaskCamp.com Parties harmless, from and against any third party claims, damages (actual and/or consequential), actions, proceedings, demands, losses, liabilities, costs and expenses (including reasonable legal fees) suffered or reasonably incurred by us arising as a result of, or in connection with, (i) your access to and use of MaskCamp.com; (ii) your breach of the TOU, including, but not limited to, any infringement by you of the copyright or intellectual property rights of any third party; or (iii) any products or services purchased or obtained by you in connection with the Services. MaskCamp.com retains the exclusive right to settle, compromise and pay, without your prior consent, any and all claims or causes of action which are brought against us. We reserve the right, at your expense, to assume the exclusive defense and control of any matter for which you are required to indemnify us and you agree to cooperate with our defense of these claims. You agree not to settle any matter in which we are named as a defendant and/or for which you have indemnity obligations without our prior written consent. We will use reasonable efforts to notify you of any such claim, action or proceeding upon becoming aware of it.                
                    </p>
              
                  </div>
                  <hr>

                  <div class="terms-description-list">
                    <h3 id="third">10. Third Party Sites and Services</h3>
                    <p>
                      Information provided by our users through the Services may contain links to third party websites that are not owned or controlled by us. We have no control over, and assume no responsibility for, the content, privacy policies, or practices of any third party websites. In addition, we will not and cannot censor or edit the content of any third-party site. By using the Services, you expressly acknowledge and agree that the MaskCamp.com Parties shall not be responsible for any damages, claims or other liability arising from or related to your use of any third-party website.
                      You may also encounter third-party applications (including, without limitation, social networking websites, plug-ins, widgets, software, or other software utilities) (“Third Party Applications”) that interact with or are part of the Services. These Third Party Applications may import data related to your account and use of the Services and otherwise gather data from you. These Third Party Applications are provided solely as a convenience to you, and unless noted otherwise by us, the MaskCamp.com Parties are not responsible for and do not endorse the content of such Third Party Applications. By using Third Party Applications, you acknowledge and agree to the following: (i) if you use a Third Party Application to share information relating to your account, you are consenting to the information about your account being shared; (ii) your interaction with a Third Party Application may cause personal information to be publicly disclosed and/or associated with you; (iii) we may send information about you to these Third Party Applications; and (iv) your USE OF A THIRD PARTY APPLICATION IS AT YOUR OWN RISK. You will hold the MaskCamp.com Parties harmless for the sharing of information relating to your account that results from your use of Third Party Applications. The Third Party Application’s terms, privacy policy, and/or any other documentation or materials will govern your use of that Third Party Application. TO THE EXTENT PERMITTED BY LAW, THE MASKCAMP.COM PARTIES DISCLAIM ALL LIABILITY ARISING FROM YOUR USE OF THIRD PARTY APPLICATIONS.    
                    </p>
                
                  </div>
                  <hr>

                  <div class="terms-description-list">
                    <h3 id="termination">11. Termination</h3>
                    <p>
                      <b>(A) Deactivation or Termination by you:</b> If you are a registered MaskCamp.com member, you can deactivate your membership at any time by going to the Settings control when you are logged in and choosing the “deactivate profile” link. By deactivating your account, it will no longer be visible to other users of MaskCamp.com but we will save your profile information in case you change your mind later and want to re-activate your account. Many members deactivate their accounts for temporary reasons and in doing so expect us to maintain their information until they return to MaskCamp.com. You should therefore be able to restore your account and the whole of your profile within 12 months of deactivating it but we cannot guarantee that this will always be the case. Should you choose to leave MaskCamp.com, rather than deactivate your account, you may do so by selecting the “I want to leave MaskCamp.com” tab on the Contact Us page. Once received, we will process your request to leave as soon as practicable. Once processed, your profile data will be removed from the Services and your questions to friends will be converted to anonymous questions (in other words, questions you have asked will remain visible but will appear to be from an anonymous user). You will be able to reactivate your account by logging back in for a period of 30 days after your request to leave MaskCamp.com is processed. At the end of that period your account will be deleted and all “likes” which you have added to questions will be removed. We will delete your data as soon as reasonably practicable, but in certain cases limited types of data, including log files and backups, may take up to 90 days to be fully deleted.  
                      <b>Warning:  After you have deactivated your account or left MaskCamp.com, posts  may still appear on the Services.  Please note also that even after you remove information from your profile or deactivate your account, copies of such content may still be visible and/or accessed on the Internet to the extent such information has been previously shared with others, or to the extent such information has been shared with, indexed by or cached by search engines.  Similarly, if you have given third party applications or websites (e.g., social networks) access to your personal information they may keep that information.  We cannot control this, nor do we accept any responsibility or liability for this.</b>              
                    </p>

                    <p>
                      <b>(B) Suspension or Termination by Us:</b> We may suspend or terminate a user’s access to the Services or a member’s account for any reason, including if we believe a user has violated the TOU. We also reserve the right to at any time block users from accessing and using the Services, by using IP blockers or other technological solutions we deem appropriate. If we have serious grounds to terminate the TOU (including your breach of the Rules of Conduct) we reserve the right to terminate your access to the Services without notice. Otherwise, we will provide you with reasonable notice if your access to MaskCamp.com and/or your profile is going to be suspended or terminated.
                    </p>
                  
                    <p>
                      <b>(C) Effect of Termination:</b> Upon termination or expiration of your rights to use the Services or any portion thereof, you authorize us to delete any files, programs, data and messages associated with your account for the Services, or applicable portion thereof, without notice to you.
                    </p>
                  
                  </div>
                  <hr>

                  <div class="terms-description-list">
                    <h3 id="general">12. General</h3>
                    <p>
                      <b>A) Governing Law and Jurisdiction:</b>You agree that: <b>(i)</b> the Services shall be provided from Bangladesh; <b>(ii)</b> the laws of Bangladesh apply to the TOU, including any contractual or non-contractual matter or dispute arising out of or in connection with the TOU, your access to and use of the Services, and the relationship between us and you; and <b>(iii)</b> the courts of Bangladesh have exclusive jurisdiction in connection with the TOU and all such matters and disputes arising out of or connected to the Services. Notwithstanding the foregoing, you agree that we may seek interim, preliminary or protective relief before the competent courts of any jurisdiction.               
                    </p>

                    <p>
                      <b>B) Data Charges:<b>/By using MaskCamp.com on your mobile phone (and/or any other device) you may be subject to charges by your Internet or mobile service provider, so check with them first if you are not sure, as you will be responsible for any such costs.              
                    </p>

                    <p>
                      <b>C) Entire Agreement and Waiver:</b>The TOU, together with the <b>Privacy Policy</b> and <b>Cookie Policy</b>, shall constitute the entire agreement between you and us concerning the Services. If, for any reason, any provision of the TOU is declared to be illegal, invalid, void or otherwise unenforceable by a competent court of any jurisdiction, then to the extent that term is illegal, invalid, void or unenforceable, it shall be severed and deleted from the TOU and the remainder of the TOU shall survive, remain in full force and effect and continue to be binding and enforceable. No failure or delay by us in exercising any right, power or privilege under the TOU shall operate as a waiver of such right or acceptance of any variation of the TOU and nor shall any single or partial exercise by either party of any right, power or privilege preclude any further exercise of that right or the exercise of any other right, power or privilege.
                    </p>

                    <p>
                      <b>D) No Third Party Rights:</b>Nothing in the TOU shall confer or purport to confer any rights on any other third party.
                    </p>

                    <p>
                      <b>E)</b> The TOU, and any rights and licenses granted hereunder, may not be transferred or assigned by you, but may be assigned by us where such assignment does not serve to reduce the guarantees provided to you under the TOU.
                    </p>

                    <p>
                      <b>F) Linking and Framing:</b>You may not frame the Services.  You may link to the Services, provided that you acknowledge and agree that you will not link the Services to any website containing any inappropriate, profane, defamatory, infringing, obscene, indecent, or unlawful topic, name, material, or information or that violates any intellectual property, proprietary, privacy, or publicity rights. Any violation of this provision may, in our sole discretion, result in termination of your use of and access to the Services effective immediately
                    </p>

                  </div>
                  <hr>

                  <div class="terms-description-list">
                    <h3 id="questions">13. Questions</h3>
                    <p>
                      If you have any questions about the TOU, you can contact us by clicking here.                 
                    </p>
                  </div>
                  <hr>
          
            </div>
        </div>
        
      </div>
    </div>

    
 
@stop

@section('script')
  <!-- Javascripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/cm-xs-sidebars.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script type="text/javascript">
        $(function() {
          $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
              var target = $(this.hash);
              target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
              if (target.length) {
                $('html,body').animate({
                  scrollTop: target.offset().top
                }, 1000);
                return false;
              }
            }
          });
        });
    </script>
@stop
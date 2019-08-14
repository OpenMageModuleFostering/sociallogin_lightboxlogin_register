
/**
* Rootinfo
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@magentocommerce.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* However,* Rootinfo *guarantee functional accuracy of
* specific extension behavior. Additionally we take no responsibility
* for any possible issue(s) resulting from extension usage.
* We reserve the full right not to provide any kind of support for our free extensions.
* Thank you for your understanding.
* @category   Rootinfo
* @package    Rootinfo_SocialConnect
* @author     Shekhar <shekhar@rootinfosol.com>
* @copyright  Copyright (c) 2014-2015 (http://rootinfosol.com/)
* @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
*/


(function($) {
    $.fn.rootinfoAjaxLogin = function(options) {

        var rootlights = $.extend({}, $.fn.rootinfoAjaxLogin.defaults, options);

        return installation();

        /**
         * Initization.
         */
        function installation() {
            // Add Lightboxs from Ajaxlogin view.
            replaceAjaxPopups();
            // Disable links login or register pages
            removeJsPlace();
            // Open and close Lightboxs
            openCloseLightbox();
            // Ajax calls Lightboxs
            sendLightbox();
            
        }

        /**
         * Add windows from Ajaxlogin view  include the Loader.
         */
        function replaceAjaxPopups() {
            var loginWindow = $('.rootinfo-login-window');
            var registerWindow = $('.rootinfo-register-window');
            var loader = $('.rootinfo-ajaxlogin-loader');
            $('#header-account').html(loginWindow);
            $('#header-account').append(registerWindow);
            $('#header-account').append(loader);
            
        }

        /**
         *  login or register pages.
         */
        function removeJsPlace() {
            $('a[href*="customer/account/create"], ' +
                'a[href*="customer/account/login"], ' +
                '.customer-account-login .new-users button')
                .attr('onclick', 'return false;');
        }

        /**
         * Open, close and switch Login and Register Lightboxs.
         */
        function openCloseLightbox() {
            // Login open - auto
            if (rootlights.autoShowUp == 'yes'
                && $('.messages').css('display') != 'block') {
                $('.skip-links .skip-account').trigger('click');
                $('#dullDiv').show();
                $('.skip-content').addClass('skip-active'); 
                
                animateShowWindow('login');
            }
            // Login open and close - click
            $('.skip-links .skip-account').on('click', function() {
                // Close
                if ($('.rootinfo-login-window').css('display') != 'none'
                    || $('.rootinfo-register-window').css('display') != 'none') {
                  
                    animateCloseWindow('login', false, false);
                    $('.skip-content').addClass('skip-active'); 
                    
                     
                    $('#dullDiv').show();
                // Open
                } else {
                    $('#dullDiv').show();
                    $('.skip-content').addClass('skip-active'); 
                     
                    animateShowWindow('login');
                }
                return false;
            });
            // Open login on customer/account/forgotpassword
            $('a[href*="customer/account/login"]').click(function() {
                $('.skip-links .skip-account').trigger('click');
            });
            // Switching between Login and Register windows
            $('.rootinfoajax-switch-window').on('click', function() {
                
            
              $('.skip-content').addClass('skip-active');      
               
                // Close Register window and open Login window
                if ($(this).attr('id') == 'y-to-login') {
                    animateTop();
                    animateCloseWindow('register', false, false);
                    $('#dullDiv').show();
                                                        
                    
                    animateShowWindow('login');

                // Open Login window and close Register window
                } else {
                    animateTop();
                    animateCloseWindow('login', false, false);
                     $('#dullDiv').show();
                     $('.skip-content').addClass('skip-active');
                     
                    animateShowWindow('register');
                }
            });
            // Open register window
            $('a[href*="customer/account/create"], .new-users button')
                .on('click', function() {
                $('.skip-links .skip-account').trigger('click');
                animateCloseWindow('login', false, false);
                $('#dullDiv').show();
                $('.skip-content').addClass('skip-active'); 
                 
                animateShowWindow('register');
                return false;
            });
            // Close login window by Customers.
            $('.rootinfo-login-window .close').click(function() {
                $('#dullDiv').hide();
                 
                animateCloseWindow('login', true, true);
                 
            });
            // Close register window by Customers
            $('.rootinfo-register-window .close').click(function() {
                $('#dullDiv').hide();
                animateCloseWindow('register', true, true);
                 
            });
            
            autoClose();
        }

       
        function animateTop() {
            $('html,body').animate({scrollTop : 0});
        }

        /**
         * Registration or login request by Customers.
         */
        function sendLightbox() {
            // Click to register in Register Lightbox.
            $('.rootinfo-register-window button').on('click', function() {
                setDatas('register');
                validateDatas('register');
                if (rootlights.errors != ''){
                    setError(rootlights.errors, 'register');
                } else {
                    callAjaxControllerRegistration();
                }
                return false;
            });

            // login Lightbox.
            $(document).keypress(function(e) {
                if(e.which == 13
                    && $('.rootinfo-login-window').css('display') == 'block') {
                    setDatas('login');
                    validateDatas('login');
                    if (rootlights.errors != '') {
                        setError(rootlights.errors, 'login');
                    }
                    else{
                        callAjaxControllerLogin();
                    }
                }
            });

            // Click on login in Login Lightbox
            $('.rootinfo-login-window button').on('click', function() {
                setDatas('login');
                validateDatas('login');
                if (rootlights.errors != '') {
                    setError(rootlights.errors, 'login');
                } else {
                    callAjaxControllerLogin();
                }
                return false;
            });
        }

        /**
         * Display Lightbox.
         * @param string Lightbox
         */
        function animateShowWindow(windowName) {
            $('.rootinfo-' + windowName + '-window')
                .slideDown(1000, 'easeInOutCirc');
        }

        /**
         * Show or hide the Loader with effects.
         * @param string Lightboxname
         * @param int 
         */
        function animateLoader(windowName, step) {
            // Start
            if (step == 'installation') {
                $('.rootinfo-ajaxlogin-loader').fadeIn();
                $('.rootinfo-' + windowName + '-window')
                    .animate({opacity : '0.4'});
            // Stop
            } else {
                $('.rootinfo-ajaxlogin-loader').fadeOut('normal', function() {
                    $('.rootinfo-' + windowName + '-window')
                        .animate({opacity : '1'});
                });
            }
        }

        /**
         * Close Lightbox.
         * @param string LightboxName
         * @param bool quickly Close without Lightbox.
         * @param bool closeParent Close the parent.
         */
        function animateCloseWindow(windowName, quickly, closeParent) {
            if (rootlights.stop != true){
                if (quickly == true) {
                    $('.rootinfo-' + windowName + '-window').hide();
                    $('.rootinfo-ajaxlogin-error').hide(function() {
                        if (closeParent) {
                            $('#header-account').removeClass('skip-active');
                        }
                    });
                } else {
                    $('.rootinfo-ajaxlogin-error').fadeOut();
                    $('.rootinfo-' + windowName + '-window').slideUp(function() {
                        if (closeParent) {
                            $('#header-account').removeClass('skip-active');
                        }
                    });
                }
            }
        }

        /**
         * Validate user inputs.
         * @param string LightboxName
         */
        function validateDatas(windowName) {
            rootlights.errors = '';

            // Register
            if (windowName == 'register') {
                // There is no last name
                if (rootlights.lastname.length < 1) {
                    rootlights.errors = rootlights.errors + 'nolastname,'
                }

                // There is no first name
                if (rootlights.firstname.length < 1) {
                    rootlights.errors = rootlights.errors + 'nofirstname,'
                }

                // There is no email address
                if (rootlights.email.length < 1) {
                    rootlights.errors = rootlights.errors + 'noemail,'
                // It is not email address
                } else if (validateEmail(rootlights.email) != true) {
                    rootlights.errors = rootlights.errors + 'wrongemail,'
                }

                // There is no password
                if (rootlights.password.length < 1) {
                    rootlights.errors = rootlights.errors + 'nopassword,'
                // Too short password
                } else if (rootlights.password.length < 6) {
                    rootlights.errors = rootlights.errors + 'shortpassword,'
                // Too long password
                } else if (rootlights.password.length > 16) {
                    rootlights.errors = rootlights.errors + 'longpassword,'
                // Passwords doe not match
                } else if (rootlights.password != rootlights.passwordsecond) {
                    rootlights.errors = rootlights.errors + 'notsamepasswords,'
                }

                // Terms and condition has not been accepted
                if (rootlights.licence != 'ok') {
                    rootlights.errors = rootlights.errors + 'nolicence,'
                }
            // Login
            } else if (windowName == 'login') {
                // There is no email address
                if (rootlights.email.length < 1) {
                    rootlights.errors = rootlights.errors + 'noemail,'
                // It is not email address
                } else if (validateEmail(rootlights.email) != true) {
                    rootlights.errors = rootlights.errors + 'wrongemail,'
                }

                // There is no password
                if (rootlights.password.length < 1) {
                    rootlights.errors = rootlights.errors + 'nopassword,'
                // Too long password
                } else if (rootlights.password.length > 16) {
                    rootlights.errors = rootlights.errors + 'wronglogin,'
                }
            }
        }

        /**
         * Email validator.
         * @param string emailAddress
         * @returns {boolean}
         */
        function validateEmail(emailAddress) {
            var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

            if (filter.test(emailAddress)) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * Save customer input data to property for ajax call.
         * @param string LightboxName
         */
        function setDatas(windowName) {
            // Register Lightbox
            if (windowName == 'register') {
                
                rootlights.recaptchachallenge = $("input#recaptcha_challenge_field").val();
                rootlights.recaptchafield = $("input#recaptcha_response_field").val();
                
                
                rootlights.firstname = $('.rootinfo-' + windowName
                    + '-window #rootinfo-firstname').val();
                rootlights.lastname = $('.rootinfo-' + windowName
                    + '-window #rootinfo-lastname').val();

                if ($('.rootinfo-' + windowName
                    + '-window input[name="rootinfo-newsletter"]:checked')
                    .length > 0) {
                    rootlights.newsletter = 'ok';
                } else {
                    rootlights.newsletter = 'no';
                }

                rootlights.email = $('.rootinfo-' + windowName
                    + '-window #rootinfo-email').val();
                rootlights.password = $('.rootinfo-' + windowName
                    + '-window #rootinfo-password').val();
                rootlights.passwordsecond = $('.rootinfo-' + windowName
                    + '-window #rootinfo-passwordsecond').val();

                if ($('.rootinfo-' + windowName
                    + '-window input[name="rootinfo-licence"]:checked')
                    .length > 0) {
                    rootlights.licence = 'ok';
                } else {
                    rootlights.licence = 'no';
                }
            // Login Lightbox
            } else if (windowName == 'login') {
                rootlights.email = $('.rootinfo-' + windowName
                    + '-window #rootinfo-email').val();
                rootlights.password = $('.rootinfo-' + windowName
                    + '-window #rootinfo-password').val();
            }
        }

        /**
         * Load error messages into Lightbox and show them.
         * @param string errors Comma separated.
         * @param string LightboxName
         */
        function setError(errors, windowName) {
            $('.rootinfo-' + windowName + '-window .rootinfo-ajaxlogin-error')
                .text('');
            $('.rootinfo-' + windowName + '-window .rootinfo-ajaxlogin-error')
                .hide();

            var errorArr = new Array();
            errorArr = errors.split(',');

            var length = errorArr.length - 1;

            for (var i = 0; i < length; i++) {
                var errorText = $('.rootvalid-' + errorArr[i]).text();

                $('.rootinfo-' + windowName + '-window .err-' + errorArr[i])
                    .text(errorText);
            }

            $('.rootinfo-' + windowName + '-window .rootinfo-ajaxlogin-error')
                .fadeIn();
        }

        /**
         * Ajax call for registration Lightbox.
         */
        function callAjaxControllerRegistration() {
            

            if (rootlights.stop != true) {

                rootlights.stop = true;

                // Load the Loader for Lightbox.
                animateLoader('register', 'installation');

                // Send data
                var ajaxRegistration = jQuery.ajax({
                    url: rootlights.controllerUrl,
                    type: 'POST',
                    data: {
                    ajax : 'register',
                        firstname : rootlights.firstname,
                        lastname : rootlights.lastname,
                        newsletter : rootlights.newsletter,
                        email : rootlights.email,
                        password : rootlights.password,
                        passwordsecond : rootlights.passwordsecond,
                        licence : rootlights.licence,
                        recaptcha_response_field : rootlights.recaptchafield,
                        recaptcha_challenge_field : rootlights.recaptchachallenge
                    },
                    dataType: "html"
                });
                // Get All data
                ajaxRegistration.done(function(msg) {
                  
                    if (msg != 'success') {
                         $("#mageerr-recaptcha").html(msg);
                        setError(msg, 'register');
                    // If everything are OK
                    } else {
                        rootlights.stop = false;
                        animateCloseWindow('register', false, true);
                        // Redirect
                        if (rootlights.redirection == '1') {
                            window.location = rootlights.profileUrl;
                        } else {
                            window.location.reload();
                        }
                    }
                    animateLoader('register', 'stop');
                    rootlights.stop = false;
                });
                // Error on ajax call Lightbox.
                ajaxRegistration.fail(function(jqXHR, textStatus, errorThrown) {
                    rootlights.stop = false;
                    animateLoader('register', 'stop');
                });
            }
        }

        /**
         * Ajax call for login Lightbox.
         */
        function callAjaxControllerLogin() {
            // If there is no another ajax calling
            if (rootlights.stop != true){

                rootlights.stop = true;

                // Load the Loader Lightbox.
                animateLoader('login', 'installation');

                // Send data
                var ajaxRegistration = jQuery.ajax({
                    url: rootlights.controllerUrl,
                    type: 'POST',
                    data: {
                    ajax : 'login',
                        email : rootlights.email,
                        password : rootlights.password
                    },
                    dataType: "html"
                });
                // Get datas
                ajaxRegistration.done(function(msg) {
                    // If there is error
                    if (msg != 'success'){
                        setError(msg, 'login');
                    // If everything are OK
                    } else {
                        rootlights.stop = false;
                        animateCloseWindow('login', false, true);
                        // Redirect
                        if (rootlights.redirection == '1') {
                            window.location = rootlights.profileUrl;
                        } else {
                            window.location.reload();
                        }
                    }
                    animateLoader('login', 'stop');
                    rootlights.stop = false;
                });
                // Error on ajax call
                ajaxRegistration.fail(function(jqXHR, textStatus, errorThrown) {
                    rootlights.stop = false;
                    animateLoader('login', 'stop');
                });
            }
        }

        /**
         * Close Lightbox .
         */
        function autoClose() {
            closeInClose();

            // On resize event
            $(window).resize(function() {
                closeInClose();
            });

          
            $('.skip-links a').click(function() {
                closeInClose();
            });
        }

        /**
         * Close Lightbox .
         */
        function closeInClose() {
            if ($('.page-header-container #header-account')
                .hasClass('skip-active') != true) {
                animateCloseWindow('login', true, false);
                animateCloseWindow('register', true, false);
            }
        }
    };

    
    $.fn.rootinfoAjaxLogin.defaults = {
        redirection : '0',
        windowSize : '',
        stop : false,
        controllerUrl : '',
        profileUrl : '',
        autoShowUp : '',
        errors : '',
        firstname : '',
        lastname : '',
        newsletter : 'no',
        email : '',
        password : '',
        passwordsecond : '',
        licence : 'no'
    };

})(jQuery);

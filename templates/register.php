<?php
/**
 * Register Template
 * 
 * User registration form with email verification
 */

if (!defined('ABSPATH')) exit;
?>

<div class="zonatech-container">
    <!-- Loading Screen -->
    <div id="zonatech-loading-screen" class="loading-screen">
        <div class="loading-content">
            <div class="loading-spinner">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h2>ZonaTech NG</h2>
            <p>Loading...</p>
        </div>
    </div>

    <div class="zonatech-wrapper">
        <!-- Back to Home -->
        <div class="back-to-home">
            <a href="<?php echo esc_url(site_url()); ?>" class="btn btn-ghost btn-sm">
                <i class="fas fa-arrow-left"></i> Back to Home
            </a>
        </div>
        
        <!-- Registration Form -->
        <div class="auth-card glass-effect" id="register-card">
            <div class="auth-header">
                <a href="<?php echo esc_url(site_url()); ?>" class="zonatech-logo mb-2">
                    <img src="<?php echo esc_url(ZONATECH_PLUGIN_URL . 'assets/images/logo.png'); ?>" alt="ZonaTech NG" class="zonatech-logo-img">
                    <span>ZonaTech NG</span>
                </a>
                <h2 class="text-white"><i class="fas fa-user-plus"></i> Create Account</h2>
                <p class="text-muted">Join thousands of students preparing for success</p>
            </div>
            
            <form id="zonatech-register-form" novalidate>
                <div class="row">
                    <div class="col col-sm-12" style="flex: 1; min-width: 140px;">
                        <div class="form-group">
                            <label for="first_name" class="text-white"><i class="fas fa-user"></i> First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First name" required autocomplete="given-name">
                        </div>
                    </div>
                    <div class="col col-sm-12" style="flex: 1; min-width: 140px;">
                        <div class="form-group">
                            <label for="last_name" class="text-white"><i class="fas fa-user"></i> Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last name" required autocomplete="family-name">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email" class="text-white"><i class="fas fa-envelope"></i> Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required autocomplete="email">
                </div>
                
                <div class="form-group">
                    <label for="phone" class="text-white"><i class="fas fa-phone"></i> Phone Number <span class="text-muted">(Optional)</span></label>
                    <input type="tel" name="phone" id="phone" class="form-control" placeholder="e.g., 08012345678" autocomplete="tel">
                </div>
                
                <div class="form-group">
                    <label for="reg_password" class="text-white"><i class="fas fa-lock"></i> Password</label>
                    <div style="position: relative;">
                        <input type="password" name="password" id="reg_password" class="form-control" placeholder="Create a password (min. 6 characters)" required minlength="6" autocomplete="new-password" style="padding-right: 45px;">
                        <button type="button" class="password-toggle-btn" data-target="reg_password" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #8b5cf6; padding: 5px; z-index: 2; font-size: 1.1rem;">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="reg_confirm_password" class="text-white"><i class="fas fa-lock"></i> Confirm Password</label>
                    <div style="position: relative;">
                        <input type="password" name="confirm_password" id="reg_confirm_password" class="form-control" placeholder="Confirm your password" required autocomplete="new-password" style="padding-right: 45px;">
                        <button type="button" class="password-toggle-btn" data-target="reg_confirm_password" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #8b5cf6; padding: 5px; z-index: 2; font-size: 1.1rem;">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <div class="form-group">
                    <label style="display: flex; align-items: flex-start; gap: 0.5rem; cursor: pointer; margin: 0;">
                        <input type="checkbox" name="terms" id="terms" required style="width: auto; margin-top: 0.25rem; accent-color: #8b5cf6;">
                        <span style="font-size: 0.8rem; line-height: 1.5;" class="text-white">
                            I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                        </span>
                    </label>
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;" id="register-submit-btn">
                    <i class="fas fa-user-plus"></i> <span>Create Account</span>
                </button>
            </form>
            
            <div class="auth-divider">
                <span>or</span>
            </div>
            
            <p class="text-center text-muted" style="font-size: 0.85rem;">
                Already have an account? 
                <a href="<?php echo esc_url(site_url('/zonatech-login/')); ?>"><i class="fas fa-sign-in-alt"></i> Sign in</a>
            </p>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    'use strict';
    
    // Hide loading screen
    requestAnimationFrame(function() {
        $('#zonatech-loading-screen').addClass('fade-out');
        setTimeout(function() {
            $('#zonatech-loading-screen').hide();
        }, 100);
    });
    
    // Password visibility toggle for all password fields
    $('.password-toggle-btn').on('click', function(e) {
        e.preventDefault();
        var $btn = $(this);
        var targetId = $btn.data('target');
        var $passwordField = $('#' + targetId);
        var $icon = $btn.find('i');
        
        if ($passwordField.attr('type') === 'password') {
            $passwordField.attr('type', 'text');
            $icon.removeClass('fa-eye').addClass('fa-eye-slash');
            $btn.css('color', '#a78bfa');
        } else {
            $passwordField.attr('type', 'password');
            $icon.removeClass('fa-eye-slash').addClass('fa-eye');
            $btn.css('color', '#8b5cf6');
        }
    });
    
    // Client-side validation helper
    function validateForm($form) {
        var firstName = $.trim($form.find('[name="first_name"]').val());
        var lastName = $.trim($form.find('[name="last_name"]').val());
        var email = $.trim($form.find('[name="email"]').val());
        var password = $form.find('[name="password"]').val();
        var confirmPassword = $form.find('[name="confirm_password"]').val();
        var termsAccepted = $form.find('[name="terms"]').is(':checked');
        
        if (!firstName) {
            return { valid: false, message: 'Please enter your first name.' };
        }
        if (!lastName) {
            return { valid: false, message: 'Please enter your last name.' };
        }
        if (!email) {
            return { valid: false, message: 'Please enter your email address.' };
        }
        // Basic email validation
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            return { valid: false, message: 'Please enter a valid email address.' };
        }
        if (!password) {
            return { valid: false, message: 'Please enter a password.' };
        }
        if (password.length < 6) {
            return { valid: false, message: 'Password must be at least 6 characters.' };
        }
        if (password !== confirmPassword) {
            return { valid: false, message: 'Passwords do not match.' };
        }
        if (!termsAccepted) {
            return { valid: false, message: 'Please accept the Terms of Service and Privacy Policy.' };
        }
        
        return { valid: true };
    }
    
    // Show notification helper
    function showNotification(message, type) {
        if (typeof ZonaTechNotify !== 'undefined') {
            if (type === 'success') {
                ZonaTechNotify.success(message);
            } else if (type === 'error') {
                ZonaTechNotify.error(message);
            } else {
                ZonaTechNotify.show(message, type);
            }
        } else {
            alert(message);
        }
    }
    
    // Handle registration form submission
    $('#zonatech-register-form').on('submit', function(e) {
        e.preventDefault();
        
        var $form = $(this);
        var $btn = $('#register-submit-btn');
        var originalText = $btn.html();
        
        // Client-side validation
        var validation = validateForm($form);
        if (!validation.valid) {
            showNotification(validation.message, 'error');
            return;
        }
        
        // Get form values
        var formData = {
            action: 'zonatech_register',
            nonce: zonatech_ajax.nonce,
            first_name: $.trim($form.find('[name="first_name"]').val()),
            last_name: $.trim($form.find('[name="last_name"]').val()),
            email: $.trim($form.find('[name="email"]').val()),
            phone: $.trim($form.find('[name="phone"]').val()),
            password: $form.find('[name="password"]').val(),
            confirm_password: $form.find('[name="confirm_password"]').val()
        };
        
        // Disable button and show loading state
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Creating Account...');
        
        $.ajax({
            url: zonatech_ajax.ajax_url,
            type: 'POST',
            data: formData,
            dataType: 'json',
            timeout: 30000,
            success: function(response) {
                if (response && response.success) {
                    showNotification(response.data.message || 'Account created successfully!', 'success');
                    
                    // Redirect to login page
                    var redirectUrl = response.data.redirect || '<?php echo esc_url(site_url('/zonatech-login/')); ?>';
                    
                    setTimeout(function() {
                        window.location.href = redirectUrl;
                    }, 1500);
                } else {
                    var errorMessage = 'Registration failed. Please try again.';
                    if (response && response.data && response.data.message) {
                        errorMessage = response.data.message;
                    }
                    showNotification(errorMessage, 'error');
                    $btn.prop('disabled', false).html(originalText);
                }
            },
            error: function(xhr, status, error) {
                console.error('Registration error:', status, error);
                var errorMessage = 'An error occurred. Please check your connection and try again.';
                
                if (status === 'timeout') {
                    errorMessage = 'Request timed out. Please try again.';
                } else if (xhr.status === 0) {
                    errorMessage = 'Unable to connect to server. Please check your internet connection.';
                } else if (xhr.status === 403) {
                    errorMessage = 'Session expired. Please refresh the page and try again.';
                } else if (xhr.status === 500) {
                    errorMessage = 'Server error. Please try again later.';
                }
                
                // Try to parse response for more specific error
                if (xhr.responseText) {
                    try {
                        var resp = JSON.parse(xhr.responseText);
                        if (resp.data && resp.data.message) {
                            errorMessage = resp.data.message;
                        }
                    } catch(parseError) {
                        console.warn('Could not parse error response:', parseError.message);
                    }
                }
                
                showNotification(errorMessage, 'error');
                $btn.prop('disabled', false).html(originalText);
            }
        });
    });
});
</script>
<?php
/**
 * Shortcodes Handler Class
 * Rebuilt from scratch to fix navigation issues
 */

if (!defined('ABSPATH')) {
    exit;
}

class ZonaTech_Shortcodes {
    
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        // Register all shortcodes
        add_shortcode('zonatech_login', array($this, 'render_login'));
        add_shortcode('zonatech_register', array($this, 'render_register'));
        add_shortcode('zonatech_verify_email', array($this, 'render_verify_email'));
        add_shortcode('zonatech_dashboard', array($this, 'render_dashboard'));
        add_shortcode('zonatech_past_questions', array($this, 'render_past_questions'));
        add_shortcode('zonatech_nin_service', array($this, 'render_nin_service'));
        add_shortcode('zonatech_scratch_cards', array($this, 'render_scratch_cards'));
        add_shortcode('zonatech_payment', array($this, 'render_payment'));
        add_shortcode('zonatech_homepage', array($this, 'render_homepage'));
        add_shortcode('zonatech_feedback', array($this, 'render_feedback'));
        add_shortcode('zonatech_admin_dashboard', array($this, 'render_admin_dashboard'));
    }
    
    /**
     * Check if user is logged in
     * Returns true if logged in, false if redirect needed
     * Does NOT redirect - caller handles the redirect display
     */
    private function check_login() {
        return is_user_logged_in();
    }
    
    /**
     * Render login required message for shortcodes
     * This is displayed inline instead of redirecting (which can cause issues)
     */
    private function render_login_required($redirect_page = '') {
        $login_url = site_url('/zonatech-login/');
        if (!empty($redirect_page)) {
            $login_url .= '?redirect=' . urlencode($redirect_page);
        }
        
        ob_start();
        ?>
        <div class="zonatech-container">
            <div class="glass-card text-center" style="padding: 3rem; max-width: 500px; margin: 2rem auto;">
                <i class="fas fa-user-lock" style="font-size: 4rem; color: #8b5cf6; margin-bottom: 1.5rem;"></i>
                <h2 class="text-white" style="margin-bottom: 1rem;">Login Required</h2>
                <p class="text-muted" style="margin-bottom: 1.5rem;">Please login to access this page.</p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="<?php echo esc_url($login_url); ?>" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                    <a href="<?php echo esc_url(site_url('/zonatech-register/')); ?>" class="btn btn-secondary">
                        <i class="fas fa-user-plus"></i> Create Account
                    </a>
                </div>
            </div>
        </div>
        <script>
        // Auto-redirect to login page after 2 seconds
        setTimeout(function() {
            window.location.href = '<?php echo esc_js($login_url); ?>';
        }, 2000);
        </script>
        <?php
        return ob_get_clean();
    }
    
    public function render_login() {
        // If already logged in, show redirect message instead of using wp_redirect
        // This prevents "headers already sent" issues
        if (is_user_logged_in()) {
            ob_start();
            ?>
            <div class="zonatech-container">
                <div class="glass-card text-center" style="padding: 3rem; max-width: 500px; margin: 2rem auto;">
                    <i class="fas fa-check-circle" style="font-size: 4rem; color: #22c55e; margin-bottom: 1.5rem;"></i>
                    <h2 class="text-white" style="margin-bottom: 1rem;">Already Logged In</h2>
                    <p class="text-muted" style="margin-bottom: 1.5rem;">Redirecting to your dashboard...</p>
                    <a href="<?php echo esc_url(site_url('/zonatech-dashboard/')); ?>" class="btn btn-primary">
                        <i class="fas fa-tachometer-alt"></i> Go to Dashboard
                    </a>
                </div>
            </div>
            <script>
            setTimeout(function() {
                window.location.href = '<?php echo esc_js(site_url('/zonatech-dashboard/')); ?>';
            }, 1000);
            </script>
            <?php
            return ob_get_clean();
        }
        
        ob_start();
        include ZONATECH_PLUGIN_DIR . 'templates/login.php';
        return ob_get_clean();
    }
    
    public function render_register() {
        // If already logged in, show redirect message
        if (is_user_logged_in()) {
            ob_start();
            ?>
            <div class="zonatech-container">
                <div class="glass-card text-center" style="padding: 3rem; max-width: 500px; margin: 2rem auto;">
                    <i class="fas fa-check-circle" style="font-size: 4rem; color: #22c55e; margin-bottom: 1.5rem;"></i>
                    <h2 class="text-white" style="margin-bottom: 1rem;">Already Logged In</h2>
                    <p class="text-muted" style="margin-bottom: 1.5rem;">You already have an account. Redirecting to dashboard...</p>
                    <a href="<?php echo esc_url(site_url('/zonatech-dashboard/')); ?>" class="btn btn-primary">
                        <i class="fas fa-tachometer-alt"></i> Go to Dashboard
                    </a>
                </div>
            </div>
            <script>
            setTimeout(function() {
                window.location.href = '<?php echo esc_js(site_url('/zonatech-dashboard/')); ?>';
            }, 1000);
            </script>
            <?php
            return ob_get_clean();
        }
        
        ob_start();
        include ZONATECH_PLUGIN_DIR . 'templates/register.php';
        return ob_get_clean();
    }
    
    public function render_verify_email() {
        // If already logged in, redirect to dashboard
        if (is_user_logged_in()) {
            ob_start();
            ?>
            <div class="zonatech-container">
                <div class="glass-card text-center" style="padding: 3rem; max-width: 500px; margin: 2rem auto;">
                    <i class="fas fa-check-circle" style="font-size: 4rem; color: #22c55e; margin-bottom: 1.5rem;"></i>
                    <h2 class="text-white" style="margin-bottom: 1rem;">Already Verified</h2>
                    <p class="text-muted" style="margin-bottom: 1.5rem;">Your email is already verified. Redirecting to dashboard...</p>
                    <a href="<?php echo esc_url(site_url('/zonatech-dashboard/')); ?>" class="btn btn-primary">
                        <i class="fas fa-tachometer-alt"></i> Go to Dashboard
                    </a>
                </div>
            </div>
            <script>
            setTimeout(function() {
                window.location.href = '<?php echo esc_js(site_url('/zonatech-dashboard/')); ?>';
            }, 1000);
            </script>
            <?php
            return ob_get_clean();
        }
        
        ob_start();
        include ZONATECH_PLUGIN_DIR . 'templates/verify-email.php';
        return ob_get_clean();
    }
    
    public function render_dashboard() {
        // Check login - show login required if not logged in
        if (!$this->check_login()) {
            return $this->render_login_required('dashboard');
        }
        
        // Get user data with error handling
        try {
            $user_data = ZonaTech_User_Auth::get_user_dashboard_data();
        } catch (Exception $e) {
            error_log('ZonaTech Dashboard Error: ' . $e->getMessage());
            $user_data = array(
                'user' => array(
                    'display_name' => wp_get_current_user()->display_name,
                    'first_name' => wp_get_current_user()->first_name ?: 'User',
                    'last_name' => wp_get_current_user()->last_name,
                    'email' => wp_get_current_user()->user_email,
                    'avatar' => get_avatar_url(get_current_user_id()),
                    'phone' => '',
                    'registered' => wp_get_current_user()->user_registered
                ),
                'stats' => array(
                    'subjects' => 0,
                    'quizzes' => 0,
                    'purchases' => 0,
                    'total_spent' => 0
                )
            );
        }
        
        ob_start();
        include ZONATECH_PLUGIN_DIR . 'templates/dashboard.php';
        return ob_get_clean();
    }
    
    public function render_past_questions() {
        // Check login - show login required if not logged in
        if (!$this->check_login()) {
            return $this->render_login_required('past-questions');
        }
        
        // Get exam types with error handling
        try {
            $exam_types = ZonaTech_Past_Questions::get_exam_types();
        } catch (Exception $e) {
            error_log('ZonaTech Past Questions Error: ' . $e->getMessage());
            // Fallback exam types
            $exam_types = array(
                'jamb' => array(
                    'name' => 'JAMB',
                    'full_name' => 'Joint Admissions and Matriculation Board',
                    'icon' => 'fas fa-graduation-cap',
                    'color' => '#8b5cf6'
                ),
                'waec' => array(
                    'name' => 'WAEC',
                    'full_name' => 'West African Examinations Council',
                    'icon' => 'fas fa-book-open',
                    'color' => '#22c55e'
                ),
                'neco' => array(
                    'name' => 'NECO',
                    'full_name' => 'National Examinations Council',
                    'icon' => 'fas fa-scroll',
                    'color' => '#f59e0b'
                )
            );
        }
        
        $is_guest = false;
        
        ob_start();
        include ZONATECH_PLUGIN_DIR . 'templates/past-questions.php';
        return ob_get_clean();
    }
    
    public function render_nin_service() {
        // Check login - show login required if not logged in
        if (!$this->check_login()) {
            return $this->render_login_required('nin-service');
        }
        
        $is_guest = false;
        
        ob_start();
        include ZONATECH_PLUGIN_DIR . 'templates/nin-service.php';
        return ob_get_clean();
    }
    
    public function render_scratch_cards() {
        // Check login - show login required if not logged in
        if (!$this->check_login()) {
            return $this->render_login_required('scratch-cards');
        }
        
        // Get card types with error handling
        try {
            $card_types = ZonaTech_Scratch_Cards::get_card_types();
        } catch (Exception $e) {
            error_log('ZonaTech Scratch Cards Error: ' . $e->getMessage());
            $card_types = array();
        }
        
        $is_guest = false;
        
        ob_start();
        include ZONATECH_PLUGIN_DIR . 'templates/scratch-cards.php';
        return ob_get_clean();
    }
    
    public function render_payment() {
        // Check login - show login required if not logged in
        if (!$this->check_login()) {
            return $this->render_login_required('payment');
        }
        
        ob_start();
        include ZONATECH_PLUGIN_DIR . 'templates/payment.php';
        return ob_get_clean();
    }
    
    public function render_homepage() {
        // Get exam types with error handling
        try {
            $exam_types = ZonaTech_Past_Questions::get_exam_types();
        } catch (Exception $e) {
            $exam_types = array();
        }
        
        // Get card types with error handling
        try {
            $card_types = ZonaTech_Scratch_Cards::get_card_types();
        } catch (Exception $e) {
            $card_types = array();
        }
        
        ob_start();
        include ZONATECH_PLUGIN_DIR . 'templates/homepage.php';
        return ob_get_clean();
    }
    
    public function render_feedback() {
        ob_start();
        include ZONATECH_PLUGIN_DIR . 'templates/feedback.php';
        return ob_get_clean();
    }
    
    public function render_admin_dashboard() {
        // Check if user is admin
        if (!current_user_can('manage_options')) {
            ob_start();
            ?>
            <div class="zonatech-container">
                <div class="glass-card text-center" style="padding: 3rem; max-width: 500px; margin: 2rem auto;">
                    <i class="fas fa-lock" style="font-size: 4rem; color: #ef4444; margin-bottom: 1.5rem;"></i>
                    <h2 class="text-white" style="margin-bottom: 1rem;">Access Denied</h2>
                    <p class="text-muted" style="margin-bottom: 1.5rem;">You don't have permission to access the admin dashboard.</p>
                    <a href="<?php echo esc_url(site_url('/zonatech-dashboard/')); ?>" class="btn btn-primary">
                        <i class="fas fa-tachometer-alt"></i> Go to Dashboard
                    </a>
                </div>
            </div>
            <script>
            setTimeout(function() {
                window.location.href = '<?php echo esc_js(site_url('/zonatech-dashboard/')); ?>';
            }, 2000);
            </script>
            <?php
            return ob_get_clean();
        }
        
        ob_start();
        include ZONATECH_PLUGIN_DIR . 'templates/admin-dashboard.php';
        return ob_get_clean();
    }
}
<?php
// © 2025 jspro1. All rights reserved. 
// Set page variables
$page_title = 'Hello Vietnam - Discover the Beauty';
$header_title = 'Hello Vietnam!';
$header_subtitle = 'Discover the Land of the Rising Dragon';

// Debug info for POC
$debug_info = '';

// Form handling
$message = '';
$submitted = false;

if ($_POST && isset($_POST['name']) && isset($_POST['email'])) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    
    $debug_info .= "<span class='icon icon-success icon-inline'></span>Form submitted successfully!<br>";
    $debug_info .= "<span class='icon icon-user icon-inline'></span>Name: " . $name . "<br>";
    $debug_info .= "<span class='icon icon-email icon-inline'></span>Email: " . $email . "<br>";
    
    // Basic validation
    if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $timestamp = date('Y-m-d H:i:s');
        
        // Store in session (simulate database)
        $_SESSION['leads'][] = [
            'name' => $name,
            'email' => $email,
            'timestamp' => $timestamp
        ];
        
        $debug_info .= "<span class='icon icon-success icon-inline'></span>Validation passed - data is valid!<br>";
        $debug_info .= "<span class='icon icon-database icon-inline'></span>Data stored in session (simulating database)<br>";
        
        // Email attempt (POC version)
        $to = "your-email@example.com"; // Email can be changed for test purposes
        $subject = "Vietnam Adventure - New Signup: $name";
        $email_body = "New Vietnam Adventure signup!\n\nName: $name\nEmail: $email\nTimestamp: $timestamp\n\nBest regards,\nVietnam Adventure System";
        $headers = "From: noreply@vietnam-adventure.com\r\nReply-To: $email";
        
        // Attempt to send email
        if (function_exists('mail')) {
            $email_sent = @mail($to, $subject, $email_body, $headers);
            if ($email_sent) {
                $debug_info .= "<span class='icon icon-email icon-inline'></span>Email sent successfully to the admin<br>";
            } else {
                $debug_info .= "<span class='icon icon-warning icon-inline'></span>Email sending failed (normal on free hosting - would work with configured SMTP in prod)<br>";
            }
        } else {
            $debug_info .= "<span class='icon icon-warning icon-inline'></span>Mail function not available on this server<br>";
        }
        
        $debug_info .= "<span class='icon icon-celebration icon-inline'></span>Process completed successfully<br>";
        
        $message = "Xin chào $name! Thank you for your interest in Vietnam. Welcome to our community!";
        $submitted = true;
        
    } else {
        $message = "Please provide a valid name and email address.";
        $debug_info .= "<span class='icon icon-error icon-inline'></span>Validation failed - please check your input<br>";
    }
}

// Get lead count
$lead_count = isset($_SESSION['leads']) ? count($_SESSION['leads']) : 0;


// Includes
include 'includes/header.php';
include 'includes/nav.php';

?>
        <!-- Cards  -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
            <div class="feature-card">
                <div class="feature-icon icon icon-welcome icon-lg"></div>
                <h3>Welcome</h3>
                <p>Beautiful Vietnam awaits you</p>
            </div>


            <!-- Culture Card link  -->
            <a href="festivals.php" style="text-decoration: none; color: inherit;">
                <div class="feature-card" style="cursor: pointer;">
                    <div class="feature-icon icon icon-culture icon-lg"></div>
                    <h3>Culture</h3>
                    <p>Rich history and traditions</p>
                </div>
            </a>

            <div class="feature-card">
                <div class="feature-icon icon icon-food icon-lg"></div>
                <h3>Food</h3>
                <p>Amazing Vietnamese cuisine</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon icon icon-adventure icon-lg"></div>
                <h3>Adventure</h3>
                <p>Explore breathtaking landscapes</p>
            </div>
        </div>

        <?php if ($debug_info): ?>
        <div class="card" style="background: linear-gradient(135deg, #e3f2fd, #f3e5f5); border-left: 4px solid #2196f3;">
            <h3><span class="icon icon-debug icon-inline"></span>POC Debug Info:</h3>
            <p style="font-size: 0.95em; color: #333; line-height: 1.6;"><?php echo $debug_info; ?></p>
            <small style="color: #666; font-style: italic;">
                This debug info helps you understand what happens when the form is submitted. 
                In a production version, this would be hidden.
            </small>
        </div>
        <?php endif; ?>

        <div class="card">
            <?php if ($message): ?>
                <div class="message <?php echo $submitted ? 'success' : 'error'; ?>">
                    <span class="icon <?php echo $submitted ? 'icon-success' : 'icon-error'; ?> icon-inline"></span><?php echo $message; ?>
                </div>
            <?php endif; ?>

            <?php if (!$submitted): ?>
                <h2>Join Our Vietnam Adventure</h2>
                <p>Get exclusive travel guides, local tips, and special offers for your Vietnam journey!</p>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="name">Your Name:</label>
                        <input type="text" id="name" name="name" required 
                               value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" id="email" name="email" required 
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>
                    
                    <button type="submit" class="btn">Start My Vietnam Adventure</button>
                </form>
            <?php else: ?>
                <h2>Welcome to the Vietnam Community!</h2>
                <p>Your adventure guide will be sent to your email shortly.</p>
                <p>In the meantime, here are some quick Vietnam facts:</p>
                <ul style="margin: 20px 0; padding-left: 20px;">
                    <li><span class="icon icon-capitol icon-inline"></span>Capital: Hanoi</li>
                    <li><span class="icon icon-city icon-inline"></span>Largest city: Ho Chi Minh City</li>
                    <li><span class="icon icon-pho icon-inline"></span>Famous dish: Phở</li>
                    <li><span class="icon icon-unesco icon-inline"></span>UNESCO Sites: 8 World Heritage Sites</li>
                    <li><span class="icon icon-coffee icon-inline"></span>Coffee: 2nd largest exporter globally</li>
                </ul>
                
                <form method="POST" action="">
                    <button type="submit" class="btn">Sign Up Another Friend</button>
                </form>
            <?php endif; ?>
        </div>

        <?php if ($lead_count > 0): ?>
        <div class="card">
            <div class="stats">
                <span class="icon icon-celebration icon-inline"></span><?php echo $lead_count; ?> adventurous soul has joined our Vietnam community!
            </div>
        </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['leads']) && !empty($_SESSION['leads'])): ?>
        <div class="card">
            <h3>📋 Collected Leads (POC Demonstration):</h3>
            <p style="color: #666; font-size: 0.9em; margin-bottom: 15px;">
                <em>This shows the data being collected in real-time. In production, this data would be stored in a secure database.</em>
            </p>
            <ul style="max-height: 200px; overflow-y: auto;">
                <?php foreach (array_reverse($_SESSION['leads']) as $index => $lead): ?>
                    <li style="margin: 10px 0; padding: 15px; background: #f8f9fa; border-radius: 8px; border-left: 3px solid #007bff;">
                        <strong><?php echo htmlspecialchars($lead['name']); ?></strong> - 
                        <?php echo htmlspecialchars($lead['email']); ?><br>
                        <small style="color: #666;">
                            <span class="icon icon-clock icon-inline"></span>Signed up: <?php echo $lead['timestamp']; ?> 
                            (Entry #<?php echo count($_SESSION['leads']) - $index; ?>)
                        </small>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <div class="card">
            <h3>Why Vietnam?</h3>
            <p>From the bustling streets of Ho Chi Minh City to the serene beauty of Ha Long Bay, 
               Vietnam offers an incredible blend of ancient culture and modern dynamism. 
               Join thousands of travelers who have discovered the magic of Southeast Asia's hidden gem.</p>
        </div>

        <div class="card" style="background: #f0f8ff; border-left: 4px solid #007bff;">
            <h3><span class="icon icon-rocket icon-inline"></span>POC Tech Notes:</h3>
            <ul style="color: #555; line-height: 1.6;">
                <li><strong>Form Processing:</strong> PHP handles form submission and validation</li>
                <li><strong>Data Storage:</strong> Currently using PHP sessions (would be database in prod)</li>
                <li><strong>Email System:</strong> Built-in PHP mail() function (would use SMTP service in prod)</li>
                <li><strong>Security:</strong> Input validation implemented</li>
                <li><strong>UI/UX:</strong> Responsive design with modern styling</li>
            </ul>
        </div>

<?php include 'includes/footer.php'; ?>
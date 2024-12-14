<?php
    session_start();
    include("connection.php");

    if(!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    }

    $idno = $_SESSION['id'];

    $query = "SELECT email, firstname, lastname, profile_pic, CONCAT(firstname, ' ', lastname) AS fullname FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $idno);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "<script>alert('No Users Found.')</script>";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OnliFunds</title>
    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap">
	<link href="https://fonts.googleapis.com/css2?family=Allura&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMtl/tE7HT72fSUkSuZXCe9jKg6abX5xnu2bDbD" crossorigin="anonymous">
</head>
<body>
	<!-- Navbar for Logged-in Users -->
	<nav class="logged-in-navbar">
		<div class="logged-in-navbar-logo">
			<a href="lanAfter.html" style="text-decoration:none;">
				<img src="../images/logo.png" alt="OnliFunds Logo" class="logged-in-logo-img">
			</a>
			<div class="logged-in-logo-text">
				<h1><a href="lanAfter.html" style="text-decoration:none; color:black;">OnliFunds</a></h1>
				<p>Empower Your Ideas</p>
			</div>
		</div>
		<div class="logged-in-nav-links">
			<a href="lanAfter.php" class="logged-in-nav-item">Home</a>
			<a href="aboutA.php" class="logged-in-nav-item">About</a>
			<a href="projectsA.php" class="logged-in-nav-item">Projects</a>
			<a href="create1.php" class="logged-in-nav-item logged-in-start-project-button">Start a Project</a>
		<div class="logged-in-user-profile">
            <span class="logged-in-user-name"><?php echo htmlspecialchars($user['fullname']); ?></span>
			<?php if (!empty($user['profile_pic'])): ?>
                <img src="../images/profilepic/<?php echo htmlspecialchars($user['profile_pic']); ?>" alt="Profile Picture" class="logged-in-profile-img">
            <?php else: ?>
                <div class="author-icon" id="author-icon" style="display: none;"><?php echo htmlspecialchars($user['default_pic']) ?></div> <!-- Pa fix ko ani sa front-end di ma show ang default -->
            <?php endif; ?>
			<div class="dropdown-menu">
				<a href="my-projects.html">My Projects</a>
				<a href="backed-projects.html">Backed Projects</a>
				<a href="profile-settings.php">Profile Settings</a>
				<a href="login.php">Log Out</a>
			</div>
		</div>
		</div>
	</nav>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const userProfile = document.querySelector('.logged-in-user-profile');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    userProfile.addEventListener('click', function() {
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });

    // Close the dropdown if clicked outside
    document.addEventListener('click', function(e) {
        if (!userProfile.contains(e.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
});
</script>
<!-- About Banner Section -->
<section class="about-banner">
    <div class="overlay"></div>
    <div class="banner-content">
        <h1>About OnliFunds</h1>
    </div>
</section>

<!-- Who We Are Section -->
<section class="about-section">
    <div class="about-content">
        <div class="text-content">
            <!-- Section Header with Underline and Title -->
            <div class="section-header">
                <span class="line"></span>
                <h4>Who We Are</h4>
            </div>
            <h2>Your Partner in Progress and Innovation</h2>
            <p>We are committed to empowering creators and supporting visionary ideas that drive progress and innovation. With a foundation built on trust, collaboration, and responsibility, our platform connects passionate backers with projects that aim to make a positive impact on the world.</p>

            <!-- Feature Cards -->
            <div class="features">
                <div class="feature-card">
                    <div class="icon"><img src="../images/safe.png" alt="Check Icon"></div>
                    <div class="text">
                        <h3>Trusted Partner</h3>
                        <p>A platform built on trust, empowering creators and supporters to bring their visions to life.</p>
                    </div>
                </div>
                <div class="feature-card">
                    <div class="icon"><img src="../images/safe.png" alt="Check Icon"></div>
                    <div class="text">
                        <h3>Responsibility</h3>
                        <p>We prioritize integrity and accountability, ensuring every project aligns with our values and commitments.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Image with Background Shape -->
        <div class="image-container">
            <div class="background-shape"></div>
            <img src="../images/a1.png" alt="Team Member" class="about-image">
        </div>
    </div>
</section>

<!-- Quote Section -->
<section class="quote-section">
    <div class="quote-background-container">
        <div class="background-overlay"></div>
    </div>
    <div class="quote-content-container">
        <div class="quote-image-container">
            <img src="../images/gandhi.png" alt="Gandhi" class="quote-image">
        </div>
        <div class="quote-text-container">
            <h2 class="quote-heading">The best way to find yourself is to lose yourself in the service of others.</h2>
            <p class="quote-body">
                Engaging in service to others fosters personal growth and fulfillment. By dedicating time to help those in need, we uplift our communities and deepen our understanding of our own values and strengths. Each act of kindness promotes empathy and compassion, creating connections across diverse backgrounds. In losing ourselves in the service of others, we often find a clearer sense of purpose and belonging.
            </p>
            <p class="quote-author">Gandhi</p>
            <p class="author-subtext">Mahatma Gandhi</p>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="about-categories-section">
    <h3 class="about-categories-title">CATEGORIES</h3>
    <h2 class="about-categories-subtitle">Why choose OnliFunds</h2>
    <p class="about-categories-description">
        Explore a variety of project categories that align with your passions and values. Whether you’re interested in technology, health, education, or environmental impact, there’s a project here for you to support and make a difference.
    </p>

    <div class="about-category-grid">
        <div class="about-category-card">
            <div class="about1"><img src="../images/technology.png" alt="Technology Icon"></div>
            <div>
                <h4>Technology</h4>
                <p>Support groundbreaking tech projects that aim to transform industries and improve lives through innovation.</p>
            </div>
        </div>
        <div class="about-category-card">
            <div class="about1"><img src="../images/business.png" alt="Business Icon"></div>
            <div>
                <h4>Business</h4>
                <p>Back entrepreneurial ventures focused on creating sustainable growth and impactful solutions.</p>
            </div>
        </div>
        <div class="about-category-card">
            <div class="about1"><img src="../images/health.png" alt="Health Icon"></div>
            <div>
                <h4>Health</h4>
                <p>Help bring to life health initiatives that promote well-being and improve healthcare access.</p>
            </div>
        </div>
        <div class="about-category-card">
            <div class="about1"><img src="../images/environment.png" alt="Environment Icon"></div>
            <div>
                <h4>Environment</h4>
                <p>Support eco-friendly projects dedicated to preserving our planet and promoting sustainable practices.</p>
            </div>
        </div>
        <div class="about-category-card">
            <div class="about1"><img src="../images/education.png" alt="Education Icon"></div>
            <div>
                <h4>Education</h4>
                <p>Empower educational projects that foster learning, growth, and equal access to knowledge.</p>
            </div>
        </div>
        <div class="about-category-card">
            <div class="about1"><img src="../images/animals.png" alt="Animals Icon"></div>
            <div>
                <h4>Animals</h4>
                <p>Make a difference by supporting projects that protect, rescue, and care for animals.</p>
            </div>
        </div>
    </div>
</section>

<!-- Mission Section -->
<section class="mission-section">
    <div class="mission-container">
        <!-- Image and Background Shape -->
        <div class="mission-image-wrapper">
            <div class="mission-shape"></div>
            <img src="../images/thumbs.png" alt="Thumbs Up" class="mission-image">
        </div>

        <!-- Mission Content -->
        <div class="mission-content">
            <h3 class="mission-subtitle">Our Mission</h3>
            <h2 class="mission-title">Shaping Tomorrow for Brighter Possibilities</h2>
            <p class="mission-description">
                Our mission is to empower creators and backers to build a future filled with innovation, impact, and progress. By connecting visionary ideas with passionate supporters, we foster a community where new possibilities thrive, and positive change becomes achievable.
            </p>

            <!-- Stats Section -->
            <div class="mission-stats">
                <div class="stat">
                    <span class="stat-value">20</span>
                    <p class="stat-label">Total Users</p>
                </div>
                <div class="stat">
                    <span class="stat-value">4</span>
                    <p class="stat-label">Projects</p>
                </div>
                <div class="stat">
                    <span class="stat-value">1k</span>
                    <p class="stat-label">Total Donations</p>
                </div>
            </div>

            <!-- CTA Button -->
            <a href="#" class="mission-button">See Projects -></a>
        </div>
    </div>
</section>


<!-- CTA Banner Section -->
<section class="banner-section">
    <div class="overlay"></div>
    <div class="banner-content">
        <h1>"Help Bring Dreams to Life"</h1>
        <a href="projectsA.html" class="donate-button" style="font-weight:bold;">DONATE</a>
    </div>
</section>

	<!-- Footer Section -->
	<footer class="footer">
		<div class="footer-content">
			<!-- About Section -->
			<div class="footer-section about" style="text-align: left; padding-right:200px;">
				<h2 class="footer-logo">OnliFunds</h2>
				<p class="footer-description">
					OnliFunds is a crowdfunding website that lets you raise money for anything that matters to you.
					From personal causes and events to projects and more. We aim to help people from our community
					to raised the funds they need.
				</p>
			</div>

			<!-- Links Section -->
			<div class="footer-section links" style="text-align: left; padding-right:200px;">
				<h3 class="footer-heading">Learn More</h3>
				<ul class="footer-links">
					<li><a href="/about">About</a></li>
					<li><a href="/#team-members">Team Members</a></li>
					<li><a href="#">Privacy Policy</a></li>
					<li><a href="#">Terms And Conditions</a></li>
				</ul>
			</div>

			<!-- Social Media Section -->
			<div class="footer-section social-media" style="text-align: left;">
				<h3 class="footer-heading">Social Medias</h3>
				<ul class="social-icons">
					<li><a href="#"><img src="../images/facebook.png" alt="Facebook Icon" style="	width: 28px;height:auto;"> Facebook</a></li>
					<li><a href="#"><img src="../images/twitter.png" alt="Twitter Icon" style="	width: 28px;height:auto;"> Twitter</a></li>
					<li><a href="#"><img src="../images/instagram.png" alt="Instagram Icon" style="	width: 28px;height:auto;"> Instagram</a></li>
					<li><a href="#"><img src="../images/linkedin.png" alt="LinkedIn Icon" style="	width: 28px;height:auto;"> LinkedIn</a></li>
				</ul>
			</div>
		</div>

		<!-- Copyright Section -->
		<div class="footer-bottom">
			<p>© 2024 Copyright OnliFunds. All Rights Reserved</p>
		</div>
	</footer>
</body>
</html>

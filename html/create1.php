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
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['project_title'] = $_POST['project-title'];
        $_SESSION['project_category'] = $_POST['project-category'];
        $_SESSION['barangay'] = $_POST['barangay'];
        $_SESSION['fund_goal'] = $_POST['fund-goal'];
        $_SESSION['end_date'] = $_POST['end-date'];
        $_SESSION['firstname'] = $_POST['first-name'];
        $_SESSION['lastname'] = $_POST['last-name'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['phone-number'] = $_POST['phone-number'];
        header('Location: create2.php'); // Redirect to the next page
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <link href="../css/main.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Ranchers&family=Rubik+Glitch&display=swap" rel="stylesheet">
    <title>OnliFunds</title>
	<style>
		.line-1 {
		 height: 40px;
		 }
		.line-2 {
			height: 20px; /* Height of the vertical line */
		}

	</style>
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
                    <a href="profile-settings.html">Profile Settings</a>
                    <a href="login.php">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const userProfile = document.querySelector('.logged-in-user-profile');
            const dropdownMenu = document.querySelector('.dropdown-menu');

            userProfile.addEventListener('click', function () {
                dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
            });

            // Close the dropdown if clicked outside
            document.addEventListener('click', function (e) {
                if (!userProfile.contains(e.target)) {
                    dropdownMenu.style.display = 'none';
                }
            });
        });
    </script>
    <!-- About Banner Section -->
    <section class="banner1">
        <div class="overlay"></div>
        <div class="banner-content">
            <h1>Project Details</h1>
        </div>
    </section>

    <section class="create-container" >
        <div class="content1" style="display: flex; flex-direction:column;">
            <div class="steps" style="display: flex; flex-direction:column;">
                <div class="step">
                    <div class="step-content">
                        <div class="step-icon">
                            <div class="step-pic" style="background-image: url('../images/step1.png');"></div>
                            <span class="step-number step-number-1"><img src="../images/pen.png" alt="Pen"></span>
                                <div class="line line-1"></div> <!-- Line under step 1 -->
                    </div>
                    <div class="step-text">
                        <span class="text text-1">Get Started</span>
                        <span class="description description-1">Set essential fundraiser details such as fundraiser title, target, overview, and location.</span>
                    </div>
                </div>

                </div>

                <div class="step">
                    <div class="step-content">
                        <div class="step-icon">
                            <div class="step-pic" style="background-image: url('../images/step2.png');"></div>
                            <span class="step-number step-number-2">2</span>
                            <div class="line line-2"></div> <!-- Line under step 2 -->
                        </div>
                        <div class="step-text">
                            <span class="text text-2">Resources</span>
                        </div>
                    </div>
                </div>

                <div class="step">
                    <div class="step-content">
                        <div class="step-icon">
                            <div class="step-pic" style="background-image: url('../images/step3.png');"></div>
                            <span class="step-number step-number-3">3</span>
                                    <div class="line line-2"></div> <!-- Line under step 3 -->
                        </div>
                        <div class="step-text">
                            <span class="text text-3">Story</span>
                        </div>
                    </div>
                </div>

                <div class="step">
                    <div class="step-content">
                        <div class="step-icon">
                            <div class="step-pic" style="background-image: url('../images/step4.png');"></div>
                            <span class="step-number step-number-4">4</span>
                        </div>
                        <div class="step-text">
                            <span class="text text-4">Payment Methods</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-container">
            <form method="post" action="">
                <h2>Let's get started</h2>
                <h3>Fundraiser information</h3>

                <label for="project-title">Project title</label>
                <input id="project-title" name="project-title" placeholder="Add title of your project" type="text"/>

                <label for="project-category">Project category</label>
                <select id="project-category" name="project-category">
                    <option>Please Select</option>
                    <option value="animals">Animals</option>
                    <option value="business">Business & Startups</option>
                    <option value="health">Health</option>
                    <option value="education">Education</option>
                    <option value="nature">Nature</option>
                    <option value="technology">Technology</option>
                </select>
                
                <h3>Fundraiser location</h3>
                <p>Choose the location where you plan to withdraw your funds. We only support those within Cebu City, Philippines.</p>
                <label for="country">Country</label>
                <input id="country" readonly type="text" value="Philippines"/>
                <label for="city">City</label>
                <input id="city" readonly type="text" value="Cebu"/>

                <label for="barangay">Barangay</label>
                <select id="barangay" name="barangay">
                    <option>Please Select</option>
                    <option value="apm">Apas</option>
                    <option value="banilad">Banilad</option>
                    <option value="basak-pardo">Basak Pardo</option>
                    <option value="basak-san-nicolas">Basak San Nicolas</option>
                    <option value="bato">Bato</option>
                    <option value="bayanihan">Bayanihan</option>
                    <option value="bojo">Bojo</option>
                    <option value="bonbon">Bonbon</option>
                    <option value="camputhaw">Camputhaw</option>
                    <option value="carreta">Carreta</option>
                    <option value="casuntingan">Casuntingan</option>
                    <option value="cahumayan">Cahumayan</option>
                    <option value="guba">Guba</option>
                    <option value="guadalupe">Guadalupe</option>
                    <option value="karla">Karla</option>
                    <option value="kawasan">Kawasan</option>
                    <option value="labangon">Labangon</option>
                    <option value="lantana">Lantana</option>
                    <option value="mambaling">Mambaling</option>
                    <option value="mayan">Mayan</option>
                    <option value="pahina-central">Pahina Central</option>
                    <option value="parian">Parian</option>
                    <option value="pardo">Pardo</option>
                    <option value="pasil">Pasil</option>
                    <option value="pulangbato">Pulangbato</option>
                    <option value="pit-os">Pit-os</option>
                    <option value="san-isidro">San Isidro</option>
                    <option value="san-jose">San Jose</option>
                    <option value="san-nicolas">San Nicolas</option>
                    <option value="san-roque">San Roque</option>
                    <option value="santo-nino">Santo Niño</option>
                    <option value="sugbo">Sugbo</option>
                    <option value="sugbo">Sapangdaku</option>
                    <option value="talisay">Talisay</option>
                    <option value="toledo">Toledo</option>
                    <option value="tungol">Tungol</option>
                </select>

                <h3>Donation information</h3>
                <label for="fund-goal">Fund Goal</label>
                <input id="fund-goal" name="fund-goal" placeholder="Add the goal amount to raise" type="text"/>
                <label for="end-date">End date</label>
                <input id="end-date" type="date" name="end-date"/>

                <h3>Fund Beneficiary</h3>
                <p>Name of the person receiving the funds.</p>
                <div class="half-width first">
                    <label for="first-name">First name</label>
                    <input id="first-name" name="first-name" placeholder="Enter first name" type="text"/>
                </div>

                <div class="half-width last">
                    <label for="last-name">Last name</label>
                    <input id="last-name" name="last-name" placeholder="Enter last name" type="text"/>
                </div>

                <div>
                <label for="email">Email</label>
                <input id="email" name="email" placeholder="Enter valid email address" type="email"/>
                </div>

                <label for="phone-number">Phone Number</label>
                <input id="phone-number" placeholder="Enter valid phone number" name="phone-number" type="text"/>
                
                <button class="continue-btn" type="submit">Continue</button>
            </form>
        </div>
    </section>

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
                    <li><a href="#"><img src="../images/facebook.png" alt="Facebook Icon" style="width: 28px;height:auto;"> Facebook</a></li>
                    <li><a href="#"><img src="../images/twitter.png" alt="Twitter Icon" style="width: 28px;height:auto;"> Twitter</a></li>
                    <li><a href="#"><img src="../images/instagram.png" alt="Instagram Icon" style="width: 28px;height:auto;"> Instagram</a></li>
                    <li><a href="#"><img src="../images/linkedin.png" alt="LinkedIn Icon" style="width: 28px;height:auto;"> LinkedIn</a></li>
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

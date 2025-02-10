<?php
session_start();

// Function to sanitize input
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Handle multi-step form logic
$step = isset($_GET['step']) ? (int)$_GET['step'] : 1;

if (isset($_POST['step1'])) {
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "Username and password are required.";
    } else {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header("Location: ?step=2");
        exit();
    }
}

if (isset($_POST['step2'])) {
    $_SESSION['majorFaculty'] = sanitizeInput($_POST['majorFaculty']);
    $_SESSION['year'] = sanitizeInput($_POST['year']);
    $_SESSION['subjects'] = isset($_POST['subjects']) ? $_POST['subjects'] : [];

    header("Location: ?step=3");
    exit();
}

if (isset($_POST['step3'])) {
    $_SESSION['newsletter'] = isset($_POST['newsletter']) ? 1 : 0;
    $_SESSION['comments'] = sanitizeInput($_POST['comments']);
    header("Location: ?step=4");
    exit();
}

// Handle file upload
if (isset($_POST["uploadPhoto"])) {
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
        if ($_FILES["photo"]["type"] != "image/jpeg") {
            $uploadError = "JPEG photos only, please!";
        } elseif (!move_uploaded_file($_FILES["photo"]["tmp_name"], "photos/" . basename($_FILES["photo"]["name"]))) {
            $uploadError = "Sorry, there was a problem uploading that photo.";
        } else {
            $_SESSION["photoPath"] = "photos/" . basename($_FILES["photo"]["name"]);
            header("Location: ?step=5");
            exit();
        }
    } else {
        $uploadError = "Please select a valid JPEG file.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Multi-Step Form with File Upload</title>
</head>
<body>

<h1>Step <?php echo $step; ?></h1>

<?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

<form method="post" enctype="multipart/form-data">

    <?php if ($step == 1) : ?>
        <h2>Student Login</h2>
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $_SESSION['username'] ?? ''; ?>" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" name="step1" value="Next">
    <?php endif; ?>

    <?php if ($step == 2) : ?>
        <h2>Choose Your Major</h2>
        <input type="radio" name="majorFaculty" value="software" required> Software Engineering<br>
        <input type="radio" name="majorFaculty" value="hardware" required> Hardware Engineering<br>

        <h2>Select Your Year</h2>
        <select name="year" required>
            <option value="first">First Year</option>
            <option value="second">Second Year</option>
            <option value="third">Third Year</option>
        </select><br>

        <h2>Subjects</h2>
        <input type="checkbox" name="subjects[]" value="knowledge"> Knowledge Engineering<br>
        <input type="checkbox" name="subjects[]" value="cloud"> Cloud Computing<br>

        <input type="submit" name="step2" value="Next">
        <a href="?step=1"><button type="button">Back</button></a>
    <?php endif; ?>

    <?php if ($step == 3) : ?>
        <h2>Preferences</h2>
        <label>Subscribe to Newsletter?</label>
        <input type="checkbox" name="newsletter" value="1"><br>
        <label>Comments:</label>
        <textarea name="comments"></textarea><br>

        <input type="submit" name="step3" value="Next">
        <a href="?step=2"><button type="button">Back</button></a>
    <?php endif; ?>

    <?php if ($step == 4) : ?>
        <h2>Upload Your Photo</h2>
        <?php if (isset($uploadError)) echo "<p style='color:red;'>$uploadError</p>"; ?>
        <input type="file" name="photo" accept="image/jpeg"><br>
        <input type="submit" name="uploadPhoto" value="Upload Photo">
        <a href="?step=3"><button type="button">Back</button></a>
    <?php endif; ?>

</form>

<?php if ($step == 5) : ?>
    <h2>Thank You!</h2>
    <p><strong>Name:</strong> <?php echo $_SESSION['username']; ?></p>
    <p><strong>Faculty:</strong> <?php echo $_SESSION['majorFaculty']; ?></p>
    <p><strong>Year:</strong> <?php echo $_SESSION['year']; ?></p>
    <p><strong>Subjects:</strong> <?php echo !empty($_SESSION['subjects']) ? implode(", ", $_SESSION['subjects']) : "None"; ?></p>
    <p><strong>Newsletter:</strong> <?php echo $_SESSION['newsletter'] ? "Subscribed" : "Not Subscribed"; ?></p>
    <p><strong>Comments:</strong> <?php echo $_SESSION['comments']; ?></p>

    <h2>Uploaded Photo</h2>
    <?php if (isset($_SESSION['photoPath'])) : ?>
        <img src="<?php echo $_SESSION['photoPath']; ?>" width="200">
    <?php endif; ?>

    <a href="?step=1"><button type="button">Restart</button></a>
<?php endif; ?>

</body>
</html>

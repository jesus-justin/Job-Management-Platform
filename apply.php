<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
    $stmt = $pdo->prepare("SELECT * FROM jobs WHERE id = ?");
    $stmt->execute([$job_id]);
    $job = $stmt->fetch();

    if (!$job) {
        header('Location: index.php');
        exit();
    }

} else {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $applicant_name = $_POST['applicant_name'];
    $applicant_email = $_POST['applicant_email'];
    $qualifications = $_POST['qualifications'];

    $stmt = $pdo->prepare("INSERT INTO job_applications (job_id, applicant_name, applicant_email, qualifications, user_id) 
                           VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$job_id, $applicant_name, $applicant_email, $qualifications, $_SESSION['user_id']]);

    echo json_encode(["status" => "success"]);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Job</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f9; margin: 0; padding: 0; }
        .container { padding: 20px; }
        h1 { text-align: center; color: #007acc; }
        .form-container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 500px; margin: 0 auto; }
        .input-field { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; }
        .button { display: inline-block; width: 100%; background-color: #007acc; color: white; padding: 15px; text-align: center; border-radius: 5px; margin-top: 20px; font-weight: bold; transition: background-color 0.3s ease; }
        .button:hover { background-color: #005fa3; }
        .return-btn-container { text-align: center; margin-top: 20px; }
        .return-button { display: inline-block; background-color: #50C878; color: white; padding: 10px 20px; text-align: center; border-radius: 5px; text-decoration: none; font-weight: bold; transition: background-color 0.3s ease; }
        .return-button:hover { background-color: #5a6268; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Apply for Job: <?php echo htmlspecialchars($job['title']); ?></h1>
        <div class="form-container">
            <form id="applicationForm" method="POST" action="apply.php?job_id=<?php echo $job_id; ?>">
                <label for="applicant_name">Applicant Name:</label>
                <input type="text" name="applicant_name" id="applicant_name" class="input-field" required>

                <label for="applicant_email">Applicant Email:</label>
                <input type="email" name="applicant_email" id="applicant_email" class="input-field" required>

                <label for="qualifications">Qualifications (Please input the Job:)</label>
                <textarea name="qualifications" id="qualifications" class="input-field" rows="4" required></textarea>

                <button type="submit" class="button">Submit Application</button>
            </form>
        </div>

        <div class="return-btn-container">
            <a href="job_listings.php" class="return-button">Return</a>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#applicationForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: 'apply.php?job_id=<?php echo $job_id; ?>',
                    data: formData,
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Application Successful!',
                                text: 'You will be updated soon through email!',
                                showCancelButton: true,
                                confirmButtonText: 'Return to Home Page',
                                cancelButtonText: 'Logout',
                                customClass: {
                                    confirmButton: 'swal-button-return',
                                    cancelButton: 'swal-button-logout'
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'job_listings.php';
                                } else if (result.dismiss === Swal.DismissReason.cancel) {
                                    window.location.href = 'logout.php';
                                }
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
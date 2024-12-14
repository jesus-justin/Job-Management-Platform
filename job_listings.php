<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$search = isset($_GET['search']) ? $_GET['search'] : '';
if ($search) {
    $stmt = $pdo->prepare("SELECT * FROM jobs WHERE title LIKE ?");
    $stmt->execute(['%' . $search . '%']);
} else {
    $stmt = $pdo->prepare("SELECT * FROM jobs");
    $stmt->execute();
}

$jobs = $stmt->fetchAll();

abstract class Job {
    protected $title;
    protected $description;
    protected $location;
    protected $salary;

    public function __construct($title, $description, $location, $salary) {
        $this->title = $title;
        $this->description = $description;
        $this->location = $location;
        $this->salary = $salary;
    }

    public function getJobTitle() {
        return $this->title;
    }

    abstract public function getJobDetails();
}

class FullTimeJob extends Job {
    private $workingHours;

    public function __construct($title, $description, $location, $salary, $workingHours) {
        parent::__construct($title, $description, $location, $salary);
        $this->workingHours = $workingHours;
    }

    public function getJobDetails() {
        return $this->description . "<br><strong>Location:</strong> " . $this->location . 
               "<br><strong>Salary:</strong> PHP " . number_format($this->salary, 2);
    }
}

class PartTimeJob extends Job {
    private $workSchedule;

    public function __construct($title, $description, $location, $salary, $workSchedule) {
        parent::__construct($title, $description, $location, $salary);
        $this->workSchedule = $workSchedule;
    }

    public function getJobDetails() {
        return $this->description . "<br><strong>Location:</strong> " . $this->location . 
               "<br><strong>Salary:</strong> PHP " . number_format($this->salary, 2);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 0 20px;
        }
        h1 {
            font-size: 3rem;
            margin-top: 30px;
            text-align: center;
            color: #fff;
        }
        .search-container {
            width: 100%;
            max-width: 1000px;
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .search-bar {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .job-container {
            width: 100%;
            max-width: 1000px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .job-card {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        h2 {
            font-size: 1.8rem;
            margin-bottom: 10px;
            color: #333;
        }
        p {
            font-size: 1rem;
            margin-bottom: 10px;
            color: #555;
        }
        strong {
            font-weight: bold;
            color: #333;
        }
        .apply-btn {
            display: inline-block;
            margin-top: 15px;
            background-color: #50C878;
            padding: 10px 20px;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .apply-btn:hover {
            background-color: #ff4a3c;
        }
        .home-button {
            position: fixed;
            top: 20px;
            right: 20px;
        }
        .home-button a {
            background-color: #2196f3;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
        }
        .home-button a:hover {
            background-color: #1976d2;
        }
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }
            .job-card {
                padding: 15px;
            }
            .search-container {
                flex-direction: column;
                align-items: stretch;
            }
            .search-bar {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="home-button">
        <a href="#" id="logoutButton">Logout</a>
    </div>

    <div class="container">
        <h1>Job Listings</h1>

        <div class="search-container">
            <form action="job_listings.php" method="GET" style="width: 100%;">
                <input type="text" name="search" class="search-bar" placeholder="Search jobs by title" value="<?php echo htmlspecialchars($search); ?>">
            </form>
        </div>

        <div class="job-container">
            <?php foreach ($jobs as $jobData): ?>
                <?php
                if ($jobData['type'] == 'Part Time') {
                    $workSchedule = isset($jobData['work_schedule']) ? $jobData['work_schedule'] : 'Not specified';
                    $job = new PartTimeJob($jobData['title'], $jobData['description'], $jobData['location'], $jobData['salary'], $workSchedule);
                } else {
                    $job = new FullTimeJob($jobData['title'], $jobData['description'], $jobData['location'], $jobData['salary'], $jobData['working_hours']);
                }
                ?>
                <div class="job-card">
                    <h2><?php echo htmlspecialchars($job->getJobTitle()); ?></h2>
                    <p><?php echo $job->getJobDetails(); ?></p>
                    <p><strong>Required Age:</strong> <?php echo isset($jobData['required_age']) ? htmlspecialchars($jobData['required_age']) . " years" : "Not specified"; ?></p>
                    <p><strong>Years of Experience:</strong> <?php echo isset($jobData['years_of_experience']) ? htmlspecialchars($jobData['years_of_experience']) . " years" : "Not specified"; ?></p>
                    <p><strong>Job Type:</strong> <?php echo htmlspecialchars($jobData['type']); ?></p>
                    <a href="apply.php?job_id=<?php echo $jobData['id']; ?>" class="apply-btn">Apply Now</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('logoutButton').addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure you want to logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Logout',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Logged Out',
                        text: 'You have been successfully logged out!',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = 'logout.php';
                    });
                }
            });
        });
    </script>
</body>
</html>

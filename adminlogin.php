    <?php
    session_start();
    include_once 'db/dbconn.php';

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $logFile = __DIR__ . '/logs/login_debug.log';
    if (!is_dir(dirname($logFile))) mkdir(dirname($logFile), 0755, true);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
        header('Content-Type: application/json; charset=utf-8');

        if (!isset($conn) || !($conn instanceof mysqli)) {
            file_put_contents($logFile, date('[Y-m-d H:i:s] ') . "DB connection missing\n", FILE_APPEND);
            echo json_encode(['success' => false, 'message' => 'Database connection missing']);
            exit;
        }

        $username = trim($_POST['employeeUsername'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($username === '' || $password === '') {
            file_put_contents($logFile, date('[Y-m-d H:i:s] ') . "Missing fields: employeeUsername='{$username}'\n", FILE_APPEND);
            echo json_encode(['success' => false, 'message' => 'Missing username or password']);
            exit;
        }

        $stmt = $conn->prepare("SELECT Employee_ID, Employee_name, Position, passwordHash, employeeUsername FROM employee WHERE employeeUsername = ? LIMIT 1");
        if (!$stmt) {
            file_put_contents($logFile, date('[Y-m-d H:i:s] ') . "Prepare failed: {$conn->error}\n", FILE_APPEND);
            echo json_encode(['success' => false, 'message' => 'Query prepare failed']);
            exit;
        }

        $stmt->bind_param('s', $username);
        if (!$stmt->execute()) {
            file_put_contents($logFile, date('[Y-m-d H:i:s] ') . "Execute failed: {$stmt->error}\n", FILE_APPEND);
            echo json_encode(['success' => false, 'message' => 'Query execution failed']);
            $stmt->close();
            exit;
        }

        $stmt->store_result();
        file_put_contents($logFile, date('[Y-m-d H:i:s] ') . "Query rows={$stmt->num_rows} for employeeUsername='{$username}'\n", FILE_APPEND);

        $valid = false;
        if ($stmt->num_rows === 1) {
            $stmt->bind_result($Employee_ID, $Employee_name, $Position, $passwordHash, $employeeUsername);
            $stmt->fetch();

            $ph_preview = $passwordHash === null ? 'NULL' : substr($passwordHash, 0, 10);
            file_put_contents($logFile, date('[Y-m-d H:i:s] ') . "Fetched id={$Employee_ID} name={$Employee_name} pos={$Position} ph-start={$ph_preview}\n", FILE_APPEND);

            if ($passwordHash && password_verify($password, $passwordHash)) $valid = true;
        }

        $stmt->close();

        if ($valid) {
            $_SESSION['employee_logged_in'] = true;
            $_SESSION['employee_id'] = $Employee_ID;
            $_SESSION['employee_name'] = $Employee_name;
            $_SESSION['employee_position'] = $Position;

            file_put_contents($logFile, date('[Y-m-d H:i:s] ') . "Login success employeeUsername='{$employeeUsername}' id={$Employee_ID}\n", FILE_APPEND);
            echo json_encode(['success' => true, 'redirect' => 'admin_interface.php']);
            exit;
        }

        file_put_contents($logFile, date('[Y-m-d H:i:s] ') . "Login failed for employeeUsername='{$username}'\n", FILE_APPEND);
        echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
        exit;
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Employee Login</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/sweetalert2.min.css">
        <style>
            body { background:#f8f9fa; }
            .center-card { min-height:100vh; display:flex; align-items:center; justify-content:center; }
            body {
    background-image: url("https://www.shutterstock.com/image-photo/image-blur-bicycle-shop-background-600nw-450918220.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    }
        </style>
    </head>
    <body>
    <div class="container center-card">
        <div class="card shadow-sm" style="max-width:420px; width:100%;">
            <div class="card-body text-center">
                <h4 class="card-title mb-3 ">Employee login</h4>
                <p class="text-muted mb-4">Click below to sign in</p>
                <button id="openLogin" class="btn btn-primary w-100"> Sign in <span class="ms-2">&rsaquo;</span></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
    function openLoginModal() {
        Swal.fire({
            title: 'Employee Login',
            html:
                '<div class="mb-2 text-start"><label class="form-label small">Username</label><input id="swal-username" class="form-control" placeholder="Username"></div>' +
                '<div class="mb-2 text-start"><label class="form-label small">Password</label><input id="swal-password" type="password" class="form-control" placeholder="Password"></div>',
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Login',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: 'btn btn-primary ms-2',
                cancelButton: 'btn btn-secondary'
            },
            buttonsStyling: false,
            didOpen: () => {
                const u = document.getElementById('swal-username');
                if (u) u.focus();
            },
            preConfirm: () => {
                const username = document.getElementById('swal-username').value.trim();
                const password = document.getElementById('swal-password').value.trim();

                if (!username || !password) {
                    Swal.fire({ icon: 'error', title: 'Validation error', text: 'Please enter both username and password' });
                    return false;
                }

                const params = new URLSearchParams();
                params.append('employeeUsername', username);
                params.append('password', password);
                params.append('ajax', '1');

                return fetch('adminlogin.php', {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: params.toString()
                })
                .then(resp => {
                    if (!resp.ok) throw new Error('Network response was not ok');
                    return resp.json();
                })
                .catch(() => {
                    Swal.showValidationMessage('Network error');
                });
            }
        }).then((result) => {
            if (result.isConfirmed && result.value) {
                if (result.value.success) {
                    Swal.fire({ icon: 'success', title: 'Logged in', showConfirmButton: false, timer: 800 })
                        .then(() => { window.location.href = result.value.redirect || 'admin_interface.php'; });
                } else {
                    Swal.fire({ icon: 'error', title: 'Login failed', text: result.value.message || 'Invalid credentials' })
                        .then(() => openLoginModal());
                }
            }
        });
    }

    document.getElementById('openLogin').addEventListener('click', openLoginModal);
    </script>
    </body>
    </html>
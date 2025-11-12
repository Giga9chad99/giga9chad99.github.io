<?php
session_start();

$host = 'localhost';
$dbname = 'zadanie_web';
$username = 'root';
$password = '';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

$error = '';

if ($_POST) {
    $email = $_POST['email'];
    $haslo = $_POST['password'];
    if (empty($email) || empty($haslo)) {
        $error = "Uzupełnij wszystkie pola";
    } else {
        $sql = "SELECT * FROM dane_uzytkownika WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user) {
            if ($haslo === $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                header('Location: dashboard.php');
                exit;
            } else {
                $error = "Niepoprawne hasło";
            }
        } else {
            $error = "Brak użytkownika w bazie danych";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo-section">
                <h1>Logowanie</h1>
                <p>Zaloguj się, aby kontynuować szkolenie</p>
            </div>
            <div class="oauth-section">
                <button class="oauth-btn google-btn">
                    <span class="btn-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                    </span>
                    Zaloguj się przez Google
                </button>
                <button class="oauth-btn microsoft-btn">
                    <span class="btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                             <g>
                                 <path fill="none" d="M0 0h24v24H0z"/> <path d="M11.5 3v8.5H3V3h8.5zm0 18H3v-8.5h8.5V21zm1-18H21v8.5h-8.5V3zm8.5 9.5V21h-8.5v-8.5H21z"/> </g> 
                        </svg>
                    </span>
                    Zaloguj się przez Microsoft
                </button>
            </div>
            <div class="divider">
                <span>lub</span>
            </div>
             <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <form class="login-form" method="POST">
                <div class="form-group">
                    <label for="email">Adres email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Hasło</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-options">
                    <label class="checkbox">
                        <input type="checkbox" name="remember">
                        <span>Zapamiętaj mnie</span>
                    </label>
                    <a href="#" class="forgot-password">Zapomniałeś hasła?</a>
                </div>
                <button type="submit" class="login-btn">Zaloguj się</button>
            </form>
            <div class="register-section">
                <p>Nie masz konta? <a href="register.html" class="register-link">Zarejestruj się</a></p>
            </div>
        </div>
    </div>
</body>
</html>
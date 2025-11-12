<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$host = 'localhost';
$dbname = 'zadanie_web';
$username = 'root';
$password = '';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

$sql = "SELECT imie, nazwisko FROM dane_uzytkownika WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel użytkownika</title>
    <link rel="stylesheet" href="styles/dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <div class="header-content">
                <h1>Panel użytkownika</h1>
                <div class="user-menu">
                    <span class="user-name">Witaj, <?php echo htmlspecialchars($user['imie']); ?></span>
                    <div class="progress-info">
                        <span>Postęp: 0%</span>
                    </div>
                    <form method="POST" style="display: inline;">
                        <button type="submit" name="logout" class="logout-btn">Wyloguj</button>
                    </form>
                </div>
            </div>
        </header>

        <div class="dashboard-content">
            <div class="welcome-section">
                <h2>Szkolenie z Cyberbezpieczeństwa</h2>
                <p>Przejdź przez wszystkie moduły i zdobądź certyfikat ukończenia szkolenia.</p>
                
                <div class="progress-container">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 0%"></div>
                    </div>
                    <div class="progress-stats">
                        <span>0/6 modułów ukończonych</span>
                        <span>0% ogólnego postępu</span>
                    </div>
                </div>
            </div>

            <div class="modules-grid">
                <div class="module-card available">
                    <div class="module-header">
                        <span class="module-number">01</span>
                        <span class="module-status available">● Dostępny</span>
                    </div>
                    <h3 class="module-title">Phishing i Spear-Phishing</h3>
                    <p class="module-description">
                        Naucz się rozpoznawać podejrzane wiadomości email i chronić przed atakami phishingowymi.
                    </p>
                    <div class="module-stats">
                        <div class="stat">
                            <span class="stat-value">15 min</span>
                            <span class="stat-label">Szacowany czas</span>
                        </div>
                        <div class="stat">
                            <span class="stat-value">3 lekcje</span>
                            <span class="stat-label">Liczba lekcji</span>
                        </div>
                    </div>
                    <a href="module-1.php" class="module-btn start-btn">Rozpocznij moduł</a>
                </div>

                <div class="module-card locked">
                    <div class="module-header">
                        <span class="module-number">02</span>
                        <span class="module-status locked">🔒 Zablokowany</span>
                    </div>
                    <h3 class="module-title">Hasła i MFA</h3>
                    <p class="module-description">
                        Dowiedz się jak tworzyć silne hasła i korzystać z uwierzytelniania wieloskładnikowego.
                    </p>
                    <div class="module-requirements">
                        <span>Wymagane ukończenie modułu 1</span>
                    </div>
                    <button class="module-btn disabled-btn" disabled>Rozpocznij moduł</button>
                </div>

                <div class="module-card locked">
                    <div class="module-header">
                        <span class="module-number">03</span>
                        <span class="module-status locked">🔒 Zablokowany</span>
                    </div>
                    <h3 class="module-title">Bezpieczna praca zdalna</h3>
                    <p class="module-description">
                        Zasady bezpiecznego korzystania z sieci firmowej poza biurem i ochrona danych.
                    </p>
                    <div class="module-requirements">
                        <span>Wymagane ukończenie modułu 2</span>
                    </div>
                    <button class="module-btn disabled-btn" disabled>Rozpocznij moduł</button>
                </div>

                <div class="module-card locked">
                    <div class="module-header">
                        <span class="module-number">04</span>
                        <span class="module-status locked">🔒 Zablokowany</span>
                    </div>
                    <h3 class="module-title">Ochrona danych/RODO</h3>
                    <p class="module-description">
                        Zrozumienie zasad RODO i właściwego przetwarzania danych osobowych.
                    </p>
                    <div class="module-requirements">
                        <span>Wymagane ukończenie modułu 3</span>
                    </div>
                    <button class="module-btn disabled-btn" disabled>Rozpocznij moduł</button>
                </div>

                <div class="module-card locked">
                    <div class="module-header">
                        <span class="module-number">05</span>
                        <span class="module-status locked">🔒 Zablokowany</span>
                    </div>
                    <h3 class="module-title">USB i urządzenia zewnętrzne</h3>
                    <p class="module-description">
                        Bezpieczne korzystanie z urządzeń przenośnych i zabezpieczenie przed zagrożeniami.
                    </p>
                    <div class="module-requirements">
                        <span>Wymagane ukończenie modułu 4</span>
                    </div>
                    <button class="module-btn disabled-btn" disabled>Rozpocznij moduł</button>
                </div>

                <div class="module-card locked">
                    <div class="module-header">
                        <span class="module-number">06</span>
                        <span class="module-status locked">🔒 Zablokowany</span>
                    </div>
                    <h3 class="module-title">Zachowanie w razie incydentu</h3>
                    <p class="module-description">
                        Procedury postępowania w przypadku wykrycia naruszenia bezpieczeństwa.
                    </p>
                    <div class="module-requirements">
                        <span>Wymagane ukończenie modułu 5</span>
                    </div>
                    <button class="module-btn disabled-btn" disabled>Rozpocznij moduł</button>
                </div>
            </div>

            <div class="final-test-section">
                <div class="test-card">
                    <h3>Test Końcowy</h3>
                    <p>Sprawdź swoją wiedzę w finalnym teście i zdobądź certyfikat</p>
                    <div class="test-info">
                        <div class="test-stat">
                            <strong>20 pytań</strong>
                            <span>Losowanych z puli 60</span>
                        </div>
                        <div class="test-stat">
                            <strong>80%</strong>
                            <span>Próg zaliczenia</span>
                        </div>
                        <div class="test-stat">
                            <strong>30 min</strong>
                            <span>Limit czasu</span>
                        </div>
                    </div>
                    <button class="test-btn" disabled>Test dostępny po ukończeniu wszystkich modułów</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
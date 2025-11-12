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

$sql = "SELECT imie FROM dane_uzytkownika WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

$sql = "SELECT * FROM user_progress WHERE user_id = ? AND module_id = 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user_id']]);
$progress = $stmt->fetch();

if (isset($_POST['complete_module'])) {
    if (!$progress) {
        $sql = "INSERT INTO user_progress (user_id, module_id, completed) VALUES (?, 1, 1)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_SESSION['user_id']]);
    }
    header('Location: dashboard.php');
    exit;
}

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
    <title>Moduł 1 - Phishing i Spear-Phishing</title>
    <link rel="stylesheet" href="styles/module.css">
</head>
<body>
    <div class="module-container">
        <header class="module-header">
            <div class="header-content">
                <h1>Moduł 1: Phishing i Spear-Phishing</h1>
                <div class="user-menu">
                    <span class="user-name">Witaj, <?php echo htmlspecialchars($user['imie']); ?></span>
                    <form method="POST" style="display: inline;">
                        <button type="submit" name="logout" class="logout-btn">Wyloguj</button>
                    </form>
                </div>
            </div>
        </header>

        <div class="module-content">
            <div class="lesson-section">
                <h2>Lekcja 1: Czym jest phishing?</h2>
                <div class="lesson-content">
                    <p>Phishing to metoda oszustwa, w której przestępcy wysyłają fałszywe wiadomości email, aby wyłudzić poufne informacje.</p>
                    <ul>
                        <li>Fałszywe linki do logowania</li>
                        <li>Prośby o podanie danych osobowych</li>
                        <li>Pilne komunikaty wymagające natychmiastowej reakcji</li>
                    </ul>
                </div>
            </div>

            <div class="lesson-section">
                <h2>Lekcja 2: Jak rozpoznać phishing?</h2>
                <div class="lesson-content">
                    <p>Zwracaj uwagę na następujące elementy:</p>
                    <ul>
                        <li>Błędy gramatyczne i ortograficzne</li>
                        <li>Nieprawidłowy adres nadawcy</li>
                        <li>Generyczne powitania zamiast personalizacji</li>
                        <li>Podejrzane załączniki</li>
                    </ul>
                </div>
            </div>

            <div class="lesson-section">
                <h2>Lekcja 3: Przykłady phishingu</h2>
                <div class="lesson-content">
                    <p>Oto typowe przykłady wiadomości phishingowych:</p>
                    <div class="examples">
                        <div class="example bad">
                            <strong>ZŁY PRZYKŁAD:</strong>
                            <p>"Drogi użytkowniku, Twoje konto zostało zablokowane. Kliknij tutaj, aby je odblokować."</p>
                        </div>
                        <div class="example good">
                            <strong>DOBRY PRZYKŁAD:</strong>
                            <p>"Witaj Jan, zauważyliśmy nietypową aktywność na Twoim koncie. Zaloguj się przez naszą oficjalną stronę."</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="quiz-section">
                <h2>Sprawdź swoją wiedzę</h2>
                <form method="POST" class="quiz-form">
                    <div class="quiz-question">
                        <p><strong>1. Która wiadomość jest podejrzana?</strong></p>
                        <label>
                            <input type="radio" name="q1" value="a"> Wiadomość z błędami gramatycznymi
                        </label>
                        <label>
                            <input type="radio" name="q1" value="b"> Wiadomość od znanego nadawcy
                        </label>
                    </div>

                    <div class="quiz-question">
                        <p><strong>2. Co zrobić z podejrzanym emailem?</strong></p>
                        <label>
                            <input type="radio" name="q2" value="a"> Kliknąć w link, żeby sprawdzić
                        </label>
                        <label>
                            <input type="radio" name="q2" value="b"> Zgłosić do działu IT
                        </label>
                    </div>

                    <div class="module-actions">
                        <button type="submit" name="complete_module" class="complete-btn">Zakończ moduł</button>
                        <a href="dashboard.php" class="back-btn">Powrót do dashboard</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
require_once '../system/confing.php';

header('Content-Type: text/plain; charset=utf-8');

$loginInfo = $_POST['loginInfo'] ?? '';
$password = $_POST['password'] ?? '';

echo "Habe folgende Daten erhalten, LoginInfo:
$loginInfo, Passwort: {$password}";

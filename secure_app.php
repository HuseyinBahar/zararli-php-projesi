<?php
session_start();

// Mesaj verilerini saklayacağımız dosya
$messagesFile = 'messages.json';

// Mesajları yükle
function loadMessages() {
    global $messagesFile;
    if (file_exists($messagesFile)) {
        $content = file_get_contents($messagesFile);
        return json_decode($content, true) ?: [];
    }
    return [];
}

// Mesajları kaydet
function saveMessages($messages) {
    global $messagesFile;
    file_put_contents($messagesFile, json_encode($messages, JSON_PRETTY_PRINT));
}

// Mesaj ekleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['message'])) {
    $messages = loadMessages();
    
    $newMessage = [
        // GÜVENLİ: Kullanıcı girdileri filtreleniyor ve temizleniyor
        'name' => htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8'),
        'message' => htmlspecialchars(trim($_POST['message']), ENT_QUOTES, 'UTF-8'),
        'timestamp' => date('Y-m-d H:i:s')
    ];
    
    $messages[] = $newMessage;
    saveMessages($messages);
    
    // Sayfayı yenile
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$messages = loadMessages();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Güvenli Mesaj Panosu</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .message { border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; border-radius: 5px; }
        form { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; }
        input, textarea { width: 100%; padding: 8px; margin-bottom: 10px; }
        button { padding: 8px 16px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #45a049; }
    </style>
</head>
<body>
    <h1>Güvenli Mesaj Panosu</h1>
    
    <form method="post" action="">
        <label for="name">İsminiz:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="message">Mesajınız:</label>
        <textarea id="message" name="message" rows="4" required></textarea>
        
        <button type="submit">Mesaj Gönder</button>
    </form>
    
    <h2>Mesajlar</h2>
    <?php if (!empty($messages)): ?>
        <?php foreach ($messages as $msg): ?>
            <div class="message">
                <h3><?php echo $msg['name']; ?> diyor ki:</h3>
                <p><?php echo $msg['message']; ?></p>
                <small><?php echo $msg['timestamp']; ?></small>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Henüz mesaj bulunmuyor.</p>
    <?php endif; ?>
</body>
</html>
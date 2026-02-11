<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // データの受け取りとサニタイズ（無害化）
    $name    = htmlspecialchars($_POST['name']    ?? '', ENT_QUOTES, 'UTF-8');
    $email   = htmlspecialchars($_POST['email']   ?? '', ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars($_POST['message'] ?? '', ENT_QUOTES, 'UTF-8');

    // 送信先設定
    $to      = "your-address@example.com"; // ここを自分のメールに変更
    $subject = "【重要】Webサイトからのお問い合わせ";
    
    // メールの本文作成
    $mailBody = "以下の内容でお問い合わせが届きました。\n\n";
    $mailBody .= "名前: $name\n";
    $mailBody .= "メール: $email\n";
    $mailBody .= "内容:\n$message\n";

    // ヘッダー（送信元など）
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8";

    // 送信実行
    if (mail($to, $subject, $mailBody, $headers)) {
        echo "<h1>送信完了</h1><p>お問い合わせありがとうございました。</p><a href='index.html'>戻る</a>";
    } else {
        echo "送信に失敗しました。サーバーの設定を確認してください。";
    }
} else {
    // 直接アクセスされた場合はリダイレクト
    header("Location: index.html");
    exit;
}
?>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');

$nome = $_POST['nome'];
$assunto = $_POST['assunto'];
$mensagem = $_POST['mensagem'];
$destinatario = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

if (!$destinatario) {
    die("E-mail inválido");
}

$mail = new PHPMailer(true);
$meu_mail = new PHPMailer(true);
try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'walmonn.eduardo.tds2023@gmail.com';
    $mail->Password   = 'hnac slpn axmz fvxm';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('walmonn.eduardo.tds2023@gmail.com');
    $mail->addAddress($destinatario);

    $mail->isHTML(true);
    $mail->Subject = "Mensagem enviada com sucesso, " . $nome . "<br>A equipe de Sergio entrara em contato o mais rapido possível.";
    $mail->Body    = "Obrigada pelo contato! Para mais informacoes, nos chame no Instagram: @serjaoboiadeirooficial";
    $mail->AltBody = "Obrigada pelo contato! Para mais informacoes, nos chame no Instagram: @serjaoboiadeirooficial";
    
    $mail->send();
    echo 'E-mail enviado com sucesso!';
    header("Location: contato.html");
} catch (Exception $e) {
    echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}
try {
    $meu_mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $meu_mail->isSMTP();
    $meu_mail->Host       = 'smtp.gmail.com';
    $meu_mail->SMTPAuth   = true;
    $meu_mail->Username   = 'walmonn.eduardo.tds2023@gmail.com';
    $meu_mail->Password   = 'hnac slpn axmz fvxm';
    $meu_mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $meu_mail->Port       = 587;

    $meu_mail->setFrom('walmonn.eduardo.tds2023@gmail.com');
    $meu_mail->addAddress('boiadeiroserjao49@gmail.com');

    $meu_mail->isHTML(true);
    $meu_mail->Subject = $nome . ", enviou uma requisicao de contato para Serjao";
    $meu_mail->Body    = "Assunto: " . $assunto . "<br>Mensagem: " . $mensagem;
    $meu_mail->AltBody = "Assunto: " . $assunto . "Mensagem: " . $mensagem;

    $meu_mail->send();
    echo 'E-mail enviado com sucesso!';
    header("Location: contato.html");
} catch (Exception $e) {
    echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}
?>

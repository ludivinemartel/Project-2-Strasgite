<?php

namespace App\Controller;

use PHPMailer\PHPMailer\PHPMailer;

class ContactController extends AbstractController
{
    /**
     * Display contact Page
     */
    public function index(): string
    {
        $confirm = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $confirm = "Merci pour votre message, $prenom $nom. Nous avons
            bien reçu votre demande de contact et nous vous répondrons
             dans les plus brefs délais.";
            // Configuration de PHPMailer
            $phpmailer = new PHPMailer();
            $phpmailer->isSMTP();
            $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 2525;
            $phpmailer->Username = 'f6835da58bb65d';
            $phpmailer->Password = 'dd2a09e5c62c6e';
            // Ajout des informations du destinataire, le sujet et le contenu de l'e-mail
            $phpmailer->setFrom($email, $nom);
            $phpmailer->addAddress($_POST['email'], $_POST['prenom']);
            $phpmailer->Subject = 'confirmation de contact';
            $phpmailer->Body = "Merci pour votre message, $prenom $nom. Nous avons
            bien reçu votre demande de contact et nous vous répondrons
             dans les plus brefs délais.";//'Contenu de l\'e-mail';
            // Envoi de l'e-mail
            if ($phpmailer->send()) {
                header('Location: contact?confirm=' . urlencode($confirm));
                exit();
            } else {
                $confirm =  'Erreur lors de l\'envoi de l\'e-mail : ' . $phpmailer->ErrorInfo;
                header('Location: contact?confirm=' . urlencode($confirm));
                exit();
            }
        }
        return $this->twig->render('contact/contact.html.twig', [
            'confirm' => $confirm]);
    }
}

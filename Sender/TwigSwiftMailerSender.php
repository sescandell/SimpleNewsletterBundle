<?php
namespace Sescandell\SimpleNewsletterBundle\Sender;

use Sescandell\SimpleNewsletterBundle\Sender\SenderInterface;
use Sescandell\SimpleNewsletterBundle\Model\NewsletterInterface;
use Sescandell\SimpleNewsletterBundle\Model\RecipientInterface;

class TwigSwiftMailerSender implements SenderInterface
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @var string
     */
    protected $senderMail;

    /**
     * @var string
     */
    protected $senderFullname;

    /**
     * @param string $senderMail
     * @param string $senderFullname
     */
    public function __construct($senderMail, $senderFullname)
    {
        $this->senderMail = $senderMail;
        $this->senderFullname = $senderFullname;
    }

    /**
     * @param MailerInterface $mailer
     */
    public function setMailer(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param \Twig_Environment $twig
     */
    public function setTwigEnvironment(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * (non-PHPdoc)
     * @see \Sescandell\SimpleNewsletterBundle\Sender\SenderInterface::send()
     */
    public function send(NewsletterInterface $newsletter, $recipients)
    {
        $template = $this->twig->loadTemplate('SescandellSimpleNewsletterBundle::newsletter.html.twig');
        if ($newsletter->hasPlaceholders()) {
            foreach ((array) $recipients as $recipient) {
                $viewParameters = array(
                    'recipient'  => $recipient,
                    'newsletter' => $newsletter
                );
                $subject = $template->renderBlock('subject', $viewParameters);
                $textBody = $template->renderBlock('textBody', $viewParameters);
                $htmlBody = $template->renderBlock('htmlBody', $viewParameters);

                $this->sendMessage($recipient, $subject, $textBody, $htmlBody);
            }
        } else {
            $viewParameters = array(
                    'newsletter' => $newsletter
            );
            $subject = $template->renderBlock('subject', $viewParameters);
            $textBody = $template->renderBlock('textBody', $viewParameters);
            $htmlBody = $template->renderBlock('htmlBody', $viewParameters);

            $this->sendMessage($recipients, $subject, $textBody, $htmlBody);
        }
    }

    /**
     * @param array|RecipientInterface $recipients
     * @param string                   $subject
     * @param string                   $text
     * @param string                   $html
     */
    protected function sendMessage($recipients, $subject, $text, $html = '')
    {
        if (is_array($recipients)) {
            // TODO: manage if spool memory, we have no choice and must recreate the
            // message for each recipient
            // if SPOOL via files : same message could be used once
            foreach ($recipients as $recipient) {
                $this->mailer->send($this->createMessage($subject, $text, $html)->setTo($recipient->getDestination(), $recipient->getFullname()));
            }
        } elseif ($recipients instanceof RecipientInterface) {
            $this->mailer->send($this->createMessage($subject, $text, $html)->setTo($recipients->getDestination(), $recipients->getFullname()));
        } else {
            throw new \InvalidArgumentException('recipients must be an array or RecipientInterface object');
        }
    }
    
    /**
     * 
     * @param string $subject
     * @param string $text
     * @param string $html
     */
    protected function createMessage($subject, $text, $html)
    {
        $message = $this->mailer->createMessage();
        $message
            ->setSubject($subject)
            ->setFrom($this->senderMail, $this->senderFullname);

        if (!empty($html)) {
            $message->setBody($html, 'text/html')
                ->addPart($text, 'text/plain');
        } else {
            $message->setBody($text);
        }
        
        return $message;
    }

}

<?php
namespace Sescandell\SimpleNewsletterBundle\Sender;

use Sescandell\SimpleNewsletterBundle\Model\NewsletterInterface;
use Sescandell\SimpleNewsletterBundle\Model\NewsletterManagerInterface;
use Sescandell\SimpleNewsletterBundle\Model\RecipientInterface;
use Sescandell\SimpleNewsletterBundle\Model\RecipientManagerInterface;

class SenderHandler
{
    /**
     * @var NewsletterManagerInterface
     */
    protected $newsletterManager;

    /**
     * @var RecipientManagetInterface
     */
    protected $recipientManager;

    /**
     * @var SenderInterface
     */
    protected $sender;
    
    /**
     * @var SenderInterface
     */
    protected $senderTo = null;

    /**
     * @param NewsletterManagerInterface $newsletterManager
     */
    public function setNewsletterManager(NewsletterManagerInterface $newsletterManager)
    {
        $this->newsletterManager = $newsletterManager;
    }

    /**
     * @param RecipientManagerInterface $recipientManager
     */
    public function setRecipientManager(RecipientManagerInterface $recipientManager)
    {
        $this->recipientManager  = $recipientManager;
    }

    /**
     * @param SenderInterface $transport
     */
    public function setSender(SenderInterface $sender)
    {
        $this->sender = $sender;
    }
    
    /**
     * @param SenderInterface $sender
     */
    public function setSenderTo(SenderInterface $sender = null)
    {
        $this->senderTo = $sender;
    }

    /**
     * Send the newsletter to all recipients.
     * sentAt is changed to now
     *
     * @param NewsletterInterface $newsletter
     */
    public function send(NewsletterInterface $newsletter)
    {
        $recipients = $this->recipientManager->getRecipients($newsletter);
        $this->sender->send($newsletter, $recipients);

        // TODO: Use an event?
        $this->newsletterManager->sent($newsletter, $recipients);
    }

    /**
     * Send the newsletter to $recipient (using placeholders if any)
     * sentAt is not changed
     *
     * @param NewsletterInterface $newsletter
     * @param RecipientInterface  $recipient
     */
    public function sendTo(NewsletterInterface $newsletter, RecipientInterface $recipient)
    {
        if (is_null($this->senderTo)) {
            $this->sender->send($newsletter, $recipient);
        } else {
            $this->senderTo->send($newsletter, $recipient);
        }
    }
}

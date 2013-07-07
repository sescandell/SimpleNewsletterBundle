<?php
namespace Sescandell\SimpleNewsletterBundle\Sender;

use Sescandell\SimpleNewsletterBundle\Model\NewsletterInterface;

interface SenderInterface
{
    /**
     * Send the newsletter $newsletter to $recipients
     *
     * @param NewsletterInterface      $newsletter
     * @param array|RecipientInterface $recipients
     */
    public function send(NewsletterInterface $newsletter, $recipients);
}

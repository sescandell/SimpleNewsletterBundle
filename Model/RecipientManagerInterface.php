<?php
namespace Sescandell\SimpleNewsletterBundle\Model;

interface RecipientManagerInterface
{
    /**
     * Get recipients for newsletter $newsletter
     * Must return an array of RecipientInterface
     *
     * @param NewsletterInterface $newsletter
     * @return array of RecipientInterface
     */
    public function getRecipients(NewsletterInterface $newsletter);
}

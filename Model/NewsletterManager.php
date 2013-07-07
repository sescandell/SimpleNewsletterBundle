<?php
namespace Sescandell\SimpleNewsletterBundle\Model;

use Sescandell\SimpleNewsletterBundle\Model\NewsletterInterface;

/**
 *
 */
abstract class NewsletterManager implements NewsletterManagerInterface
{
    /**
     * Create a new newsletter
     *
     * @return NewsletterInterface
     */
    public function createNewsletter()
    {
        $class = $this->getClass();

        return new $class;
    }

    /**
     * (non-PHPdoc)
     * @see \Sescandell\SimpleNewsletterBundle\Model\NewsletterManagerInterface::sent()
     */
    public function sent(NewsletterInterface $newsletter, array $recipients)
    {
        $newsletter->setSentAt(new \DateTime());
        $this->updateNewsletter($newsletter);
    }
}

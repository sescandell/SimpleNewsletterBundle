<?php
namespace Sescandell\SimpleNewsletterBundle\Model;

interface NewsletterManagerInterface
{
    /**
     * Create a new newsletter
     *
     * @return NewsletterInterface
     */
    public function createNewsletter();

    /**
     * Update newsletter $newsletter
     *
     * @param NewsletterInterface $newsletter
     *
     * @return void
     */
    public function updateNewsletter(NewsletterInterface $newsletter);

    /**
     * Delete newsletter $newsletter
     *
     * @param NewsletterInterface $newsletter
     *
     * @return void
     */
    public function deleteNewsletter(NewsletterInterface $newsletter);

    /**
     * Mark as sent the $newsletter
     *
     * @param NewsletterInterface $newsletter
     */
    public function sent(NewsletterInterface $newsletter, array $recipients);

    /**
     * Finds one newsletter by the given criteria.
     *
     * @param array $criteria
     *
     * @return NewsletterInterface
     */
    public function findNewsletterBy(array $criteria);

    /**
     * Returns a collection with all newsletter instances.
     *
     * @return \Traversable
     */
    public function findNewsletters();

    /**
     * Returns the newsletter's fully qualified class name.
     *
     * @return string
     */
    protected function getClass();
}

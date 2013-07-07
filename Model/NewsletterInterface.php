<?php
namespace Sescandell\SimpleNewsletterBundle\Model;

interface NewsletterInterface
{
    /**
     * Get subject (without any configured prefix)
     *
     * @return string
     */
    public function getSubject();

    /**
     * Set subject to $subject
     *
     * @param string $subject
     */
    public function setSubject($subject);

    /**
     * Get content
     *
     * @return string
     */
    public function getContent();

    /**
     * Set content to $content
     *
     * @param string $content
     */
    public function setContent($content);

    /**
     * Check if content or subject have placeholders
     *
     * @return boolean
     */
    public function hasPlaceholders();

    /**
     * Get sent date if any, null otherwise
     *
     * @return DateTime | null
     */
    public function getSentAt();

    /**
     * Set sent date
     *
     * @param \DateTime $sentAt
     */
    public function setSentAt(\DateTime $sentAt);

    /**
     * Get create date
     *
     * @return DateTime
     */
    public function getCreatedAt();

    /**
     * Set create date at $createdAt
     *
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * Get update date
     *
     * @return DateTime
     */
    public function getUpdatedAt();

    /**
     * Set update date at $updatedAt
     *
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt);
}

<?php
namespace Sescandell\SimpleNewsletterBundle\Model;

class Newsletter implements NewsletterInterface
{
    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var boolean
     */
    protected $placeholders = false;

    /**
     * @var \DateTime
     */
    protected $sentAt = null;

    /**
     * @var \DateTime
     */
    protected $createdAt = null;

    /**
     * @var \DateTime
     */
    protected $updatedAt = null;

    /**
     * Default constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * Get subject (without any configured prefix)
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set subject to $subject
     *
     * @param  string                                   $subject
     * @return \SimpleNewsletterBundle\Model\Newsletter
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set content to $content
     *
     * @param  string                                   $content
     * @return \SimpleNewsletterBundle\Model\Newsletter
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Define placeholders to $placeholders
     *
     * @param  boolean                                             $placeholders
     * @return \Sescandell\SimpleNewsletterBundle\Model\Newsletter
     */
    public function setPlaceholders($placeholders = true)
    {
        $this->placeholders = $placeholders;

        return $this;
    }

    /**
     * (non-PHPdoc)
     * @see \Sescandell\SimpleNewsletterBundle\Model\NewsletterInterface::hasPlaceholders()
     */
    public function hasPlaceholders()
    {
        return $this->placeholders;
    }

    /**
     * Get sent date if any, null otherwise
     *
     * @return DateTime | null
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }

    /**
     * Set sent date
     *
     * @param  \DateTime                                $sentAt
     * @return \SimpleNewsletterBundle\Model\Newsletter
     */
    public function setSentAt(\DateTime $sentAt)
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    /**
     * Get create date
     *
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set create date at $createdAt
     *
     * @param  \DateTime                                $createdAt
     * @return \SimpleNewsletterBundle\Model\Newsletter
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get update date
     *
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set update date at $updatedAt
     *
     * @param  \DateTime                                $updatedAt
     * @return \SimpleNewsletterBundle\Model\Newsletter
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}

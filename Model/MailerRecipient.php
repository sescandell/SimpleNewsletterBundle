<?php
namespace Sescandell\SimpleNewsletterBundle\Model;

use Sescandell\SimpleNewsletterBundle\Model\RecipientInterface;

class MailerRecipient implements RecipientInterface
{
    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $fullname;

    /**
     * @param string $fullname
     * @param string $email
     *
     * @return RecipientInterface
     */
    public static function create($fullname, $email)
    {
        $recipient = new static();

        // TODO: validate email format?

        $recipient->email = $email;
        $recipient->fullname = $fullname;

        return $recipient;
    }

    /**
     * (non-PHPdoc)
     * @see \Sescandell\SimpleNewsletterBundle\Model\RecipientInterface::getFullname()
     */
    public function getFullname()
    {
        return $this->fullname;
    }
    
    /**
     * 
     * @param string $fullname
     * @return \Sescandell\SimpleNewsletterBundle\Model\MailerRecipient
     */
    public function setFullname($fullname)
    {
       $this->fullname = $fullname;

       return $this;
    }

    /**
     * (non-PHPdoc)
     * @see \Sescandell\SimpleNewsletterBundle\Model\RecipientInterface::getDestination()
     */
    public function getDestination()
    {
        return $this->email;
    }
    
    /**
     * 
     * @param string $destination
     * @return \Sescandell\SimpleNewsletterBundle\Model\MailerRecipient
     */
    public function setDestination($destination)
    {
        $this->email = $destination;
        
        return $this;
    }

}

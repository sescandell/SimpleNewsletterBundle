<?php
namespace Sescandell\SimpleNewsletterBundle\Model;

interface RecipientInterface
{
    /**
     * Get the recipient's destination
     *
     * return string
     */
    public function getDestination();
    
    /**
     * Set recipient's destination
     * 
     * @param string $destination
     * @return RecipientInterface
     */
    public function setDestination($destination);

    /**
     * Get the recipient's fullname
     *
     * @return string
     */
    public function getFullname();
    
    /**
     * Set recipient's fullname
     * 
     * @param string $fullname
     * @return RecipientInterface
     */
    public function setFullname($fullname);
}

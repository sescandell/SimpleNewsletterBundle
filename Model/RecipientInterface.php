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
     * Get the recipient's fullname
     *
     * @return string
     */
    public function getFullname();
}

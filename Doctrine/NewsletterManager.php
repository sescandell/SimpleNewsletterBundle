<?php
namespace Sescandell\SimpleNewsletterBundle\Doctrine;


use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\ObjectRepository;
use Sescandell\SimpleNewsletterBundle\Model\NewsletterInterface;
use Sescandell\SimpleNewsletterBundle\Model\NewsletterManager as BaseNewsletterManager;

class NewsletterManager extends BaseNewsletterManager
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var ObjectRepository
     */
    protected $objectRepository;

    /**
     * Default constructor
     *
     * @param ObjectManager $om
     * @param string        $class
     */
    public function __construct(ObjectManager $om, $class)
    {
        $this->objectManager = $om;
        $this->objectRepository = $om->getRepository($class);

        $metadata = $om->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    /**
     * (non-PHPdoc)
     * @see \Sescandell\SimpleNewsletterBundle\Model\NewsletterManagerInterface::getClass()
     */
    protected function getClass()
    {
        return $this->class;
    }

    /**
     * (non-PHPdoc)
     * @see \Sescandell\SimpleNewsletterBundle\Model\NewsletterManagerInterface::updateNewsletter()
     */
    public function updateNewsletter(NewsletterInterface $newsletter, $andFlush = true)
    {
        $this->objectManager->persist($newsletter);
        if ($andFlush) {
            $this->objectManager->flush($newsletter);
        }
    }

    /**
     * (non-PHPdoc)
     * @see \Sescandell\SimpleNewsletterBundle\Model\NewsletterManagerInterface::deleteNewsletter()
     */
    public function deleteNewsletter(NewsletterInterface $newsletter)
    {
        $this->objectManager->remove($newsletter);
        $this->objectManager->flush();
    }

    /**
     * (non-PHPdoc)
     * @see \Sescandell\SimpleNewsletterBundle\Model\NewsletterManagerInterface::findNewsletterBy()
     */
    public function findNewsletterBy(array $criteria)
    {
        return $this->objectRepository->findOneBy($criteria);
    }

    /**
     * (non-PHPdoc)
     * @see \Sescandell\SimpleNewsletterBundle\Model\NewsletterManagerInterface::findNewsletters()
     */
    public function findNewsletters()
    {
        return $this->objectRepository->findAll();
    }


}

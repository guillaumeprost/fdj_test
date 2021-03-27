<?php
namespace App\Entity;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Draw
{
    /**
     * @var \DateTime
     */
    private $drawnAt;

    /**
     * @var array
     */
    private $results;

    /**
     * @var array
     */
    private $addons;

    /**
     * @return \DateTime
     */
    public function getDrawnAt()
    {
        return $this->drawnAt;
    }

    /**
     * @param \DateTimeInterface $drawnAt
     * @return Draw
     */
    public function setDrawnAt($drawnAt): Draw
    {
        if(is_string($drawnAt)) {
            $this->drawnAt = \DateTimeImmutable::createFromFormat(\DateTimeImmutable::ISO8601, $drawnAt);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param array $results
     * @return Draw
     */
    public function setResults(array $results): Draw
    {
        $this->results = $results;
        return $this;
    }

    /**
     * @return array
     */
    public function getAddons(): array
    {
        return $this->addons;
    }

    /**
     * @param array $addons
     * @return Draw
     */
    public function setAddons(array $addons): Draw
    {
        $this->addons = $addons;
        return $this;
    }
}
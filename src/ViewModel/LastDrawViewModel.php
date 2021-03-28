<?php

namespace App\ViewModel;

use App\Entity\Draw;

/**
 * Class LastDrawViewModel
 *
 * Utilisation d'un ViewModel pour décharger les données envoyées au front
 */
class LastDrawViewModel
{
    /** @var array  */
    public $draws = [];

    /** @var string|null */
    public $error = null;

    /**
     * @param array|Draw[] $draws
     * @return $this
     */
    public function addDraws(array $draws): self
    {
        /** @var Draw $draw */
        foreach ($draws as $draw) {
            $vmDraw = [];
            $vmDraw['drawnAt'] = $draw->getDrawnAt()->format('d/m/Y'); //Nécessiterais une traduction
            foreach ($draw->getResults() as $result) {
                $vmResult = [];
                $vmResult['value'] = $result['value'];
                $vmResult['type'] = $result['type'];
                $vmDraw['results'][] = $vmResult;
            }
            foreach ($draw->getAddons() as $addon) {
                $vmAddon = [];
                $vmAddon['addon'] = $addon['value'];
                $vmDraw['addons'] = $vmAddon;
            }
            $this->draws[] = $vmDraw;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getDraws(): array
    {
        return $this->draws;
    }

    /**
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * @param $error
     * @return $this
     */
    public function setError($error): self
    {
        $this->error = $error;
        return $this;
    }
}
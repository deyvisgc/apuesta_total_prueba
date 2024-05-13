<?php

namespace App\Application\UseCases\General;

use App\Domain\Entities\ComunicationEntity;
use App\Domain\Repositories\GeneralRepositoryInterface;

class ComunicationUseCase
{ 
    protected $generalRepositoryInterface;

    public function __construct(GeneralRepositoryInterface $generalRepositoryInterface)
    {
        $this->generalRepositoryInterface = $generalRepositoryInterface;
    }

    public function execute($sales_id, $id_jugador,  $channel, $message)
    {
        $comunication = new ComunicationEntity($sales_id, $id_jugador,  $channel, $message);
        return $this->generalRepositoryInterface->sendComunication($comunication);
    }
    public function executereplyMessage($id, $sales_id , $idClient , $message)
    {
        return $this->generalRepositoryInterface->replyMessage($id, $sales_id , $idClient , $message);
    }
}

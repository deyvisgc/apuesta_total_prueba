<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\ComunicationEntity;
interface GeneralRepositoryInterface
{
    public function sendComunication(ComunicationEntity $comunicationEntity);
    public function replyMessage( $id, $sales_id , $idClient , $message);
   
    public function findComunication();
    public function findRole();
    public function findBank();
    public function updateStatus($id, $status);
}

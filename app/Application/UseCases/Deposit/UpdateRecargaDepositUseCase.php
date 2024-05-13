<?php

namespace App\Application\UseCases\Deposit;

use App\Domain\Entities\DepositEntity;
use App\Domain\Repositories\DepositRepositoryInterface;

class UpdateRecargaDepositUseCase
{ 
    protected $depositRepositoryInterface;

    public function __construct(DepositRepositoryInterface $depositRepositoryInterface)
    {
        $this->depositRepositoryInterface = $depositRepositoryInterface;
    }

    public function execute($id, $player_id, $voucher,  $amount, $bank_id, $date_hour, $chanel)
    {
        $deposit = new DepositEntity($player_id, $voucher,  $amount, $bank_id, $date_hour, $chanel);
        return $this->depositRepositoryInterface->updateRecarga($id, $deposit);
    }
}

<?php

namespace App\Domain\Entities;

class DepositEntity
{
    private $player_id;
    private $voucher;
    private $amount;
    private $bank_id;
    private $date_hour;
    private $chanel;

    public function __construct($player_id,$voucher,  $amount, $bank_id, $date_hour, $chanel)
    {
        $this->player_id = $player_id;
        $this->voucher = $voucher;
        $this->amount = $amount;
        $this->bank_id = $bank_id;
        $this->date_hour = $date_hour;
        $this->chanel = $chanel;
    }

    public function getPlayerId() {
        return $this->player_id;
    }
    
    public function getVoucher() {
        return $this->voucher;
    }
    public function getAmount() {
        return $this->amount;
    }
    public function getBankId() {
        return $this->bank_id;
    }
    public function getDateHour() {
        return $this->date_hour;
    }
    
    public function getChanel() {
        return $this->chanel;
    }
}

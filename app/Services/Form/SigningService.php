<?php

namespace App\Services\Form;

use App\Repositories\SigningRepository;
use App\Repositories\SigningProcessRepository;

/**
 * class SigningService 建立簽核流程
 *
 * @property SigningRepository $signingRepo
 * @property SigningProcessRepository $processRepo
 */
class SigningService
{
    protected $signingRepo;

    public function __construct()
    {
        $this->setRepository();
    }

    public function setRepository()
    {
        $this->signingRepo = app()->make(SigningRepository::class);
        $this->processRepo = app()->make(SigningProcessRepository::class);
    }

    public function createSigning($form_id, $processData)
    {
        $create_user_id = auth()->check()
            ? auth()->user()->id : null;

        // 建立 簽核
        $signing = $this->signingRepo->create([
            'form_id' => $form_id,
            'progress' => 1,
            'create_user_id' => $create_user_id,
        ]);
        if (!$signing) {
            return null;
        }

        // 建立 簽核流程
        $processes = [];
        $sequence = 1;
        foreach ($processData as $item) {
            $item['signing_id'] = $signing->id;
            $item['sequence'] = $sequence++;
            $processes[] = $this->processRepo->create($item);
        }

        $signing->processes = $processes;
        return $signing;
    }
}

<?php

namespace App\Services\Form;

use App\Repositories\SigningRepository;
use App\Repositories\SigningProcessRepository;

/**
 * class CreateSigningService 建立簽核流程
 *
 * @property SigningRepository $signingRepo
 * @property SigningProcessRepository $processRepo
 */
class CreateSigningService
{
    protected $signingRepo;
    protected $processRepo;

    /**
     * 簽核流程輸入資料
     *
     * @var array
     */
    protected $processes = [];

    /**
     * 建立者ID
     *
     * @var int
     */
    protected $create_user_id = null;

    /**
     * 錯誤訊息
     *
     * @var string
     */
    protected $errorMessage = "";

    public function __construct()
    {
        $this->signingRepo = new SigningRepository();
        $this->processRepo = new SigningProcessRepository();

        $this->create_user_id = auth()->check() ? auth()->user()->id : null;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * 設定流程資料
     *
     * @param array $processes
     * @return self
     */
    public function setProcesses($processes)
    {
        $this->processes = $processes;
        return $this;
    }

    /**
     * 建立簽核
     *
     * @param int $form_id
     * @return \App\Models\Signing|null
     */
    public function create($form_id)
    {
        try {
            // 建立簽核
            $signing = $this->_createSigning($form_id);

            // 建立流程
            $processes = $this->_createProcesses($signing->id);

            $signing->processes = $processes;
            return $signing;
        } catch (Exception $e) {
            $this->errorMessage = $e->getMessage();
            return null;
        }
    }

    /**
     * 建立 簽核
     *
     * @param int $form_id
     * @return \App\Models\Signing|null
     */
    private function _createSigning($form_id)
    {
        $signing = $this->signingRepo->create([
            'form_id' => $form_id,
            'progress' => 1,
            'create_user_id' => $this->create_user_id,
        ]);
        if (!$signing) {
            throw new Exception('簽核建立失敗');
        }
        return $signing;
    }

    /**
     * 建立 簽核流程
     *
     * @param int $form_id
     * @return array
     */
    private function _createProcesses($signingId)
    {
        $this->_validateProcesses();

        $processes = [];
        foreach ($this->processes as $item) {
            $item['signing_id'] = $signingId;
            $processes[] = $this->processRepo->create($item);
        }
        return $processes;
    }

    private function _validateProcesses()
    {
        if (count($this->processes) == 0) {
            throw new Exception('沒有設定任何流程');
        }

        $sequence = 1;
        foreach ($this->processes as &$item) {
            $item['sequence'] = $sequence++;
            if (!isset($item['sign_user_id'])) {
                throw new Exception('第' . $item['sequence'] . '關流程未設定簽核者');
            }
        }
    }
}

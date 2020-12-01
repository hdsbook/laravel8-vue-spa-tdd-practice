<?php

namespace Tests\Feature\Services\Form;

use App\Models\Form;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\Form\CreateSigningService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * class CreateSigningServiceTest 測試建立簽核
 */
class CreateSigningServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreateSigning()
    {
        /** @given 表單資料 與 簽核流程資料 */
        $form = Form::factory()->create();
        $processesData = [
            ['sign_user_id' => User::factory()->create()->id],
            ['sign_user_id' => User::factory()->create()->id],
        ];

        /** @when 建立簽核流程 */
        $service = new CreateSigningService();
        $service->setProcesses($processesData);
        $signing = $service->create($form->id);

        /** @then 確認表單簽核流程建立成功 */
        $this->assertNotNull($signing);
        $this->assertArrayHasKey(
            'processes',
            $signing,
            '未正確建立簽核流程'
        );
        $this->assertCount(
            count($processesData),
            $signing['processes'],
            '簽核流程數錯誤！'
        );
        $this->assertEquals(
            $form->id,
            $signing->form_id,
            '簽核流程綁定之表單錯誤'
        );

        $sequence = 1;
        foreach ($processesData as $key => $expected) {
            $actual = $signing->processes[$key];
            $expected['sequence'] = $sequence++;

            $this->assertEquals(
                $expected['sequence'],
                $actual['sequence'],
                '簽核順序錯誤'
            );
            $this->assertEquals(
                $expected['sign_user_id'],
                $actual['sign_user_id'],
                '簽核者錯誤'
            );
        }
    }
}

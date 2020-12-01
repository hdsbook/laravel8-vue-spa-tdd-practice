<?php

namespace Tests\Feature\Services\Form;

use App\Models\Form;
use App\Models\User;
use App\Repositories\SigningRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\Form\SigningService;

class SigningServiceTest extends TestCase
{
    private function getSigningProcessesData()
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();
        $processes = [
            ['sign_user_id' => $userA->id],
            ['sign_user_id' => $userB->id],
        ];
        return $processes;
    }

    public function testCreateSigning()
    {
        /** @given 表單資料 與 簽核流程資料 */
        $form = Form::factory()->create();
        $createData = $this->getSigningProcessesData();

        /** @when 建立簽核流程 */
        $signingRepo = new SigningService();
        $signing = $signingRepo->createSigning($form->id, $createData);

        /** @then 確認表單簽核流程建立成功 */
        $this->assertNotNull($signing);
        $this->assertArrayHasKey(
            'processes',
            $signing,
            '未正確建立簽核流程'
        );
        $this->assertCount(
            count($createData),
            $signing['processes'],
            '簽核流程數錯誤！'
        );
        $this->assertEquals(
            $form->id,
            $signing->form_id,
            '簽核流程綁定之表單錯誤'
        );

        $sequence = 1;
        foreach ($createData as $key => $process) {
            $actual = $signing->processes[$key];
            $this->assertEquals(
                $sequence++,
                $actual->sequence,
                '簽核順序錯誤'
            );
            $this->assertEquals(
                $process['sign_user_id'],
                $actual->sign_user_id,
                '簽核者錯誤'
            );
        }
    }
}

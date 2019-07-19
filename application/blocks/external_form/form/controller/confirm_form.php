<?php
namespace Application\Block\ExternalForm\Form\Controller;
use Concrete\Core\Controller\AbstractController;
use Core;
use Config;
use Page;
use Concrete\Core\Routing\Redirect;


class ConfirmForm extends AbstractController
{

    protected $input = [];

    private function getAdminEmail() {
        $adminEmail = 'info@example.com';
        return $adminEmail;
    }

    // action を指定しなかった場合、view が実行されると思われる。初期表示。
    public function view()
    {

        // 最初にフォームを開いた時の処理です。初期値を view に渡して、編集画面の表示を指定します。

        $input['p_name'] = '';
        $input['p_name_yomi'] = '';
        $input['p_email'] = '';
        $input['p_tel'] = '';
        $input['p_message'] = '';

        $this->set('isvalid', true);

        $this->set('input', array());
        $this->set('error', array());

        $this->set('section', 'edit');

    }

    // 入力値の検証処理
    private function validate()
    {

        // バリデーション結果を成功に設定
        $isvalid = true;

        $input['p_name'] = trim($this->post('p_name'));
        $input['p_name_yomi'] = trim($this->post('p_name_yomi'));
        $input['p_email'] = trim($this->post('p_email'));
        $input['p_tel'] = trim($this->post('p_tel'));
        $input['p_message'] = trim($this->post('p_message'));

        $this->input = $input;

        // 検証実行
        if ($input['p_name'] == '') {
            $isvalid = false;
            $error['p_name'] = 'お名前は、必ず入力してください。';
        }

        if ($input['p_name_yomi'] == '') {
            $isvalid = false;
            $error['p_name_yomi'] = 'ふりがなは、必ず入力してください。';
        }

        if ($input['p_email'] == '') {
            $isvalid = false;
            $error['p_email'] = 'メールアドレスは、必ず入力してください。';
        }

        if ($input['p_tel'] == '') {
            $isvalid = false;
            $error['p_tel'] = '電話番号は、必ず入力してください。';
        }

        if ($input['p_message'] == '') {
            $isvalid = false;
            $error['p_message'] = '本文は、必ず入力してください。';
        }

        // View に値を渡す
        $this->set('isvalid', $isvalid);

        $this->set('input', $input);
        $this->set('error', $error);

        return $isvalid;

    }

    public function action_confirm()
    {
        $validate = $this->app->make('token')->validate('confirm_form');
        if ($validate != true) {
            throw new Exception(t("Invalid Token. Please contact webmaster."));
        }
        if ($this->isPost() != true) {
            throw new Exception(t("Please do not refresh this page without post data"));
        }

        if ($this->validate()) {
            $this->set('section', 'confirm');
            $this->set('input', $this->input);
        } else {
            $this->set('section', 'edit');
        }
    }

    public function action_back() {
        $validate = $this->app->make('token')->validate('confirm_form_back');
        if ($validate != true) {
            throw new Exception(t("Invalid Token. Please contact webmaster."));
        }
        if ($this->isPost() != true) {
            throw new Exception(t("Please do not refresh this page without post data"));
        }
        $section = 'edit';
        $this->set('section', $section);
        $this->set('isvalid', true);
    }

    public function action_submit()
    {
        $validate = $this->app->make('token')->validate('confirm_form_confirm');
        if ($validate != true) {
            throw new Exception(t("Invalid Token. Please contact webmaster."));
        }
        if ($this->isPost() != true) {
            throw new Exception(t("Please do not refresh this page without post data"));
        }

        if ($this->validate() == false) {
            $this->set('section', 'edit');
        } else {

            $input = $this->input;

            if (Config::get('concrete.email.form_block.address') && strstr(Config::get('concrete.email.form_block.address'), '@')) {
                $formFormEmailAddress = Config::get('concrete.email.form_block.address');
            } else {
                $adminUserInfo = UserInfo::getByID(USER_SUPER_ID);
                $formFormEmailAddress = $adminUserInfo->getUserEmail();
            }
            // Notification Email to admins
            $mh = Core::make('helper/mail');
            $mh->to($this->getAdminEmail());
            $mh->from($formFormEmailAddress);
            $mh->replyto($input['p_email']);
            $mh->addParameter('input', $input);
            $mh->load('block_external_form_admin');
            @$mh->sendMail();
    
            // Confirmation Email to Sender
            $mh = Core::make('helper/mail');
            $mh->to($input['p_email']);
            $mh->from($formFormEmailAddress);
            $mh->replyto($this->getAdminEmail()); // このメールアドレスは1個だけ指定
            $mh->addParameter('input', $input);
            $mh->load('block_external_form_user');
            @$mh->sendMail();
    
            $redirectCID = 1; // concrete5 の cID の場合
            $redirectPath = Page::getCollectionPathFromID($redirectCID);
            Redirect::to($redirectPath)->send();
            // Redirect::to('/thank-you')->send();
        }
    }

}
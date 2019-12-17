<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class SignupCest
{
    protected $formId = '#form-signup';


    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/signup');
    }

    public function signupWithEmptyFields(FunctionalTester $I)
    {
        $I->see('Signup', 'h1');
        $I->see('Please fill out the following fields to signup:');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Email cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');

    }

    public function signupWithWrongEmail(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
                'SignupForm[email]' => 'ttttt',
                'SignupForm[password]' => 'tester_password',
                'SignupForm[password_repeat]' => 'tester_password',
            ]
        );
        $I->dontSee('Password cannot be blank.', '.help-block');
        $I->see('Email is not a valid email address.', '.help-block');
    }

    public function signupSuccessfully(FunctionalTester $I)
    {
        $I->submitForm($this->formId, [
            'SignupForm[email]' => 'tester.email@example.com',
            'SignupForm[password]' => 'tester_password',
            'SignupForm[password_repeat]' => 'tester_password',
        ]);

        $I->seeRecord('common\models\User', [
            'email' => 'tester.email@example.com',
            'status' => \common\models\User::STATUS_ACTIVE
        ]);

        $I->seeEmailIsSent();
        $I->see('Thank you for registration.');
    }
}

<?php

class Model {

    public static array $form_lengths = ['username' => [5,20], 'email' => [5,78], 'pass' => [8,500]];

    /**
     * @param $data
     */
    public static function registerAccount($data) {

        if (self::defaultVerify($data) === true) {
            if (empty(db::query('SELECT id FROM `users` WHERE username = :username', ['username' => $data['username']], 'row'))) {
                if (empty(db::query('SELECT id FROM `users` WHERE email_address = :email', ['email' => $data['email']], 'row'))) {
                    $values = [
                        'username' => $data['username'],
                        'email_address' => $data['email'],
                        'pass' => Functions::securePassword($data['password'])
                    ];
                    db::insertRow('users', $values);

                    Ajax::setResult(true, 'You have succesfully registered');
                } else {
                    Ajax::setResult(false, 'This e-mail address has already been taken.');
                }
            } else {
                Ajax::setResult(false, 'This username has already been taken.');
            }
        }

    }

    /**
     * @param $data
     * @return mixed
     */
    public static function defaultVerify($data) {

        $lengths = self::$form_lengths;

        if (empty($data['username']) || (strlen($data['username']) <= $lengths['username'][0] || strlen($data['username']) > $lengths['username'][1])) {
            Ajax::setResult(false, 'Your username must be between '.$lengths['username'][0].' and '.$lengths['username'][1].' characters.');
        } elseif (empty($data['email']) || (strlen($data['email']) <= $lengths['email'][0] || strlen($data['email']) > $lengths['email'][1])) {
            Ajax::setResult(false, 'Your e-mail address must be between '.$lengths['email'][0].' and '.$lengths['email'][1].' characters.');
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            Ajax::setResult(false, 'You must enter a valid e-mail address format.');
        } elseif (empty($data['password']) || (strlen($data['password']) <= $lengths['pass'][0] || strlen($data['password']) > $lengths['pass'][1])) {
            Ajax::setResult(false, 'Your password must be between ' . $lengths['pass'][0] . ' and ' . $lengths['pass'][1] . ' characters.');
        } elseif ($data['password'] != (!empty($data['cpassword']) ? $data['cpassword'] : '')) {
            Ajax::setResult(false, 'Your password did not match the confirmation password field.');
        } elseif (empty($data['agreement'])) {
            Ajax::setResult(false, 'You must agree with the terms and conditions to proceed.');
        } else {
            Ajax::$result['result'] = true;
        }

        return Ajax::$result['result'];

    }

}
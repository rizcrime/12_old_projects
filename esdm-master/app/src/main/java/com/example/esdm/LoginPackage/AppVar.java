package com.example.esdm.LoginPackage;

public class AppVar {

    //URL to our login.php file, url bisa diganti sesuai dengan alamat server kita
    public static final String LOGIN_URL = "http://172.16.23.34/laporan-harian-esdm/api/Auth/login";

    //Keys for email and password as defined in our $_POST['key'] in login.php
    public static final String KEY_USERNAAME = "username";
    public static final String KEY_PASSWORD = "password";

    //If server response is equal to this that means login is successful
    public static final String LOGIN_SUCCESS = "Sukses";

}
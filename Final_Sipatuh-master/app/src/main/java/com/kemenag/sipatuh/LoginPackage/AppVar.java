package com.kemenag.sipatuh.LoginPackage;

public class AppVar {

    public static final String KEY_USERNAAME = "email";
    public static final String KEY_PASSWORD = "password";

    public static final String LOGIN_SUCCESS = "Success";

    // URL
    public static final String BASE_URL = "https://haji.kemenag.go.id/pihk_development/";
    public static final String BASE_URL_2 = "https://haji.kemenag.go.id/pihk/Dashboard/login";

    public static final String MS_CONFIG_REQUEST = BASE_URL.concat("API/helper/msconfig");

    public static final String LOGIN_URL = BASE_URL.concat("API/Auth/login");
    public static final String GET_DATA_PAKET = BASE_URL.concat("API/manifest/data_paket");

    // Keberangkatan
    public static final String GET_KEBERANGKATAN = BASE_URL.concat("API/manifest/rencana_dan_jamaah");
    public static final String POST_KEBERANGKATAN = BASE_URL.concat("API/manifest/aktual_dan_jamaah_keberangkatan");

    // Madinah
    public static final String GET_MADINAH = BASE_URL.concat("API/kedatangan/jamaah_madinah");
    public static final String POST_MADINAH = BASE_URL.concat("API/kedatangan/update_aktual_madinah");

    // Jeddah
    public static final String GET_JEDDAH = BASE_URL.concat("API/kedatangan/jamaah_jeddah");
    public static final String POST_JEDDAH = BASE_URL.concat("API/kedatangan/update_aktual_jeddah");

    // Mekkah
    public static final String GET_MEKKAH = BASE_URL.concat("API/kedatangan/jamaah_mekkah");
    public static final String POST_MEKKAH = BASE_URL.concat("API/kedatangan/update_aktual_mekkah");

    // Arafah
    public static final String GET_ARAFAH = BASE_URL.concat("API/kedatangan/jamaah_kedatangan_arafah");
    public static final String POST_ARAFAH = BASE_URL.concat("API/kedatangan/update_aktual_kedatangan_arafah");

    // Mina
    public static final String GET_MINA = BASE_URL.concat("API/kedatangan/jamaah_kepulangan_mina");
    public static final String POST_MINA = BASE_URL.concat("API/kedatangan/update_aktual_kepulangan_mina");

    // Berangkat dari arab
    public static final String GET_BERANGKAT_ARAB = BASE_URL.concat("API/kedatangan/data_rencana_jamaah_kepulangan");
    public static final String POST_BERANGKAT_ARAB = BASE_URL.concat("API/kedatangan/update_aktual_kepulangan");

    // Datang ke tanah air
    public static final String GET_DATANG_TANAH_AIR = BASE_URL.concat("API/kedatangan/jamaah_kedatangan_tanah_air");
    public static final String POST_DATANG_TANAH_AIR = BASE_URL.concat("API/kedatangan/update_aktual_kedatangan_tanah_air");

    // Tarwiyah
    public static final String GET_TARWIYAH = BASE_URL.concat("API/kedatangan/jamaah_tarwiyah");
    public static final String POST_TARWIYAH = BASE_URL.concat("API/kedatangan/update_aktual_tarwiyah");

    // Hotel Jeddah
    public static final String GET_HOTEL_JEDDAH = BASE_URL.concat("API/helper/msconfig?var_id=hotel_jeddah");

    // Hotel Madinah
    public static final String GET_HOTEL_MADINAH = BASE_URL.concat("API/helper/msconfig?var_id=hotel_madinah");

    //Hotel Makkah
    public static final String GET_HOTEL_MAKKAH = BASE_URL.concat("API/helper/msconfig?var_id=hotel_mekkah");

    public static final String POST_TRANSIT_MEKKAH = BASE_URL.concat("API/kedatangan/update_hotel_transit_mekkah");

    // Kasus Kasus
    public static final String KASUS = BASE_URL.concat("API/kasus/input");
}
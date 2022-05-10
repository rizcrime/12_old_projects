package com.simwaspihk.other;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import com.simwaspihk.data.remote.api.ApiServices;
import com.simwaspihk.data.remote.api.RetrofitClient;

/**
 * Created by creatorbe on 8/8/17.
 */

public class Utils {
    public static final String BASE_URL = "http://simwas.esy.es/";
    public static final String BASE_API = "http://simwaspihk.com/api/";

    public static ApiServices getBAS() {
        return RetrofitClient.getRetrofit(BASE_API).create(ApiServices.class);
    }

    public static final boolean hasNetWorkConection(Context ctx) {
        // 获取连接活动管理器
        final ConnectivityManager connectivityManager = (ConnectivityManager) ctx
                .getSystemService(Context.CONNECTIVITY_SERVICE);
        // 获取连接的网络信息
        final NetworkInfo networkInfo = connectivityManager
                .getActiveNetworkInfo();
        return (networkInfo != null && networkInfo.isAvailable());
    }
}

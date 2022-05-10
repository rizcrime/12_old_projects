package com.simwaspihk.data.remote.api;

import retrofit2.Retrofit;
import retrofit2.Retrofit.Builder;
import retrofit2.converter.gson.GsonConverterFactory;

public class Retroserver {
    private static final String base_url = "http://simwaspihk.com/api/";
    private static Retrofit retrofit;

    public static Retrofit getClient() {
        if (retrofit == null) {
            retrofit = new Builder().baseUrl("http://simwaspihk.com/api/").addConverterFactory(GsonConverterFactory.create()).build();
        }
        return retrofit;
    }
}

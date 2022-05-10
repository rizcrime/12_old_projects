package com.simwaspihk.data.remote.api;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import com.simwaspihk.other.AppController;
import com.simwaspihk.other.Utils;

import java.io.IOException;
import java.util.concurrent.TimeUnit;

import okhttp3.Cache;
import okhttp3.CacheControl;
import okhttp3.Interceptor;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.logging.HttpLoggingInterceptor;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

import static com.simwaspihk.other.Utils.BASE_API;
import static com.simwaspihk.other.Utils.BASE_URL;

/**
 * Created by creatorbe on 8/8/17.
 */

public class RetrofitClient {

    private static Retrofit retrofit = null;

    static int cacheSize = 10 * 1024 * 1024; // 10 MB
    static Cache cache = new Cache(AppController.getInstance().getCacheDir(), cacheSize);

    static CacheControl cacheControl = new CacheControl.Builder()
            .maxAge(10, TimeUnit.DAYS)
            .build();

//    public static OkHttpClient defaultOkHttpClient() {
//        OkHttpClient.Builder client = new OkHttpClient.Builder();
//        client.writeTimeout(30 * 1000, TimeUnit.MILLISECONDS);
//        client.readTimeout(20 * 1000, TimeUnit.MILLISECONDS);
//        client.connectTimeout(15 * 1000, TimeUnit.MILLISECONDS);
//        //设置缓存路径
//        File httpCacheDirectory = new File(application.getCacheDir(), "okhttpCache");
//        //设置缓存 10M
//        Cache cache = new Cache(httpCacheDirectory, 10 * 1024 * 1024);
//        client.cache(cache);
//        //设置拦截器
//        client.addInterceptor(LoggingInterceptor);
//        client.addNetworkInterceptor(REWRITE_CACHE_CONTROL_INTERCEPTOR);
//        client.addInterceptor(REWRITE_CACHE_CONTROL_INTERCEPTOR);
//        return client.build();
//    }
//
//    private static final Interceptor REWRITE_CACHE_CONTROL_INTERCEPTOR = new Interceptor() {
//
//        @Override
//        public ResponseTbsakit intercept(Interceptor.Chain chain) throws IOException {
//            //方案一：有网和没有网都是先读缓存
//            //                Request request = chain.request();
//            //                Log.i(TAG, "request=" + request);
//            //                ResponseTbsakit response = chain.proceed(request);
//            //                Log.i(TAG, "response=" + response);
//            //
//            //                String cacheControl = request.cacheControl().toString();
//            //                if (TextUtils.isEmpty(cacheControl)) {
//            //                    cacheControl = "public, max-age=60";
//            //                }
//            //                return response.newBuilder()
//            //                        .header("Cache-Control", cacheControl)
//            //                        .removeHeader("Pragma")
//            //                        .build();
//
//            //方案二：无网读缓存，有网根据过期时间重新请求
//            boolean netWorkConection = NetUtils.hasNetWorkConection(MyApplication.getInstance());
//            Request request = chain.request();
//            if (!netWorkConection) {
//                request = request.newBuilder()
//                        .cacheControl(CacheControl.FORCE_CACHE)
//                        .build();
//            }
//
//            ResponseTbsakit response = chain.proceed(request);
//            if (netWorkConection) {
//                //有网的时候读接口上的@Headers里的配置，你可以在这里进行统一的设置
//                String cacheControl = request.cacheControl().toString();
//                response.newBuilder()
//                        .removeHeader("Pragma")// 清除头信息，因为服务器如果不支持，会返回一些干扰信息，不清除下面无法生效
//                        .header("Cache-Control", cacheControl)
//                        .build();
//            } else {
//                int maxStale = 60 * 60 * 24 * 7;
//                response.newBuilder()
//                        .removeHeader("Pragma")
//                        .header("Cache-Control", "public, only-if-cached, max-stale=" + maxStale)
//                        .build();
//            }
//            return response;
//        }
//    };
    //Last update
public static final String API_URL = "http://simwaspihk.com/api/";
public static Retrofit getClient() {
    if (retrofit==null) {
        retrofit = new Retrofit.Builder()
                .baseUrl(API_URL)
                .addConverterFactory(GsonConverterFactory.create())
                .build();
    }
    return retrofit;
}
    public static Retrofit getRetrofit(String baseurl) {
        final HttpLoggingInterceptor interceptor = new HttpLoggingInterceptor();
        interceptor.setLevel(HttpLoggingInterceptor.Level.BODY);
//        Gson gson = new GsonBuilder().serializeNulls().create();
        Gson gson = new GsonBuilder()
                .setLenient()
                .create();
//        OkHttpClient client = new OkHttpClient.Builder().addInterceptor(interceptor).build();

//        OkHttpClient client = new OkHttpClient.Builder()
//                .cache(cache)
//                .addInterceptor(REWRITE_RESPONSE_INTERCEPTOR_OFFLINE)
//                .build();

//        OkHttpClient client = new OkHttpClient.Builder()
//                .cache(cache)
//                .addNetworkInterceptor(REWRITE_RESPONSE_INTERCEPTOR)
//                .addInterceptor(REWRITE_RESPONSE_INTERCEPTOR_OFFLINE)
//                .build();

//        OkHttpClient client = new OkHttpClient
//                .Builder()
//                .cache(new Cache(AppController.mInstance.getCacheDir(), 10 * 1024 * 1024)) // 10 MB
//                .addInterceptor(new Interceptor() {
//                    @Override public ResponseTbsakit intercept(Chain chain) throws IOException {
//                        Request request = chain.request();
//                        if (Utils.hasNetWorkConection(AppController.getAppContext())) {
//                            request = request.newBuilder().removeHeader("Pragma").header("Cache-Control", "public, max-age=" + 60).build();
//                        } else {
////                            request = request.newBuilder().removeHeader("Pragma").header("Cache-Control", "public, only-if-cached, max-stale=" + 60 * 60 * 24 * 7).build();
//                            request = request.newBuilder().cacheControl(CacheControl.FORCE_CACHE).build();
//                        }
//                        return chain.proceed(request);
//                    }
//                })
//                .build();

//        OkHttpClient client = new OkHttpClient
//                .Builder()
//                .cache(new Cache(AppController.mInstance.getCacheDir(), 100 * 1024 * 1024)) // 10 MB
//                .addInterceptor(new Interceptor() {
//                    @Override public ResponseTbsakit intercept(Chain chain) throws IOException {
//                        Request request = chain.request();
//                        if (AppController.isNetworkAvailable()) {
//                            request = request.newBuilder().removeHeader("Pragma").header("Cache-Control", "public, max-age=" + 60).build();
//                        } else {
////                            request = request.newBuilder().removeHeader("Pragma").header("Cache-Control", "public, only-if-cached, max-stale=" + 60 * 60 * 24 * 7).build();
////                            request = request.newBuilder().removeHeader("Pragma").cacheControl(CacheControl.FORCE_CACHE).build();
//                            request.newBuilder()
//                                    .cacheControl(new CacheControl.Builder()
//                                            .maxAge(365, TimeUnit.DAYS)
//                                            .build());
//                        }
//                        return chain.proceed(request);
//                    }
//                })
//                .build();

        OkHttpClient.Builder client = new OkHttpClient.Builder()
                .cache(cache)//adding the cache object that we have created
                .addNetworkInterceptor(new ResponseCacheInterceptor())
                .addInterceptor(new OfflineResponseCacheInterceptor());

        if (retrofit == null) {
            retrofit = new Retrofit.Builder()
                    .baseUrl(baseurl)
                    .addConverterFactory(GsonConverterFactory.create(gson))
//                    .client(AppController.defaultOkHttpClient())
                    .client(client.build())
                    .build();
        }
        return retrofit;
    }

//    private static final Interceptor REWRITE_RESPONSE_INTERCEPTOR = new Interceptor() {
//        @Override
//        public okhttp3.ResponseTbsakit intercept(Chain chain) throws IOException {
//            okhttp3.ResponseTbsakit originalResponse = chain.proceed(chain.request());
//            String cacheControl = originalResponse.header("Cache-Control");
//            if (cacheControl == null || cacheControl.contains("no-store") || cacheControl.contains("no-cache") ||
//                    cacheControl.contains("must-revalidate") || cacheControl.contains("max-age=0")) {
//                return originalResponse.newBuilder()
//                        .removeHeader("Pragma")
//                        .header("Cache-Control", "public, max-age=" + 5000)
//                        .build();
//            } else {
//                return originalResponse;
//            }
//        }
//    };
//
//    private static final Interceptor REWRITE_RESPONSE_INTERCEPTOR_OFFLINE = new Interceptor() {
//        @Override
//        public okhttp3.ResponseTbsakit intercept(Chain chain) throws IOException {
//            Request request = chain.request();
//            if (!AppController.isNetworkAvailable()) {
//                request = request.newBuilder()
//                        .removeHeader("Pragma")
//                        .header("Cache-Control", "public, only-if-cached")
//                        .build();
//            }
//            return chain.proceed(request);
//        }
//    };

//    private static final Interceptor REWRITE_RESPONSE_INTERCEPTOR_OFFLINE = new Interceptor() {
//        @Override
//        public okhttp3.ResponseTbsakit intercept(Chain chain) throws IOException {
//            Request request = chain.request();
//            if (!AppController.isNetworkAvailable()) {
//                request = request.newBuilder()
//                        .removeHeader("Pragma")
//                        .cacheControl(CacheControl.FORCE_CACHE)
//                        .build();
//            }
//            return chain.proceed(request);
//        }
//    };

    private static class ResponseCacheInterceptor implements Interceptor {
        @Override
        public okhttp3.Response intercept(Chain chain) throws IOException {
            okhttp3.Response originalResponse = chain.proceed(chain.request());
            return originalResponse
                    .newBuilder()
                    .removeHeader("Pragma")
                    .header("Cache-Control", cacheControl.toString())
                    .build();
        }
    }

    private static class OfflineResponseCacheInterceptor implements Interceptor {
        @Override
        public okhttp3.Response intercept(Chain chain) throws IOException {
            Request request = chain.request();
            if (!Utils.hasNetWorkConection(AppController.getAppContext())) {
                request = request.newBuilder()
                        .removeHeader("Pragma")
                        .cacheControl(cacheControl)
                        .build();
            }
            return chain.proceed(request);
        }
    }

}

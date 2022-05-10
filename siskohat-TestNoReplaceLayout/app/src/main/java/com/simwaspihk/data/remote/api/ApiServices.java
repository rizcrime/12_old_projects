package com.simwaspihk.data.remote.api;

import com.simwaspihk.data.remote.api.model.asosiasi.ResponseAsosiasi;
import com.simwaspihk.data.remote.api.model.auth.ResponseAuth;
import com.simwaspihk.data.remote.api.model.news.ResponseNews;
import com.simwaspihk.data.remote.api.model.profiles.response.ResponseProfile;
import com.simwaspihk.data.remote.api.model.profiles.update.ResponseUpdateProfiles;
import com.simwaspihk.data.remote.api.model.rpt.ResponseRpt;
import com.simwaspihk.data.remote.api.model.rpt.delete.ResponseDeleteRpt;
import com.simwaspihk.data.remote.api.model.tbsakit.TbsakitResponse;
import com.simwaspihk.data.remote.api.model.tbsaran.TbsaranResponse;
import com.simwaspihk.data.remote.api.model.tbwafat.TbwafatResponse;
import com.simwaspihk.data.remote.api.model.travel.TravelResponse;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Headers;
import retrofit2.http.POST;
import retrofit2.http.Path;
import retrofit2.http.Query;

public interface ApiServices {
    @FormUrlEncoded
    @POST("tbsakit/delete")
    Call<TbsakitResponse> deleteTbsakit(@Field("id") String str);

    @FormUrlEncoded
    @POST("tbsaran/delete")
    Call<TbsaranResponse> deleteTbsaran(@Field("id") String str);

    @FormUrlEncoded
    @POST("tbwafat/delete")
    Call<TbwafatResponse> deleteTbwafat(@Field("id") String str);

    @FormUrlEncoded
    @POST("users/delete")
    Call<TravelResponse> deleteTravel(@Field("user_id") String str);

    @GET("assets/images/{imageName}")
    void getImage(@Path("imageName") String str, Callback<Response> callback);

    @GET("users")
    Call<ResponseProfile> getProfiles();

    @GET("tbsakit/show")
    Call<TbsakitResponse> getTbsakit();

    @GET("tbsaran/show")
    Call<TbsaranResponse> getTbsaran();

    @GET("tbwafat/show")
    Call<TbwafatResponse> getTbwafat();

    @GET("users")
    Call<TravelResponse> getTravel();

    @FormUrlEncoded
    @POST("login")
    Call<ResponseAuth> loginRequest(@Field("email") String str, @Field("password") String str2);

    @GET("asosiasi")
    Call<ResponseAsosiasi> requestAsosiasi();

    @GET("news")
    Call<ResponseNews> requestNews();

    @GET("users")
    @Headers({"Cache-Control: no-cache"})
    Call<ResponseProfile> requestProfiles(@Query("user_id") int i);

    @GET("datasimwas/delete")
    Call<ResponseDeleteRpt> rptDelete(@Query("id") String str);

    @FormUrlEncoded
    @POST("datasimwas/insert")
    Call<ResponseDeleteRpt> rptInsert(@Query("user_id") int i, @Query("name") String str, @Query("no_urut") String str2, @Field("user_id") int i2, @Field("name") String str3, @Field("no_urut") String str4, @Field("plan_tanggal") String str5, @Field("plan_pukul") String str6, @Field("plan_flight") String str7, @Field("plan_jumlah") String str8, @Field("bandara") String str9, @Field("tanggal") String str10, @Field("pukul") String str11, @Field("no_flight") String str12, @Field("jumlah") String str13, @Field("bandara_transit") String str14, @Field("pria") String str15, @Field("wanita") String str16, @Field("sakit") String str17, @Field("lain") String str18);

    @GET("datasimwas")
    @Headers({"Cache-Control: no-cache"})
    Call<ResponseRpt> rptRequest(@Query("user_id") int i, @Query("name") String str);

    @FormUrlEncoded
    @POST("datasimwas/update")
    Call<ResponseDeleteRpt> rptUpdate(@Query("id") String str, @Field("plan_tanggal") String str2, @Field("plan_pukul") String str3, @Field("plan_flight") String str4, @Field("plan_jumlah") String str5, @Field("bandara") String str6, @Field("tanggal") String str7, @Field("pukul") String str8, @Field("no_flight") String str9, @Field("jumlah") String str10, @Field("bandara_transit") String str11, @Field("pria") String str12, @Field("wanita") String str13, @Field("sakit") String str14, @Field("lain") String str15);

    @FormUrlEncoded
    @POST("tbsakit/insert")
    Call<TbsakitResponse> sendTbsakit(@Field("user_id") String str, @Field("no_pasport") String str2, @Field("nama_jemaah") String str3, @Field("tgl_lahir") String str4, @Field("tgl_rawat") String str5, @Field("rumah_sakit") String str6, @Field("sebab") String str7, @Field("keterangan") String str8);

    @FormUrlEncoded
    @POST("tbsaran/insert")
    Call<TbsaranResponse> sendTbsaran(@Field("user_id") String str, @Field("name") String str2, @Field("hambatan") String str3, @Field("saran") String str4);

    @FormUrlEncoded
    @POST("tbwafat/insert")
    Call<TbwafatResponse> sendTbwafat(@Field("user_id") String str, @Field("no_pasport") String str2, @Field("nama_jemaah") String str3, @Field("tgl_lahir") String str4, @Field("no_porsi") String str5, @Field("waktu") String str6, @Field("makan") String str7, @Field("sebab") String str8, @Field("keterangan") String str9);

    @FormUrlEncoded
    @POST("users/insert")
    Call<TravelResponse> sendTravel(@Field("users_id") String str, @Field("name") String str2, @Field("status") String str3, @Field("status") String str4, @Field("email") String str5, @Field("user_type") String str6, @Field("password") String str7, @Field("kode_pihk") String str8);

    @FormUrlEncoded
    @POST("users/update")
    Call<ResponseUpdateProfiles> updateProfiles(@Query("user_id") int i, @Query("name") String str, @Query("nama_pimpinan") String str2, @Field("no_sk") String str3, @Field("masa_berlaku") String str4, @Field("alamat") String str5, @Field("no_telp") String str6, @Field("email_pihk") String str7, @Field("asosiasi") String str8);

    @FormUrlEncoded
    @POST("users/update")
    Call<ResponseUpdateProfiles> updateProgram(@Query("user_id") int i, @Field("tgl_berangkat") String str, @Field("tgl_pulang") String str2, @Field("nm_petugas_kemenag") String str3, @Field("tel_petugas_kemenag") String str4, @Field("nm_petugas_pihk") String str5, @Field("tel_petugas_pihk") String str6, @Field("nm_petugas_pembimbing") String str7, @Field("tel_petugas_pembimbing") String str8, @Field("nm_petugas_kes") String str9, @Field("tel_petugas_kes") String str10, @Field("hotel_makkah") String str11, @Field("hotel_madinah") String str12, @Field("hotel_jeddah") String str13, @Field("hotel_transit") String str14, @Field("katering_makkah") String str15, @Field("katering_madinah") String str16, @Field("katering_jeddah") String str17, @Field("katering_transit") String str18, @Field("transfortasi") String str19, @Field("harga_vip") String str20, @Field("harga_standard") String str21, @Field("perwakilan_arab") String str22, @Field("tel_perwakilan_arab") String str23, @Field("rute_perjalanan") String str24, @Field("lama_penyelengaraan") String str25, @Field("tinggal_jkt_sa_jkt") String str26, @Field("tinggal_madinah") String str27, @Field("tinggal_makkah") String str28);

    @FormUrlEncoded
    @POST("tbsakit/update")
    Call<TbsakitResponse> updateTbsakit(@Field("id") String str, @Field("user_id") String str2, @Field("no_pasport") String str3, @Field("nama_jemaah") String str4, @Field("tgl_lahir") String str5, @Field("tgl_rawat") String str6, @Field("rumah_sakit") String str7, @Field("sebab") String str8, @Field("keterangan") String str9);

    @FormUrlEncoded
    @POST("tbsaran/update")
    Call<TbsaranResponse> updateTbsaran(@Field("id") String str, @Field("user_id") String str2, @Field("name") String str3, @Field("hambatan") String str4, @Field("saran") String str5);

    @FormUrlEncoded
    @POST("tbwafat/update")
    Call<TbwafatResponse> updateTbwafat(@Field("id") String str, @Field("user_id") String str2, @Field("no_pasport") String str3, @Field("nama_jemaah") String str4, @Field("tgl_lahir") String str5, @Field("no_porsi") String str6, @Field("waktu") String str7, @Field("makan") String str8, @Field("sebab") String str9, @Field("keterangan") String str10);

    @FormUrlEncoded
    @POST("users/update")
    Call<TravelResponse> updateTravel(@Field("user_id") String str, @Field("users_id") String str2, @Field("name") String str3, @Field("status") String str4, @Field("status") String str5, @Field("email") String str6, @Field("user_type") String str7, @Field("password") String str8, @Field("kode_pihk") String str9);
}

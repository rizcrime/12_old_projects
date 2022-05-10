package idn.eb2.emergencybutton2.Global

import okhttp3.MultipartBody
import okhttp3.RequestBody
import retrofit2.Call
import retrofit2.http.*

interface BaseApiService {

    @FormUrlEncoded
    @POST("user_login.php")
    fun loginRequest(
        @Field("email") email: String? = "",
        @Field("pass") password: String? = ""
    ): Call<UserItem>

    @Multipart
    @POST("user_register.php")
    fun registerRequest(
        @Part("name") name: RequestBody?,
        @Part("number") number: RequestBody?,
        @Part("email") email: RequestBody?,
        @Part("pass") pass: RequestBody?,
        @Part image: MultipartBody.Part?
    ): Call<UserItem>

    @FormUrlEncoded
    @POST("user_forpass.php")
    fun forpassRequest(
        @Field("email") email: String?
    ): Call<UserItem>

}
package idn.eb2.emergencybutton2.MVP.Presenter

import idn.eb2.emergencybutton2.Global.BaseApiService
import idn.eb2.emergencybutton2.Global.UserItem
import idn.eb2.emergencybutton2.Global.UtilsApi
import idn.eb2.emergencybutton2.MVP.Model.RegisterModel
import okhttp3.MultipartBody
import okhttp3.RequestBody
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class RegisterPresenter(val view: RegisterModel.View) : RegisterModel.Presenter {

    var mApiService: BaseApiService = UtilsApi.getAPIService()!!

    override fun pushRegisterData(name: RequestBody?,
                                  number: RequestBody?,
                                  email: RequestBody?,
                                  pass: RequestBody?,
                                  image : MultipartBody.Part) {
        mApiService.registerRequest(name, number, email, pass, image)
            .enqueue(object : Callback<UserItem> {
                override fun onFailure(call: Call<UserItem>, t: Throwable) {
                    view.isFailure(t.toString())
                }

                override fun onResponse(call: Call<UserItem>, response: Response<UserItem>) {
                    if (response.body()!!.status.equals("false")){
                        response.body()!!.msg?.let { view.isFailure(it) }
                    }else{
                        response.body()!!.msg?.let { view.isSuccess(it) }
                    }
                }
            })

    }
}
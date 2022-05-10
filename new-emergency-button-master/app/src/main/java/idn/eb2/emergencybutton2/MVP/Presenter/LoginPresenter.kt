package idn.eb2.emergencybutton2.MVP.Presenter

import idn.eb2.emergencybutton2.Global.BaseApiService
import idn.eb2.emergencybutton2.Global.UserItem
import idn.eb2.emergencybutton2.Global.UtilsApi
import idn.eb2.emergencybutton2.MVP.Model.LoginModel
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class LoginPresenter(val view: LoginModel.View) : LoginModel.Presenter {

    override fun pushLoginData(email: String, pass: String) {
        val mApiService: BaseApiService = UtilsApi.getAPIService()!!

        mApiService.loginRequest(email, pass)
            .enqueue(object : Callback<UserItem> {
                override fun onFailure(call: Call<UserItem>, t: Throwable?) {
                    view.isFailure(t.toString())
                }

                override fun onResponse(call: Call<UserItem>, response: Response<UserItem>) {
                    if (response.body()!!.status.equals("true")) {
                        response.body()!!.msg?.let { view.isSuccess(it) }
                        view.saveUserData(response)
                        view.goToHome()
                    } else {
                        response.body()!!.msg?.let { view.isFailure(it) }
                    }
                }
            })
    }
}
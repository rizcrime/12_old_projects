package idn.eb2.emergencybutton2.MVP.Presenter

import idn.eb2.emergencybutton2.Global.BaseApiService
import idn.eb2.emergencybutton2.Global.UserItem
import idn.eb2.emergencybutton2.Global.UtilsApi
import idn.eb2.emergencybutton2.MVP.Model.ForpassModel
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class ForpassPresenter(var view : ForpassModel.View) : ForpassModel.Presenter{

    var mApiService: BaseApiService = UtilsApi.getAPIService()!!

    override fun getDataPass(email: String) {
        mApiService.forpassRequest(email)
            .enqueue(object : Callback<UserItem>{
                override fun onFailure(call: Call<UserItem>, t: Throwable) {
                    view.isFailure(t.message.toString())
                }

                override fun onResponse(call: Call<UserItem>, response: Response<UserItem>) {
                    if(response.body()!!.status.equals("true")){
                        response.body()?.data?.pass?.let { view.showPass(it) }
                    }else{
                        view.isFailure("email tidak ditemukan")
                    }
                }
            })
    }
}
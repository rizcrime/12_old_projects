package idn.eb2.emergencybutton2.MVP.Model

import okhttp3.MultipartBody
import okhttp3.RequestBody

object RegisterModel {
    interface View{
        fun goToLogin()
        fun isFailure(msg : String)
        fun isSuccess(msg : String)
        fun goneLoading()
        fun showLoading()
    }

    interface Presenter{
        fun pushRegisterData(name : RequestBody?,
                             number : RequestBody?,
                             email : RequestBody?,
                             pass : RequestBody?,
                             image : MultipartBody.Part)
    }
}
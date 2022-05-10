package idn.eb2.emergencybutton2.MVP.Model

import idn.eb2.emergencybutton2.Global.UserItem
import retrofit2.Response

object LoginModel {
    interface View {
        fun goToHome()
        fun goToRegister()
        fun goToForpass()
        fun saveUserData(data: Response<UserItem>?)
        fun isFailure(msg : String)
        fun isSuccess(msg : String)
        fun checkLogin()
        fun goneLoading()
        fun showLoading()
    }

    interface Presenter {
        fun pushLoginData(email : String, pass : String)
    }
}
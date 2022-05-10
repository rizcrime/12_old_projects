package idn.eb2.emergencybutton2.MVP.Model

interface ForpassModel {
    interface View{
        fun onSuccess(msg: String)
        fun isFailure(msg: String)
        fun showPass(pass: String)
        fun goToLogin()
        fun goneLoading()
        fun showLoading()
    }

    interface Presenter{
        fun getDataPass(email: String)
    }
}
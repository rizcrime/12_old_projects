package idn.eb2.emergencybutton2.MVP.Model

import android.app.AlertDialog

interface AlertActivityModel {
    interface View{
        fun logout(): AlertDialog
        fun takeData()
    }
    interface Presenter{

    }
}
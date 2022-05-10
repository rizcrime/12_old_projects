package idn.eb2.emergencybutton2.MVP.View

import android.annotation.SuppressLint
import android.content.Context
import android.content.Intent
import android.content.SharedPreferences
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.fragment.app.Fragment
import com.bumptech.glide.Glide
import idn.eb2.emergencybutton2.R
import kotlinx.android.synthetic.main.notification_layout_activity_fragment.*

class FragmentNotificationActivity : Fragment() {

    private lateinit var myPref: SharedPreferences
    private lateinit var editor: SharedPreferences.Editor
    private lateinit var loginEditor: SharedPreferences.Editor

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        return inflater.inflate(R.layout.notification_layout_activity_fragment, container, false)
    }

    @SuppressLint("CommitPrefEdits")
    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)

        myPref = context!!.getSharedPreferences("userInfo", Context.MODE_PRIVATE)
        editor = context!!.getSharedPreferences("userInfo", Context.MODE_PRIVATE).edit()
        loginEditor = context!!.getSharedPreferences("login", Context.MODE_PRIVATE).edit()

        dataUser()

        logout_notif.setOnClickListener {
            logoutUser()
        }

    }

    @SuppressLint("SetTextI18n")
    private fun dataUser(){
        val name = myPref.getString("nama", "")
        val image = myPref.getString("image", "")

        nama_user_notif.text = "Selamat Datang $name"
        view?.let { Glide.with(it).load(image).into(image_profile_notif) }
    }

    private fun goToLogin(){
        val pindah = Intent(context, LoginActivity::class.java)
        startActivity(pindah)
    }

    private fun logoutUser(){
        editor.remove("nama")
        editor.remove("nomor")
        editor.remove("email")
        editor.remove("image")
        editor.apply()
        loginEditor.remove("isLogin")
        loginEditor.apply()
        activity?.finish()
        goToLogin()
    }

}

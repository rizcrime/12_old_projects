package idn.eb2.emergencybutton2.MVP.View

import android.annotation.SuppressLint
import android.content.Context
import android.content.Intent
import android.content.SharedPreferences
import android.os.Bundle
import android.view.View
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import idn.eb2.emergencybutton2.Global.UserItem
import idn.eb2.emergencybutton2.MVP.Presenter.LoginPresenter
import idn.eb2.emergencybutton2.MVP.Model.LoginModel
import idn.eb2.emergencybutton2.R
import kotlinx.android.synthetic.main.login_layout_activity.*
import retrofit2.Response

class LoginActivity : AppCompatActivity(), LoginModel.View {

    private val presenter: LoginPresenter = LoginPresenter(this)
    private lateinit var myPref: SharedPreferences
    private lateinit var loginPref: SharedPreferences
    private lateinit var loginEditor: SharedPreferences.Editor
    private lateinit var editor: SharedPreferences.Editor

    @SuppressLint("CommitPrefEdits")
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setTheme(R.style.AppTheme)
        setContentView(R.layout.login_layout_activity)

        goneLoading()

        myPref = getSharedPreferences("userInfo", Context.MODE_PRIVATE)
        loginPref = getSharedPreferences("login", Context.MODE_PRIVATE)
        editor = getSharedPreferences("userInfo", Context.MODE_PRIVATE).edit()
        loginEditor = getSharedPreferences("login", Context.MODE_PRIVATE).edit()

        checkLogin()

        login.setOnClickListener {
            showLoading()
            presenter.pushLoginData(email.text.toString(), password.text.toString())
        }

        register.setOnClickListener {
            showLoading()
            goToRegister()
        }

        forget_password.setOnClickListener {
            showLoading()
            goToForpass()
        }
    }

    override fun goToHome() {
        this.finish()
        val intent = Intent(this, HomeActivity::class.java)
        startActivity(intent)
    }

    override fun goToRegister() {
        val intent = Intent(this, RegisterActivity::class.java)
        this.finish()
        startActivity(intent)
    }

    override fun goToForpass() {
        val intent = Intent(this, ForpassActivity::class.java)
        this.finish()
        startActivity(intent)
    }

    override fun saveUserData(data: Response<UserItem>?) {
        loginEditor.putString("isLogin", "true")
        editor.putString("id", data?.body()?.data?.id.toString())
        editor.putString("nama", data?.body()?.data?.name)
        editor.putString("nomor", data?.body()?.data?.number)
        editor.putString("email", data?.body()?.data?.email)
        editor.putString("image", data?.body()?.data?.image)
        loginEditor.apply()
        editor.apply()
    }

    override fun isFailure(msg: String) {
        goneLoading()
        Toast.makeText(this, msg, Toast.LENGTH_SHORT).show()
    }

    override fun isSuccess(msg: String) {
        goneLoading()
        this.finish()
        Toast.makeText(this, msg, Toast.LENGTH_SHORT).show()
    }

    override fun goneLoading() {
        progress_login.visibility = View.GONE
    }

    override fun showLoading() {
        progress_login.visibility = View.VISIBLE
    }

    override fun checkLogin() {
        val isLogin = loginPref.getString("isLogin", "")
        showLoading()
        if (isLogin.equals("true")) {
            goToHome()
        } else {
            goneLoading()
            Toast.makeText(this, "Silahkan Login/SignUp terlebih dahulu", Toast.LENGTH_LONG).show()
        }
    }
}

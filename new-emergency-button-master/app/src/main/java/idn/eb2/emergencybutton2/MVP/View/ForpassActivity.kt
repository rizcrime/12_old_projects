package idn.eb2.emergencybutton2.MVP.View

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.View
import android.widget.Toast
import es.dmoral.toasty.Toasty
import idn.eb2.emergencybutton2.MVP.Model.ForpassModel
import idn.eb2.emergencybutton2.MVP.Presenter.ForpassPresenter
import idn.eb2.emergencybutton2.R
import kotlinx.android.synthetic.main.forpass_layout_activity.*

class ForpassActivity : AppCompatActivity(), ForpassModel.View {

    private val presenter: ForpassPresenter = ForpassPresenter(this)
    private lateinit var email : String

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.forpass_layout_activity)

        goneLoading()
        email = edt_email_forpass.text.toString().trim()

        btn_submit.setOnClickListener {
            showLoading()
            if (email == "" || email.isEmpty()) {
                presenter.getDataPass(edt_email_forpass.text.toString())
            } else {
                edt_email_forpass.error = "Isi kolom email terlebih dahulu!"
            }
        }

        btn_back.setOnClickListener {
            showLoading()
            this.finish()
            goToLogin()
        }
    }

    override fun onSuccess(msg: String) {
        goneLoading()
        Toast.makeText(this, msg, Toast.LENGTH_LONG).show()
    }

    override fun isFailure(msg: String) {
        goneLoading()
        Toast.makeText(this, msg, Toast.LENGTH_LONG).show()
    }

    override fun showPass(pass: String) {
        goneLoading()
        Toasty.normal(this, "password akun anda adalah: $pass", Toasty.LENGTH_LONG).show()
    }

    override fun goToLogin() {
        val intent = Intent(this, LoginActivity::class.java)
        startActivity(intent)
    }

    override fun goneLoading() {
        progress_register.visibility = View.GONE
    }

    override fun showLoading() {
        progress_register.visibility = View.VISIBLE
    }
}

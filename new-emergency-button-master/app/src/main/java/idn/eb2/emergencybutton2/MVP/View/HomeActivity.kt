package idn.eb2.emergencybutton2.MVP.View

import android.content.SharedPreferences
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Toast
import idn.eb2.emergencybutton2.Global.SectionsPagerAdapter
import idn.eb2.emergencybutton2.R
import kotlinx.android.synthetic.main.home_layout_activity.*

class HomeActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.home_layout_activity)

        val sectionPagerAdapter = SectionsPagerAdapter(this, supportFragmentManager)
        vp_main.adapter = sectionPagerAdapter
        tab_detail.setupWithViewPager(vp_main)

    }

}

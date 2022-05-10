package idn.eb2.emergencybutton2.Global

import android.content.Context
import androidx.fragment.app.Fragment
import androidx.fragment.app.FragmentManager
import androidx.fragment.app.FragmentPagerAdapter
import idn.eb2.emergencybutton2.MVP.View.FragmentAlertActivity
import idn.eb2.emergencybutton2.MVP.View.FragmentNotificationActivity
import idn.eb2.emergencybutton2.MVP.View.FragmentProfileActivity
import idn.eb2.emergencybutton2.R

class SectionsPagerAdapter(private val context: Context, fm: FragmentManager) :
    FragmentPagerAdapter(fm) {

    private val PAGE_TITLES = arrayOf(
        R.string.alert,
        R.string.profile,
        R.string.notification
    )

    val page = listOf(
        FragmentAlertActivity(),
        FragmentProfileActivity(),
        FragmentNotificationActivity()
    )

    override fun getItem(position: Int): Fragment {
        return page[position]
    }

    override fun getCount(): Int {
        return 3
    }

    override fun getPageTitle(position: Int): CharSequence? {
        return context.resources.getString(PAGE_TITLES[position])
    }
}
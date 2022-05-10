package com.idn.projectsms.ui.homepage.home

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.fragment.app.Fragment
import androidx.lifecycle.Observer
import androidx.lifecycle.ViewModelProviders
import com.idn.projectsms.R

class HomeFragment : Fragment() {

    private lateinit var homeVM: HomeVM

    override fun onCreateView(
            inflater: LayoutInflater,
            container: ViewGroup?,
            savedInstanceState: Bundle?
    ): View? {
        homeVM =
                ViewModelProviders.of(this).get(HomeVM::class.java)
        val root = inflater.inflate(R.layout.fragment_home, container, false)
        val textView: TextView = root.findViewById(R.id.text_home)
        homeVM.text.observe(viewLifecycleOwner, Observer {
            textView.text = it
        })
        return root
    }
}

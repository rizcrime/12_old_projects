package com.idn.projectsms.ui.homepage.raport

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.fragment.app.Fragment
import androidx.lifecycle.Observer
import androidx.lifecycle.ViewModelProviders
import com.idn.projectsms.R

class RaportFragment : Fragment() {

    private lateinit var raportVM: RaportVM

    override fun onCreateView(
            inflater: LayoutInflater,
            container: ViewGroup?,
            savedInstanceState: Bundle?
    ): View? {
        raportVM =
                ViewModelProviders.of(this).get(RaportVM::class.java)
        val root = inflater.inflate(R.layout.fragment_dashboard, container, false)
        val textView: TextView = root.findViewById(R.id.text_dashboard)
        raportVM.text.observe(viewLifecycleOwner, Observer {
            textView.text = it
        })
        return root
    }
}

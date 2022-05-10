package com.idn.projectsms.ui.homepage.chat

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.fragment.app.Fragment
import androidx.lifecycle.Observer
import androidx.lifecycle.ViewModelProviders
import com.idn.projectsms.R

class ChatFragment : Fragment() {

    private lateinit var chatVM: ChatVM

    override fun onCreateView(
            inflater: LayoutInflater,
            container: ViewGroup?,
            savedInstanceState: Bundle?
    ): View? {
        chatVM =
                ViewModelProviders.of(this).get(ChatVM::class.java)
        val root = inflater.inflate(R.layout.fragment_notifications, container, false)
        val textView: TextView = root.findViewById(R.id.text_notifications)
        chatVM.text.observe(viewLifecycleOwner, Observer {
            textView.text = it
        })
        return root
    }
}

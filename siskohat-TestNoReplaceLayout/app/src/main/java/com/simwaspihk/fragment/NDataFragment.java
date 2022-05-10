package com.simwaspihk.fragment;

import android.content.Context;
import android.graphics.Bitmap;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentTabHost;
import android.view.LayoutInflater;
import android.view.MotionEvent;
import android.view.View;
import android.view.View.OnTouchListener;
import android.view.ViewGroup;
import android.webkit.WebChromeClient;
import android.webkit.WebResourceError;
import android.webkit.WebResourceRequest;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.ProgressBar;
import com.daimajia.slider.library.SliderLayout;
import com.simwaspihk.R;

public class NDataFragment extends Fragment {
    private SliderLayout mDemoSlider;
    private FragmentTabHost mTabHost;
    private float m_downX;
    private ProgressBar progressBar;
    private String title;
    private String url;
    private WebView webView;

    private class MyWebChromeClient extends WebChromeClient {
        Context context;

        public MyWebChromeClient(Context context) {
            this.context = context;
        }
    }

    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        return inflater.inflate(R.layout.activity_webview, container, false);
    }

    private void initWebView() {
        this.webView.setWebChromeClient(new MyWebChromeClient(getActivity()));
        this.webView.setWebViewClient(new WebViewClient() {
            public void onPageStarted(WebView view, String url, Bitmap favicon) {
                super.onPageStarted(view, url, favicon);
                NDataFragment.this.progressBar.setVisibility(View.VISIBLE);
            }

            public boolean shouldOverrideUrlLoading(WebView view, String url) {
                NDataFragment.this.webView.loadUrl(url);
                return true;
            }

            public void onPageFinished(WebView view, String url) {
                super.onPageFinished(view, url);
                NDataFragment.this.progressBar.setVisibility(View.GONE);
            }

            public void onReceivedError(WebView view, WebResourceRequest request, WebResourceError error) {
                super.onReceivedError(view, request, error);
                NDataFragment.this.progressBar.setVisibility(View.GONE);
            }
        });
        this.webView.clearCache(true);
        this.webView.clearHistory();
        this.webView.getSettings().setJavaScriptEnabled(true);
        this.webView.setHorizontalScrollBarEnabled(false);
        this.webView.setOnTouchListener(new OnTouchListener() {
            public boolean onTouch(View v, MotionEvent event) {
                if (event.getPointerCount() > 1) {
                    return true;
                }
                switch (event.getAction()) {
                    case 0:
                        NDataFragment.this.m_downX = event.getX();
                        break;
                    case 1:
                    case 2:
                    case 3:
                        event.setLocation(NDataFragment.this.m_downX, event.getY());
                        break;
                }
                return false;
            }
        });
    }
}

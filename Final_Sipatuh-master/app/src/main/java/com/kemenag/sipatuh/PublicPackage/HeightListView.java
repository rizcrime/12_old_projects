package com.kemenag.sipatuh.PublicPackage;

import android.content.Context;
import android.util.AttributeSet;
import android.widget.ListView;

public class HeightListView extends ListView {

    public HeightListView(Context context, AttributeSet attrs) {
        super(context, attrs);
    }

    public HeightListView(Context context) {
        super(context);
    }

    public HeightListView(Context context, AttributeSet attrs, int defStyle) {
        super(context, attrs, defStyle);
    }

    @Override
    public void onMeasure(int widthMeasureSpec, int heightMeasureSpec) {
        int expandSpec = MeasureSpec.makeMeasureSpec(500,
                MeasureSpec.AT_MOST);

        super.onMeasure(widthMeasureSpec, expandSpec);
    }

}
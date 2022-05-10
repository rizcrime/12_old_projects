package com.example.esdm.Klik.Migas;

public class Model {

    private String mTanggal1, mBerita1, mJenis1, mUrl1;

    public String getmTanggal1() {
        return mTanggal1;
    }

    public String getmBerita1() {
        return mBerita1;
    }

    public String getmJenis1() {
        return mJenis1;
    }

    public String getmUrl1() {
        return mUrl1;
    }

    public Model(String tanggal1, String berita1, String jenis1, String url1)
    {
        mTanggal1 = tanggal1;
        mBerita1 = berita1;
        mJenis1 = jenis1;
        mUrl1 = url1;
    }

}

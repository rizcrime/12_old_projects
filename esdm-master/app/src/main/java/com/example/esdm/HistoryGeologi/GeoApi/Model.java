package com.example.esdm.HistoryGeologi.GeoApi;

public class Model {

    private String mTanggal1, mGunungApi1, mTingkatAktifitas1, mKeterangan1, mRekomendasi1, mVona1, mDetail1;

    public String getmTanggal1() {
        return mTanggal1;
    }

    public String getmGunungApi1() {
        return mGunungApi1;
    }

    public String getmTingkatAktifitas1() {
        return mTingkatAktifitas1;
    }

    public String getmKeterangan1() {
        return mKeterangan1;
    }

    public String getmRekomendasi1() {
        return mRekomendasi1;
    }

    public String getmVona1() {
        return mVona1;
    }

    public String getmDetail1() {
        return mDetail1;
    }



    public Model(String tanggal1, String gunungapi1, String tingkataktifitas1,
                 String keterangan1, String rekomendasi1, String vona1, String detail1)
    {
        mTanggal1 = tanggal1;
        mGunungApi1 = gunungapi1;
        mTingkatAktifitas1 = tingkataktifitas1;
        mKeterangan1 = keterangan1;
        mRekomendasi1 = rekomendasi1;
        mVona1 = vona1;
        mDetail1 = detail1;
    }

}

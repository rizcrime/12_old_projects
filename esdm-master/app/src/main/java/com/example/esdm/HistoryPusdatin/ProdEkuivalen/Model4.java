package com.example.esdm.HistoryPusdatin.ProdEkuivalen;

public class Model4 {

    private int mProdHarian4, mProdBulanan4, mProdTahunan4, mTargetApbn4;
    private String mTanggal4;

    public String getmTanggal4() {
        return mTanggal4;
    }

    public int getmProdHarian4() {
        return mProdHarian4;
    }

    public int getmProdBulanan4() {
        return mProdBulanan4;
    }

    public int getmProdTahunan4() {
        return mProdTahunan4;
    }

    public int getmTargetApbn4() {
        return mTargetApbn4;
    }

    public Model4(String tanggal4, int prodharian4, int prodbulanan4, int prodtahunan4, int targetapbn4)
    {
        mTanggal4 = tanggal4;
       mProdHarian4 = prodharian4;
       mProdBulanan4 = prodbulanan4;
       mProdTahunan4 = prodtahunan4;
       mTargetApbn4 = targetapbn4;
    }

}

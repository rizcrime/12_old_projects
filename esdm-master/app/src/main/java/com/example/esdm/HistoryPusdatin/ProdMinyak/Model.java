package com.example.esdm.HistoryPusdatin.ProdMinyak;

public class Model {

    private int mProdHarian1, mProdBulanan1, mProdTahunan1, mTargetApbn1;
    private String mTanggal1;

    public String getmTanggal1() {
        return mTanggal1;
    }

    public int getmProdHarian1() {
        return mProdHarian1;
    }

    public int getmProdBulanan1() {
        return mProdBulanan1;
    }

    public int getmProdTahunan1() {
        return mProdTahunan1;
    }

    public int getmTargetApbn1() {
        return mTargetApbn1;
    }

    public Model(String tanggal1, int prodharian1, int produbulanan1, int prodtahunan1, int targetapbn1)
    {
        mTanggal1 = tanggal1;
        mProdHarian1 = prodharian1; mProdBulanan1 = produbulanan1; mProdTahunan1 = prodtahunan1; mTargetApbn1 = targetapbn1;
    }

}

package com.example.esdm.Pusdatin.ProdGas;

public class Model3 {

    private int mProdHarian3, mProdBulanan3, mProdTahunan3, mTargetApbn3;
    private String mTanggal3;

    public String getmTanggal3() {
        return mTanggal3;
    }

    public int getmProdHarian3() {
        return mProdHarian3;
    }

    public int getmProdBulanan3() {
        return mProdBulanan3;
    }

    public int getmProdTahunan3() {
        return mProdTahunan3;
    }

    public int getmTargetApbn3() {
        return mTargetApbn3;
    }

    public Model3(String tanggal3, int prodharian3, int prodbulanan3, int prodtahunan3, int targetapbn3)
    {
        mTanggal3 = tanggal3;
        mProdHarian3 = prodharian3;
        mProdBulanan3 = prodbulanan3;
        mProdTahunan3 = prodtahunan3;
        mTargetApbn3 = targetapbn3;
    }

}

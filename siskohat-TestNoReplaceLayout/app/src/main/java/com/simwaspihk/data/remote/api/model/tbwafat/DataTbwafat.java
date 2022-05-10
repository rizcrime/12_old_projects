package com.simwaspihk.data.remote.api.model.tbwafat;

import com.google.gson.annotations.SerializedName;

public class DataTbwafat {
    @SerializedName("id")
    private String id;
    @SerializedName("keterangan")
    private String keterangan;
    @SerializedName("makan")
    private String makan;
    @SerializedName("nama_jemaah")
    private String namaJemaah;
    @SerializedName("no_pasport")
    private String noPasport;
    @SerializedName("no_porsi")
    private String noPorsi;
    @SerializedName("sebab")
    private String sebab;
    @SerializedName("tempat")
    private String tempat;
    @SerializedName("tgl_lahir")
    private String tglLahir;
    @SerializedName("user_id")
    private String userId;
    @SerializedName("waktu")
    private String waktu;

    public void setSebab(String sebab) {
        this.sebab = sebab;
    }

    public String getSebab() {
        return this.sebab;
    }

    public void setKeterangan(String keterangan) {
        this.keterangan = keterangan;
    }

    public String getKeterangan() {
        return this.keterangan;
    }

    public void setTempat(String tempat) {
        this.tempat = tempat;
    }

    public String getTempat() {
        return this.tempat;
    }

    public void setNoPorsi(String noPorsi) {
        this.noPorsi = noPorsi;
    }

    public String getNoPorsi() {
        return this.noPorsi;
    }

    public void setUserId(String userId) {
        this.userId = userId;
    }

    public String getUserId() {
        return this.userId;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getId() {
        return this.id;
    }

    public void setNoPasport(String noPasport) {
        this.noPasport = noPasport;
    }

    public String getNoPasport() {
        return this.noPasport;
    }

    public void setWaktu(String waktu) {
        this.waktu = waktu;
    }

    public String getWaktu() {
        return this.waktu;
    }

    public void setMakan(String makan) {
        this.makan = makan;
    }

    public String getMakan() {
        return this.makan;
    }

    public void setTglLahir(String tglLahir) {
        this.tglLahir = tglLahir;
    }

    public String getTglLahir() {
        return this.tglLahir;
    }

    public void setNamaJemaah(String namaJemaah) {
        this.namaJemaah = namaJemaah;
    }

    public String getNamaJemaah() {
        return this.namaJemaah;
    }
}

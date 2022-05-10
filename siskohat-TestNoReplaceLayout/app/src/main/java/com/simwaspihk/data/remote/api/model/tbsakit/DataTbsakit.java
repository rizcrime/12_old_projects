package com.simwaspihk.data.remote.api.model.tbsakit;

import com.google.gson.annotations.SerializedName;

public class DataTbsakit {
    @SerializedName("id")
    private String id;
    @SerializedName("keterangan")
    private String keterangan;
    @SerializedName("nama_jemaah")
    private String namaJemaah;
    @SerializedName("no_pasport")
    private String noPasport;
    @SerializedName("rumah_sakit")
    private String rumahSakit;
    @SerializedName("sebab")
    private String sebab;
    @SerializedName("tgl_lahir")
    private String tglLahir;
    @SerializedName("tgl_rawat")
    private String tglRawat;
    @SerializedName("user_id")
    private String userId;

    public DataTbsakit(String sebab, String keterangan, String tglLahir, String noPasport, String userId, String id, String tglRawat, String rumahSakit, String namaJemaah) {
        this.sebab = sebab;
        this.keterangan = keterangan;
        this.tglLahir = tglLahir;
        this.noPasport = noPasport;
        this.userId = userId;
        this.id = id;
        this.tglRawat = tglRawat;
        this.rumahSakit = rumahSakit;
        this.namaJemaah = namaJemaah;
    }

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

    public void setTglRawat(String tglRawat) {
        this.tglRawat = tglRawat;
    }

    public String getTglRawat() {
        return this.tglRawat;
    }

    public void setTglLahir(String tglLahir) {
        this.tglLahir = tglLahir;
    }

    public String getTglLahir() {
        return this.tglLahir;
    }

    public void setRumahSakit(String rumahSakit) {
        this.rumahSakit = rumahSakit;
    }

    public String getRumahSakit() {
        return this.rumahSakit;
    }

    public void setNamaJemaah(String namaJemaah) {
        this.namaJemaah = namaJemaah;
    }

    public String getNamaJemaah() {
        return this.namaJemaah;
    }
}

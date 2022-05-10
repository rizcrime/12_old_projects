package com.simwaspihk.data.remote.api.model.asosiasi;

public class ResponseAsosiasi {
    private String asosiasi;
    private String jumlahJamaah;

    public void setJumlahJamaah(String jumlahJamaah) {
        this.jumlahJamaah = jumlahJamaah;
    }

    public String getJumlahJamaah() {
        return this.jumlahJamaah;
    }

    public void setAsosiasi(String asosiasi) {
        this.asosiasi = asosiasi;
    }

    public String getAsosiasi() {
        return this.asosiasi;
    }

    public String toString() {
        return "ResponseAsosiasi{jumlah_jamaah = '" + this.jumlahJamaah + '\'' + ",asosiasi = '" + this.asosiasi + '\'' + "}";
    }
}

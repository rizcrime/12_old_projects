package com.simwaspihk.model;

/**
 * Created by risma on 5/18/2019.
 */

public class DataJamaah {
    String kode_porsi;
    String nama;

    public String getKode_porsi() {
        return kode_porsi;
    }

    public void setKode_porsi(String kode_porsi) {
        this.kode_porsi = kode_porsi;
    }

    public void setNama(String nama) {
        this.nama = nama;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    String status;

    public DataJamaah(String kode_porsi, String nama) {
        this.kode_porsi = kode_porsi;
        this.nama = nama;
        this.status = "BERANGKAT";
    }

    public String getNama() {
        return nama;
    }

    public String getKodePorsi() {
        return kode_porsi;
    }
}

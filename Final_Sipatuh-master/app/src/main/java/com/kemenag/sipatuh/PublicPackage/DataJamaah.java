package com.kemenag.sipatuh.PublicPackage;

/**
 * Created by risma on 5/18/2019.
 */

public class DataJamaah {
    String kode_porsi;
    String nama;

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

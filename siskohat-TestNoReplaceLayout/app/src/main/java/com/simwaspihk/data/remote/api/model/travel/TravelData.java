package com.simwaspihk.data.remote.api.model.travel;

import com.google.gson.annotations.SerializedName;

public class TravelData {
    @SerializedName("alamat")
    private String alamat;
    @SerializedName("asosiasi")
    private String asosiasi;
    @SerializedName("email")
    private String email;
    @SerializedName("email_pihk")
    private String emailPihk;
    @SerializedName("harga_standard")
    private String hargaStandard;
    @SerializedName("harga_vip")
    private String hargaVip;
    @SerializedName("hotel_jeddah")
    private String hotelJeddah;
    @SerializedName("hotel_madinah")
    private String hotelMadinah;
    @SerializedName("hotel_makkah")
    private String hotelMakkah;
    @SerializedName("hotel_transit")
    private String hotelTransit;
    @SerializedName("is_deleted")
    private String isDeleted;
    @SerializedName("jml_jamaah")
    private String jmlJamaah;
    @SerializedName("katering_jeddah")
    private String kateringJeddah;
    @SerializedName("katering_madinah")
    private String kateringMadinah;
    @SerializedName("katering_makkah")
    private String kateringMakkah;
    @SerializedName("katering_transit")
    private String kateringTransit;
    @SerializedName("kode_pihk")
    private String kodePihk;
    @SerializedName("lama_penyelengaraan")
    private String lamaPenyelengaraan;
    @SerializedName("masa_berlaku")
    private String masaBerlaku;
    @SerializedName("nama_pimpinan")
    private String namaPimpinan;
    @SerializedName("name")
    private String name;
    @SerializedName("nm_petugas_kemenag")
    private String nmPetugasKemenag;
    @SerializedName("nm_petugas_kes")
    private String nmPetugasKes;
    @SerializedName("nm_petugas_pembimbing")
    private String nmPetugasPembimbing;
    @SerializedName("nm_petugas_pihk")
    private String nmPetugasPihk;
    @SerializedName("no_hp")
    private String noHp;
    @SerializedName("no_sk")
    private String noSk;
    @SerializedName("no_telp")
    private String noTelp;
    @SerializedName("password")
    private String password;
    @SerializedName("perwakilan_arab")
    private String perwakilanArab;
    @SerializedName("profile_pic")
    private String profilePic;
    @SerializedName("rute_perjalanan")
    private String rutePerjalanan;
    @SerializedName("status")
    private String status;
    @SerializedName("tel_perwakilan_arab")
    private String telPerwakilanArab;
    @SerializedName("tel_petugas_kemenag")
    private String telPetugasKemenag;
    @SerializedName("tel_petugas_kes")
    private String telPetugasKes;
    @SerializedName("tel_petugas_pembimbing")
    private String telPetugasPembimbing;
    @SerializedName("tel_petugas_pihk")
    private String telPetugasPihk;
    @SerializedName("tgl_berangkat")
    private String tglBerangkat;
    @SerializedName("tgl_pulang")
    private String tglPulang;
    @SerializedName("tinggal_jkt_sa_jkt")
    private String tinggalJktSaJkt;
    @SerializedName("tinggal_madinah")
    private String tinggalMadinah;
    @SerializedName("tinggal_makkah")
    private String tinggalMakkah;
    @SerializedName("transfortasi")
    private String transfortasi;
    @SerializedName("user_id")
    private String userId;
    @SerializedName("user_type")
    private String userType;
    @SerializedName("users_id")
    private String usersId;
    @SerializedName("var_key")
    private Object varKey;

    public void setNmPetugasPihk(String nmPetugasPihk) {
        this.nmPetugasPihk = nmPetugasPihk;
    }

    public String getNmPetugasPihk() {
        return this.nmPetugasPihk;
    }

    public void setNoHp(String noHp) {
        this.noHp = noHp;
    }

    public String getNoHp() {
        return this.noHp;
    }

    public void setTglBerangkat(String tglBerangkat) {
        this.tglBerangkat = tglBerangkat;
    }

    public String getTglBerangkat() {
        return this.tglBerangkat;
    }

    public void setKateringMakkah(String kateringMakkah) {
        this.kateringMakkah = kateringMakkah;
    }

    public String getKateringMakkah() {
        return this.kateringMakkah;
    }

    public void setKateringTransit(String kateringTransit) {
        this.kateringTransit = kateringTransit;
    }

    public String getKateringTransit() {
        return this.kateringTransit;
    }

    public void setPerwakilanArab(String perwakilanArab) {
        this.perwakilanArab = perwakilanArab;
    }

    public String getPerwakilanArab() {
        return this.perwakilanArab;
    }

    public void setJmlJamaah(String jmlJamaah) {
        this.jmlJamaah = jmlJamaah;
    }

    public String getJmlJamaah() {
        return this.jmlJamaah;
    }

    public void setKateringMadinah(String kateringMadinah) {
        this.kateringMadinah = kateringMadinah;
    }

    public String getKateringMadinah() {
        return this.kateringMadinah;
    }

    public void setKateringJeddah(String kateringJeddah) {
        this.kateringJeddah = kateringJeddah;
    }

    public String getKateringJeddah() {
        return this.kateringJeddah;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public String getPassword() {
        return this.password;
    }

    public void setHotelMakkah(String hotelMakkah) {
        this.hotelMakkah = hotelMakkah;
    }

    public String getHotelMakkah() {
        return this.hotelMakkah;
    }

    public void setIsDeleted(String isDeleted) {
        this.isDeleted = isDeleted;
    }

    public String getIsDeleted() {
        return this.isDeleted;
    }

    public void setUserType(String userType) {
        this.userType = userType;
    }

    public String getUserType() {
        return this.userType;
    }

    public void setNoSk(String noSk) {
        this.noSk = noSk;
    }

    public String getNoSk() {
        return this.noSk;
    }

    public void setNmPetugasPembimbing(String nmPetugasPembimbing) {
        this.nmPetugasPembimbing = nmPetugasPembimbing;
    }

    public String getNmPetugasPembimbing() {
        return this.nmPetugasPembimbing;
    }

    public void setTelPetugasPembimbing(String telPetugasPembimbing) {
        this.telPetugasPembimbing = telPetugasPembimbing;
    }

    public String getTelPetugasPembimbing() {
        return this.telPetugasPembimbing;
    }

    public void setUsersId(String usersId) {
        this.usersId = usersId;
    }

    public String getUsersId() {
        return this.usersId;
    }

    public void setTglPulang(String tglPulang) {
        this.tglPulang = tglPulang;
    }

    public String getTglPulang() {
        return this.tglPulang;
    }

    public void setRutePerjalanan(String rutePerjalanan) {
        this.rutePerjalanan = rutePerjalanan;
    }

    public String getRutePerjalanan() {
        return this.rutePerjalanan;
    }

    public void setHotelMadinah(String hotelMadinah) {
        this.hotelMadinah = hotelMadinah;
    }

    public String getHotelMadinah() {
        return this.hotelMadinah;
    }

    public void setHargaStandard(String hargaStandard) {
        this.hargaStandard = hargaStandard;
    }

    public String getHargaStandard() {
        return this.hargaStandard;
    }

    public void setNmPetugasKemenag(String nmPetugasKemenag) {
        this.nmPetugasKemenag = nmPetugasKemenag;
    }

    public String getNmPetugasKemenag() {
        return this.nmPetugasKemenag;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getEmail() {
        return this.email;
    }

    public void setTinggalMakkah(String tinggalMakkah) {
        this.tinggalMakkah = tinggalMakkah;
    }

    public String getTinggalMakkah() {
        return this.tinggalMakkah;
    }

    public void setVarKey(Object varKey) {
        this.varKey = varKey;
    }

    public Object getVarKey() {
        return this.varKey;
    }

    public void setTelPetugasPihk(String telPetugasPihk) {
        this.telPetugasPihk = telPetugasPihk;
    }

    public String getTelPetugasPihk() {
        return this.telPetugasPihk;
    }

    public void setTinggalJktSaJkt(String tinggalJktSaJkt) {
        this.tinggalJktSaJkt = tinggalJktSaJkt;
    }

    public String getTinggalJktSaJkt() {
        return this.tinggalJktSaJkt;
    }

    public void setKodePihk(String kodePihk) {
        this.kodePihk = kodePihk;
    }

    public String getKodePihk() {
        return this.kodePihk;
    }

    public void setNmPetugasKes(String nmPetugasKes) {
        this.nmPetugasKes = nmPetugasKes;
    }

    public String getNmPetugasKes() {
        return this.nmPetugasKes;
    }

    public void setTelPerwakilanArab(String telPerwakilanArab) {
        this.telPerwakilanArab = telPerwakilanArab;
    }

    public String getTelPerwakilanArab() {
        return this.telPerwakilanArab;
    }

    public void setNamaPimpinan(String namaPimpinan) {
        this.namaPimpinan = namaPimpinan;
    }

    public String getNamaPimpinan() {
        return this.namaPimpinan;
    }

    public void setTelPetugasKes(String telPetugasKes) {
        this.telPetugasKes = telPetugasKes;
    }

    public String getTelPetugasKes() {
        return this.telPetugasKes;
    }

    public void setTelPetugasKemenag(String telPetugasKemenag) {
        this.telPetugasKemenag = telPetugasKemenag;
    }

    public String getTelPetugasKemenag() {
        return this.telPetugasKemenag;
    }

    public void setHotelJeddah(String hotelJeddah) {
        this.hotelJeddah = hotelJeddah;
    }

    public String getHotelJeddah() {
        return this.hotelJeddah;
    }

    public void setProfilePic(String profilePic) {
        this.profilePic = profilePic;
    }

    public String getProfilePic() {
        return this.profilePic;
    }

    public void setEmailPihk(String emailPihk) {
        this.emailPihk = emailPihk;
    }

    public String getEmailPihk() {
        return this.emailPihk;
    }

    public void setMasaBerlaku(String masaBerlaku) {
        this.masaBerlaku = masaBerlaku;
    }

    public String getMasaBerlaku() {
        return this.masaBerlaku;
    }

    public void setAsosiasi(String asosiasi) {
        this.asosiasi = asosiasi;
    }

    public String getAsosiasi() {
        return this.asosiasi;
    }

    public void setAlamat(String alamat) {
        this.alamat = alamat;
    }

    public String getAlamat() {
        return this.alamat;
    }

    public void setTinggalMadinah(String tinggalMadinah) {
        this.tinggalMadinah = tinggalMadinah;
    }

    public String getTinggalMadinah() {
        return this.tinggalMadinah;
    }

    public void setUserId(String userId) {
        this.userId = userId;
    }

    public String getUserId() {
        return this.userId;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getName() {
        return this.name;
    }

    public void setHotelTransit(String hotelTransit) {
        this.hotelTransit = hotelTransit;
    }

    public String getHotelTransit() {
        return this.hotelTransit;
    }

    public void setNoTelp(String noTelp) {
        this.noTelp = noTelp;
    }

    public String getNoTelp() {
        return this.noTelp;
    }

    public void setLamaPenyelengaraan(String lamaPenyelengaraan) {
        this.lamaPenyelengaraan = lamaPenyelengaraan;
    }

    public String getLamaPenyelengaraan() {
        return this.lamaPenyelengaraan;
    }

    public void setHargaVip(String hargaVip) {
        this.hargaVip = hargaVip;
    }

    public String getHargaVip() {
        return this.hargaVip;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public String getStatus() {
        return this.status;
    }

    public void setTransfortasi(String transfortasi) {
        this.transfortasi = transfortasi;
    }

    public String getTransfortasi() {
        return this.transfortasi;
    }

    public String toString() {
        return "TravelData{nm_petugas_pihk = '" + this.nmPetugasPihk + '\'' + ",no_hp = '" + this.noHp + '\'' + ",tgl_berangkat = '" + this.tglBerangkat + '\'' + ",katering_makkah = '" + this.kateringMakkah + '\'' + ",katering_transit = '" + this.kateringTransit + '\'' + ",perwakilan_arab = '" + this.perwakilanArab + '\'' + ",jml_jamaah = '" + this.jmlJamaah + '\'' + ",katering_madinah = '" + this.kateringMadinah + '\'' + ",katering_jeddah = '" + this.kateringJeddah + '\'' + ",password = '" + this.password + '\'' + ",hotel_makkah = '" + this.hotelMakkah + '\'' + ",is_deleted = '" + this.isDeleted + '\'' + ",user_type = '" + this.userType + '\'' + ",no_sk = '" + this.noSk + '\'' + ",nm_petugas_pembimbing = '" + this.nmPetugasPembimbing + '\'' + ",tel_petugas_pembimbing = '" + this.telPetugasPembimbing + '\'' + ",users_id = '" + this.usersId + '\'' + ",tgl_pulang = '" + this.tglPulang + '\'' + ",rute_perjalanan = '" + this.rutePerjalanan + '\'' + ",hotel_madinah = '" + this.hotelMadinah + '\'' + ",harga_standard = '" + this.hargaStandard + '\'' + ",nm_petugas_kemenag = '" + this.nmPetugasKemenag + '\'' + ",email = '" + this.email + '\'' + ",tinggal_makkah = '" + this.tinggalMakkah + '\'' + ",var_key = '" + this.varKey + '\'' + ",tel_petugas_pihk = '" + this.telPetugasPihk + '\'' + ",tinggal_jkt_sa_jkt = '" + this.tinggalJktSaJkt + '\'' + ",kode_pihk = '" + this.kodePihk + '\'' + ",nm_petugas_kes = '" + this.nmPetugasKes + '\'' + ",tel_perwakilan_arab = '" + this.telPerwakilanArab + '\'' + ",nama_pimpinan = '" + this.namaPimpinan + '\'' + ",tel_petugas_kes = '" + this.telPetugasKes + '\'' + ",tel_petugas_kemenag = '" + this.telPetugasKemenag + '\'' + ",hotel_jeddah = '" + this.hotelJeddah + '\'' + ",profile_pic = '" + this.profilePic + '\'' + ",email_pihk = '" + this.emailPihk + '\'' + ",masa_berlaku = '" + this.masaBerlaku + '\'' + ",asosiasi = '" + this.asosiasi + '\'' + ",alamat = '" + this.alamat + '\'' + ",tinggal_madinah = '" + this.tinggalMadinah + '\'' + ",user_id = '" + this.userId + '\'' + ",name = '" + this.name + '\'' + ",hotel_transit = '" + this.hotelTransit + '\'' + ",no_telp = '" + this.noTelp + '\'' + ",lama_penyelengaraan = '" + this.lamaPenyelengaraan + '\'' + ",harga_vip = '" + this.hargaVip + '\'' + ",status = '" + this.status + '\'' + ",transfortasi = '" + this.transfortasi + '\'' + "}";
    }
}

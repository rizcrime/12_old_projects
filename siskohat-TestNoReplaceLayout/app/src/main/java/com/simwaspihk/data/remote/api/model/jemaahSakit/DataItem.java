package com.simwaspihk.data.remote.api.model.jemaahSakit;

import javax.annotation.Generated;
import com.google.gson.annotations.SerializedName;

@Generated("com.robohorse.robopojogenerator")
public class DataItem{

	@SerializedName("usia")
	private String usia;

	@SerializedName("nama_pihk")
	private String namaPihk;

	@SerializedName("keterangan")
	private String keterangan;

	@SerializedName("ranap_tanggal")
	private String ranapTanggal;

	@SerializedName("noHp_penanggungJwb")
	private String noHpPenanggungJwb;

	@SerializedName("daftar_jemaahSakit")
	private String daftarJemaahSakit;

	@SerializedName("noPin_pihk")
	private String noPinPihk;

	@SerializedName("nama_jemaah")
	private String namaJemaah;

	@SerializedName("ranap_rsBphi")
	private String ranapRsBphi;

	@SerializedName("noHp_pendamping")
	private String noHpPendamping;

	@SerializedName("nama_pendamping")
	private String namaPendamping;

	@SerializedName("user_id")
	private String userId;

	@SerializedName("no_pasport")
	private String noPasport;

	@SerializedName("nama_penanggungJwb")
	private String namaPenanggungJwb;

	@SerializedName("id")
	private String id;

	@SerializedName("ranap_sebab")
	private String ranapSebab;

	public void setUsia(String usia){
		this.usia = usia;
	}

	public String getUsia(){
		return usia;
	}

	public void setNamaPihk(String namaPihk){
		this.namaPihk = namaPihk;
	}

	public String getNamaPihk(){
		return namaPihk;
	}

	public void setKeterangan(String keterangan){
		this.keterangan = keterangan;
	}

	public String getKeterangan(){
		return keterangan;
	}

	public void setRanapTanggal(String ranapTanggal){
		this.ranapTanggal = ranapTanggal;
	}

	public String getRanapTanggal(){
		return ranapTanggal;
	}

	public void setNoHpPenanggungJwb(String noHpPenanggungJwb){
		this.noHpPenanggungJwb = noHpPenanggungJwb;
	}

	public String getNoHpPenanggungJwb(){
		return noHpPenanggungJwb;
	}

	public void setDaftarJemaahSakit(String daftarJemaahSakit){
		this.daftarJemaahSakit = daftarJemaahSakit;
	}

	public String getDaftarJemaahSakit(){
		return daftarJemaahSakit;
	}

	public void setNoPinPihk(String noPinPihk){
		this.noPinPihk = noPinPihk;
	}

	public String getNoPinPihk(){
		return noPinPihk;
	}

	public void setNamaJemaah(String namaJemaah){
		this.namaJemaah = namaJemaah;
	}

	public String getNamaJemaah(){
		return namaJemaah;
	}

	public void setRanapRsBphi(String ranapRsBphi){
		this.ranapRsBphi = ranapRsBphi;
	}

	public String getRanapRsBphi(){
		return ranapRsBphi;
	}

	public void setNoHpPendamping(String noHpPendamping){
		this.noHpPendamping = noHpPendamping;
	}

	public String getNoHpPendamping(){
		return noHpPendamping;
	}

	public void setNamaPendamping(String namaPendamping){
		this.namaPendamping = namaPendamping;
	}

	public String getNamaPendamping(){
		return namaPendamping;
	}

	public void setUserId(String userId){
		this.userId = userId;
	}

	public String getUserId(){
		return userId;
	}

	public void setNoPasport(String noPasport){
		this.noPasport = noPasport;
	}

	public String getNoPasport(){
		return noPasport;
	}

	public void setNamaPenanggungJwb(String namaPenanggungJwb){
		this.namaPenanggungJwb = namaPenanggungJwb;
	}

	public String getNamaPenanggungJwb(){
		return namaPenanggungJwb;
	}

	public void setId(String id){
		this.id = id;
	}

	public String getId(){
		return id;
	}

	public void setRanapSebab(String ranapSebab){
		this.ranapSebab = ranapSebab;
	}

	public String getRanapSebab(){
		return ranapSebab;
	}

	@Override
 	public String toString(){
		return 
			"DataTbsakit{" +
			"usia = '" + usia + '\'' + 
			",nama_pihk = '" + namaPihk + '\'' + 
			",keterangan = '" + keterangan + '\'' + 
			",ranap_tanggal = '" + ranapTanggal + '\'' + 
			",noHp_penanggungJwb = '" + noHpPenanggungJwb + '\'' + 
			",daftar_jemaahSakit = '" + daftarJemaahSakit + '\'' + 
			",noPin_pihk = '" + noPinPihk + '\'' + 
			",nama_jemaah = '" + namaJemaah + '\'' + 
			",ranap_rsBphi = '" + ranapRsBphi + '\'' + 
			",noHp_pendamping = '" + noHpPendamping + '\'' + 
			",nama_pendamping = '" + namaPendamping + '\'' + 
			",user_id = '" + userId + '\'' + 
			",no_pasport = '" + noPasport + '\'' + 
			",nama_penanggungJwb = '" + namaPenanggungJwb + '\'' + 
			",id = '" + id + '\'' + 
			",ranap_sebab = '" + ranapSebab + '\'' + 
			"}";
		}
}